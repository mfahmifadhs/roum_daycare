<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Laporan;
use App\Models\SkriningAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnakController extends Controller
{
    public function index(Request $request)
    {
        $query = Anak::query();
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('nama', 'like', '%' . $request->search . '%')

                    ->orWhereHas('user', function ($user) use ($request) {

                        $user->where('nama', 'like', '%' . $request->search . '%')

                            ->orWhereHas('uker', function ($uker) use ($request) {

                                $uker->where(
                                    'nama_uker',
                                    'like',
                                    '%' . $request->search . '%'
                                );
                            });
                    });
            });
        }

        switch ($request->sort) {

            case 'terbaru':
                $query->latest();
                break;

            case 'terlama':
                $query->oldest();
                break;

            case 'nama_asc':
                $query->orderBy('nama', 'asc');
                break;

            case 'nama_desc':
                $query->orderBy('nama', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        $anak = $query->paginate(10);

        $data = new \stdClass();

        return view('pages.anak.show', compact('anak', 'data'));
    }

    public function store(Request $request)
    {
        // 1 USER HANYA 1 ANAK
        $cekAnak = Anak::where('user_id', auth()->id())->exists();

        if ($cekAnak) {

            return back()->with(
                'error',
                'Anda sudah memiliki data anak'
            );
        }

        $foto = null;

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto')->store('anak', 'public');
        }

        // SIMPAN DATA ANAK
        $anak = Anak::create([
            'id'                => Anak::withTrashed()->count() + 1,
            'kode'              => random_int(11111, 99999),
            'user_id'           => auth()->id(),
            'paket_id'          => null,
            'nama'              => $request->nama,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'golongan_darah'    => $request->golongan_darah,
            'kondisi_kesehatan' => null,
            'catatan_khusus'    => null,
            'foto'              => $foto,
        ]);


        // SIMPAN SKRINING
        SkriningAnak::create([
            'id'                   => SkriningAnak::withTrashed()->count() + 1,
            'anak_id'              => $anak->id,
            'berat_badan'          => $request->berat_badan,
            'tinggi_badan'         => $request->tinggi_badan,
            'alergi'               => $request->alergi,
            'riwayat_penyakit'     => $request->riwayat_penyakit,
            'kebutuhan_khusus'     => $request->kebutuhan_khusus,
            'konsumsi_obat'        => $request->konsumsi_obat,
            'riwayat_rawat_inap'   => $request->riwayat_rawat_inap,
            'imunisasi_dasar'      => $request->imunisasi_dasar,
            'catatan_orang_tua'    => $request->catatan_orang_tua,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Data anak berhasil ditambahkan'
            );
    }

    public function skriningDetail($id)
    {
        $anak = Anak::with('skrining')
            ->findOrFail($id);

        return response()->json([

            'id'     => $anak->id,
            'nama'   => $anak->nama,
            'foto'   => $anak->foto,

            'umur'   =>
            \Carbon\Carbon::parse(
                $anak->tanggal_lahir
            )->diff(now())->y
                . ' Tahun ' .
                \Carbon\Carbon::parse(
                    $anak->tanggal_lahir
                )->diff(now())->m
                . ' Bulan',

            'skrining' => $anak->skrining

        ]);
    }

    public function detail($id)
    {
        $anak = Anak::with([
            'laporan.detail.kategori',
            'user.uker'
        ])->findOrFail($id);

        $laporan = Laporan::with([
            'detail.kategori',
            'pengasuh'
        ])
            ->where('anak_id', $id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // REKAP KEGIATAN
        $rekapKegiatan = [];

        foreach ($laporan as $item) {

            foreach ($item->detail->where('keterangan', 'Kegiatan') as $detail) {

                $nama = $detail->kategori->deskripsi;

                if (!isset($rekapKegiatan[$nama])) {

                    $rekapKegiatan[$nama] = [
                        'Sangat Baik' => 0,
                        'Baik' => 0,
                        'Cukup' => 0,
                        'Perlu Pendampingan' => 0,
                    ];
                }

                if (isset($rekapKegiatan[$nama][$detail->nilai])) {
                    $rekapKegiatan[$nama][$detail->nilai]++;
                }
            }
        }

        // REKAP PERKEMBANGAN
        $rekapPerkembangan = [];

        foreach ($laporan as $item) {

            foreach ($item->detail->where('keterangan', 'Perkembangan') as $detail) {

                $nama = $detail->kategori->deskripsi;

                if (!isset($rekapPerkembangan[$nama])) {

                    $rekapPerkembangan[$nama] = [
                        'MB' => 0,
                        'BSH' => 0,
                        'BSB' => 0,
                    ];
                }

                if (isset($rekapPerkembangan[$nama][$detail->nilai])) {
                    $rekapPerkembangan[$nama][$detail->nilai]++;
                }
            }
        }

        return view('pages.anak.detail', compact('anak', 'rekapKegiatan', 'rekapPerkembangan'));
    }

    public function edit($id)
    {
        $anak = Anak::with('skrining')->findOrFail($id);

        return view('pages.anak.edit', compact('anak'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $anak = Anak::with('skrining')
                ->findOrFail($id);

            // FOTO
            $foto = $anak->foto;

            if ($request->hasFile('foto')) {

                if ($anak->foto && Storage::exists('public/' . $anak->foto)) {

                    Storage::delete('public/' . $anak->foto);
                }

                $foto = $request->file('foto')
                    ->store('anak', 'public');
            }

            // UPDATE DATA ANAK
            $anak->update([

                'nama'             => $request->nama,
                'jenis_kelamin'    => $request->jenis_kelamin,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'    => $request->tanggal_lahir,
                'golongan_darah'   => $request->golongan_darah,
                'alergi'           => $request->alergi,
                'foto'             => $foto

            ]);

            // UPDATE / CREATE SKRINING
            SkriningAnak::updateOrCreate(

                [
                    'anak_id' => $anak->id
                ],

                [
                    'berat_badan'           => $request->berat_badan,
                    'tinggi_badan'          => $request->tinggi_badan,
                    'alergi'                => $request->alergi,
                    'riwayat_penyakit'      => $request->riwayat_penyakit,
                    'kebutuhan_khusus'      => $request->kebutuhan_khusus,
                    'konsumsi_obat'         => $request->konsumsi_obat,
                    'riwayat_rawat_inap'    => $request->riwayat_rawat_inap,
                    'imunisasi_dasar'       => $request->imunisasi_dasar,
                    'catatan_orang_tua'     => $request->catatan_orang_tua
                ]

            );

            DB::commit();

            return back()->with('success', 'Data anak berhasil diperbarui');
        } catch (\Throwable $th) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $th->getMessage()
                );
        }
    }
}
