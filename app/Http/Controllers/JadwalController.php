<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Jadwal;
use App\Models\Kategori;
use App\Models\Kuota;
use App\Models\Pengasuh;
use App\Models\Peserta;
use App\Models\Reguler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::query();
        $pengasuh = Pengasuh::get();

        // FILTER BULAN
        if ($request->bulan) {
            $query->whereMonth(
                'tanggal',
                $request->bulan
            );
        }

        // FILTER TAHUN
        if ($request->tahun) {

            $query->whereYear(
                'tanggal',
                $request->tahun
            );
        }

        // SORTING
        if ($request->sort == 'terlama') {
            $query->orderBy('tanggal', 'asc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        $jadwal = $query->paginate(10);
        $kuota  = Kuota::whereIn('tipe', ['reguler', 'harian'])->sum('kuota');

        return view('pages.jadwal.show', compact('jadwal', 'pengasuh', 'kuota'));
    }

    public function detail($id)
    {
        $jadwal = Jadwal::where('id', $id)->first();
        $kategori = Kategori::where('kategori', 'kegiatan')->get();
        return view('pages.jadwal.detail', compact('jadwal', 'kategori'));
    }

    public function detailModal($id)
    {
        $jadwal = Jadwal::with([
            'pengasuh',
            'peserta' => function ($query) {
                $query->with('anak', 'paket');
            }
        ])->whereDate('tanggal', $id)->first();

        $peserta = [];

        foreach ($jadwal->peserta as $item) {

            $tanggal = $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)
                ->locale('id')
                ->isoFormat('D MMMM Y') : '';

            $usia = Carbon::parse($item->anak->tanggal_lahir)->diff(now())->y . ' Tahun ' . Carbon::parse($item->anak->tanggal_lahir)->diff(now())->m . ' Bulan';

            $peserta[] = [
                'nama_anak' => $item->anak->nama . ' (' . $usia . ')',
                'nama_ortu' => $item->anak->user->nama,
                'paket'     => ucfirst($item->paket->tipe),
                'tanggal'   => $tanggal,
                'masuk'     => $item->tanggal ? $tanggal . '<br>' . $item->waktu_masuk : '',
                'keluar'    => $item->waktu_masuk ? $tanggal . '<br>' . $item->waktu_keluar : '',
                'status'    => ucfirst($item->status),
            ];
        }

        return response()->json([
            'tanggal' => \Carbon\Carbon::parse($jadwal->tanggal)
                ->locale('id')
                ->isoFormat('dddd, D MMMM Y'),

            'kuota'         => $jadwal->kuota,
            'total_peserta' => count($peserta),
            'pengasuh'      => $jadwal->pengasuh->nama ?? '-',
            'peserta'       => $peserta,

            'status' => $jadwal->status == 'true'
                ? '<span class="badge bg-success-subtle text-success rounded-pill px-3">Aktif</span>'
                : ($jadwal->status == 'false'
                    ? '<span class="badge bg-danger-subtle text-danger rounded-pill px-3">Non-Aktif</span>'
                    : '<span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">-</span>'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'tanggal'      => 'required|date',
            'kuota'        => 'required|integer',
            'pengasuh_id'  => 'required',
            'jenis_input'  => 'required',

        ]);

        $tanggal = \Carbon\Carbon::parse($request->tanggal);

        if (Jadwal::whereDate('tanggal', $tanggal->format('Y-m-d'))->exists()) {
            return back()->with(
                'error',
                'Jadwal sudah tersedia'
            );
        }

        $jumlahHari = (int) $request->jenis_input;

        $hariKerja = 0;
        $reguler = Reguler::where('status', 'true')->get();

        while ($hariKerja < $jumlahHari) {

            if (!$tanggal->isWeekend()) {

                $cek = Jadwal::whereDate(
                    'tanggal',
                    $tanggal->format('Y-m-d')
                )->exists();

                if (!$cek) {
                    $jadwalId = Jadwal::withTrashed()->count() + 1;

                    Jadwal::create([
                        'id'           => $jadwalId,
                        'tanggal'      => $tanggal->format('Y-m-d'),
                        'kuota'        => $request->kuota,
                        'pengasuh_id'  => $request->pengasuh_id,
                        'status'       => 'buka',

                    ]);
                }

                $hariKerja++;
            }

            $tanggal->addDay();

            foreach ($reguler as $item) {
                $pesertaId = Peserta::withTrashed()->count() + 1;

                Peserta::create([
                    'id'            => $pesertaId,
                    'anak_id'       => $item->id,
                    'jadwal_id'     => $jadwalId,
                    'paket_id'      => $item->paket_id,
                    'tanggal'       => null,
                    'waktu_masuk'   => null,
                    'waktu_keluar'  => null,
                    'status'        => null,
                ]);
            }
        }


        return back()->with(
            'success',
            'Jadwal berhasil ditambahkan'
        );
    }

    public function edit($id)
    {
        $jadwal = Jadwal::with('pengasuh')->findOrFail($id);
        return response()->json($jadwal);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'      => 'required|date',
            'kuota'        => 'required|integer',
            'pengasuh_id'  => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return back()->with(
            'success',
            'Jadwal berhasil diupdate'
        );
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return back()->with(
            'success',
            'Jadwal berhasil dihapus'
        );
    }

    public function daftar($id)
    {
        $jadwal = Jadwal::with('peserta')
            ->findOrFail($id);

        $anak = Auth::user()->anak;

        /*
    |--------------------------------------------------------------------------
    | VALIDASI DATA ANAK
    |--------------------------------------------------------------------------
    */
        if (!$anak) {

            return back()->with(
                'error',
                'Data anak belum tersedia'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | VALIDASI REGULER
    |--------------------------------------------------------------------------
    */

        $reguler = Reguler::where(
            'anak_id',
            $anak->id
        )->latest()->first();

        if ($reguler) {

            // LOLOS REGULER
            if ($reguler->status == 'true') {

                return back()->with(
                    'error',
                    'Peserta reguler tidak dapat mendaftar penitipan harian'
                );
            }

            // TMS
            if (
                strtolower($reguler->keterangan ?? '') ==
                'tidak memenuhi syarat'
            ) {

                return back()->with(
                    'error',
                    'Anak tidak memenuhi syarat penitipan'
                );
            }
        }

        /*
    |--------------------------------------------------------------------------
    | VALIDASI USIA
    |--------------------------------------------------------------------------
    */

        $usiaBulan = Carbon::parse(
            $anak->tanggal_lahir
        )->diffInMonths(now());

        if ($usiaBulan < 3 || $usiaBulan > 48) {

            return back()->with(
                'error',
                'Usia anak tidak memenuhi syarat penitipan'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | VALIDASI SUDAH TERDAFTAR
    |--------------------------------------------------------------------------
    */

        $cek = Peserta::where(
            'jadwal_id',
            $jadwal->id
        )->where(
            'anak_id',
            $anak->id
        )->exists();

        if ($cek) {

            return back()->with(
                'error',
                'Anak sudah terdaftar pada jadwal ini'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | VALIDASI KUOTA TOTAL
    |--------------------------------------------------------------------------
    */

        $totalPeserta = Peserta::where(
            'jadwal_id',
            $jadwal->id
        )->count();

        if ($totalPeserta >= $jadwal->kuota) {

            return back()->with(
                'error',
                'Kuota penitipan sudah penuh'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | HITUNG KUOTA HARIAN
    |--------------------------------------------------------------------------
    */

        $pesertaHarian = Peserta::with('anak')
            ->where('jadwal_id', $jadwal->id)
            ->where('paket_id', 2)
            ->get();

        $infant = 0;
        $toddlerL = 0;
        $toddlerP = 0;

        foreach ($pesertaHarian as $item) {

            if (!$item->anak) {
                continue;
            }

            $usia = Carbon::parse(
                $item->anak->tanggal_lahir
            )->diffInMonths(now());

            if ($usia >= 3 && $usia < 24) {

                $infant++;
            } elseif ($usia >= 24 && $usia <= 48) {

                if ($item->anak->jenis_kelamin == 'L') {

                    $toddlerL++;
                } else {

                    $toddlerP++;
                }
            }
        }

        /*
    |--------------------------------------------------------------------------
    | VALIDASI KATEGORI
    |--------------------------------------------------------------------------
    */

        if ($usiaBulan >= 3 && $usiaBulan < 24) {

            if ($infant >= 2) {

                return back()->with(
                    'error',
                    'Kuota Infant Harian sudah penuh'
                );
            }
        } elseif ($usiaBulan >= 24 && $usiaBulan <= 48) {

            if (
                $anak->jenis_kelamin == 'L' &&
                $toddlerL >= 3
            ) {

                return back()->with(
                    'error',
                    'Kuota Toddler Laki-laki sudah penuh'
                );
            }

            if (
                $anak->jenis_kelamin == 'P' &&
                $toddlerP >= 3
            ) {

                return back()->with(
                    'error',
                    'Kuota Toddler Perempuan sudah penuh'
                );
            }
        }

        /*
    |--------------------------------------------------------------------------
    | SIMPAN PESERTA
    |--------------------------------------------------------------------------
    */

        Peserta::create([

            'id' => Peserta::withTrashed()->count() + 1,

            'jadwal_id' => $jadwal->id,

            'anak_id' => $anak->id,

            'paket_id' => 2

        ]);

        return back()->with(
            'success',
            'Berhasil mendaftar penitipan harian'
        );
    }

    public function updatePeserta($id)
    {
        $reguler = Anak::where('paket_id', 1)->get();
        foreach ($reguler as $item) {
            $pesertaId = Peserta::withTrashed()->count() + 1;

            $cek = Peserta::where('jadwal_id', $id)
                ->where('anak_id', $item->id)
                ->exists();

            if (!$cek) {
                Peserta::create([
                    'id'            => $pesertaId,
                    'anak_id'       => $item->id,
                    'jadwal_id'     => $id,
                    'paket_id'      => $item->paket_id,
                    'tanggal'       => null,
                    'waktu_masuk'   => null,
                    'waktu_keluar'  => null,
                    'status'        => null,
                ]);
            }
        }

        return back()->with(
            'success',
            'Data peserta berhasil diperbarui'
        );
    }

    public function cancel($id)
    {
        $jadwal = Jadwal::findOrFail($id);;
        $anak = auth()->user()->anak;

        Peserta::where('jadwal_id', $id)->where('anak_id', $anak->id)->delete();

        $peserta = Peserta::where('jadwal_id', $id)
            ->where('anak_id', $anak->id)
            ->first();

        $jadwal = Jadwal::findOrFail($id);

        $batas = Carbon::parse($jadwal->tanggal)
            ->setTime(8, 0);

        if (now()->gte($batas)) {
            return back()->with(
                'error',
                'Jadwal tidak dapat dibatalkan setelah jam 08.00'
            );
        }

        return back()->with(
            'success',
            'Jadwal berhasil dibatalkan'
        );
    }
}
