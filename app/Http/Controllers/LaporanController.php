<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\LaporanDetail;
use App\Models\Peserta;
use App\Models\Pengasuh;
use App\Models\Jadwal;
use App\Models\Anak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function create($id)
    {
        $peserta  = Peserta::where('id', $id)->first();
        $kategori = Kategori::get();
        $pengasuh = Pengasuh::get();
        return view('pages.laporan.create', compact('peserta', 'kategori', 'pengasuh'));
    }

    public function form(Request $request)
    {
        $jadwal = null;
        $pengasuh = null;
        $anak = null;
        $peserta = null;
        $laporan = 0;
        
        if ($request->tanggal) {
            $jadwal = Jadwal::where('tanggal', $request->tanggal)->first();
        }

        if ($request->kode_pengasuh) {
            $pengasuh = Pengasuh::where('kode', $request->kode_pengasuh)->first();
        }

        if ($request->kode_anak) {
            $anak = Anak::where('kode', $request->kode_anak)->first();
        }

        if ($jadwal && $anak) {
            $peserta = Peserta::where('jadwal_id', $jadwal->id)
                ->where('anak_id', $anak->id)
                ->first();
        }

        if ($request->all()) {
            if (!$peserta) {
                return back()->with('error', 'Data Anak tidak ditemukan');
            }

            if ($peserta) {
                $masuk  = $peserta->waktu_masuk;
                $pulang = $peserta->waktu_keluar;
                $laporan = Laporan::where('peserta_id', $peserta->id)->where('tanggal', $request->tanggal)->first();

                if (!$masuk || !$pulang) {
                    return back()->with('error', 'Belum dapat membuat laporan, Anak belum menyelesaikan absensi');
                }

                return view('laporan', compact('jadwal', 'anak', 'pengasuh', 'peserta', 'laporan'))->with('success', 'Data Anak ditemukan');
            }
        }        

        return view('laporan');
    }

    
    public function laporanCreate(Request $request, $id)
    {
        $peserta  = Peserta::where('id', $id)->first();
        $kategori = Kategori::get();
        $pengasuh = Pengasuh::where('kode', $request->kode_pengasuh)->first();

        return view('laporan-create', compact('peserta', 'kategori', 'pengasuh'));
    }
    

    public function store(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $laporanId = Laporan::withTrashed()->count() + 1;

            $laporan = Laporan::create([
                'id'                      => $laporanId,
                'peserta_id'              => $id,
                'jadwal_id'               => $request->jadwal_id,
                'anak_id'                 => $request->anak_id,
                'pengasuh_id'             => $request->pengasuh_id,
                'tanggal'                 => Carbon::today(),
                'suhu_datang'             => $request->suhu_datang,
                'suhu_pulang'             => $request->suhu_pulang,

                'minum_air'               => $request->minum_air,
                'selera_makan'            => $request->selera_makan,

                'toilet_pipis'            => $request->toilet_pipis,
                'toilet_pup'              => $request->toilet_pup,
                'kondisi_popok'           => $request->kondisi_popok,

                'informasi_orang_tua'     => $request->informasi_orang_tua,

                'catatan_kegiatan'        => $request->catatan_kegiatan,
                'catatan_makan'           => $request->catatan_makan,
                'catatan_kondisi'         => $request->catatan_kondisi,
                'catatan_makan_minum'     => $request->catatan_makan_minum,
                'catatan_toilet_training' => $request->catatan_toilet_training,

                'ttd_pengasuh'            => $request->ttd_pengasuh,
                'ttd_orangtua'           => $request->ttd_orangtua,
            ]);

            /*
        |--------------------------------------------------------------------------
        | KEGIATAN
        |--------------------------------------------------------------------------
        */

            if ($request->kegiatan) {

                foreach ($request->kegiatan as $kategoriId => $nilai) {

                    LaporanDetail::create([
                        'id'           => LaporanDetail::withTrashed()->count() + 1,
                        'laporan_id'   => $laporanId,
                        'kategori_id'  => $kategoriId,
                        'nilai'        => $nilai,
                        'keterangan'   => 'Kegiatan'
                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | MOOD
        |--------------------------------------------------------------------------
        */

            if ($request->mood) {
                $kategoriMood = Kategori::where('kategori', 'mood')->where('deskripsi', $request->mood)->first();

                LaporanDetail::create([
                    'id'           => LaporanDetail::withTrashed()->count() + 1,
                    'laporan_id'   => $laporanId,
                    'kategori_id'  => $kategoriMood->id,
                    'nilai'        => $request->mood,
                    'keterangan'   => 'Mood'
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | KONDISI
        |--------------------------------------------------------------------------
        */
            if ($request->kondisi_fisik) {

                foreach ($request->kondisi_fisik as $kategoriId => $nilai) {
                    $kategori = Kategori::where('kategori', 'kondisi')->where('deskripsi', $request->kondisi_fisik)->first();

                    LaporanDetail::create([
                        'id'          => LaporanDetail::withTrashed()->count() + 1,
                        'laporan_id'  => $laporanId,
                        'kategori_id' => $kategori->id,
                        'nilai'       => $nilai,
                        'keterangan'  => 'Kondisi'
                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | PERKEMBANGAN
        |--------------------------------------------------------------------------
        */

            if ($request->perkembangan) {

                foreach ($request->perkembangan as $nama => $nilai) {

                    $kategori = Kategori::where('kategori', 'perkembangan')->where('deskripsi', $nama)->first();

                    LaporanDetail::create([
                        'id'           => LaporanDetail::withTrashed()->count() + 1,
                        'laporan_id'   => $laporanId,
                        'kategori_id'  => $kategori->id,
                        'nilai'        => $nilai,
                        'keterangan'   => 'Perkembangan'
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('laporan')
                ->with('success', 'Laporan harian berhasil disimpan');

            // return redirect()
            //     ->route('laporan.detail', $laporanId)
            //     ->with('success', 'Laporan harian berhasil disimpan');
        } catch (\Throwable $th) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function detail($id)
    {
        $laporan = Laporan::where('id', $id)->first();
        return view('pages.laporan.detail', compact('laporan'));
    }

    public function homeDetail($id)
    {
        $laporan = Laporan::where('id', $id)->first();
        return view('laporan-detail', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = Laporan::with([
            'detail',
            'anak',
            'pengasuh'
        ])->findOrFail($id);

        $peserta = Peserta::where('id', $laporan->peserta_id)->first();
        $kegiatan = Kategori::where('kategori', 'kegiatan')->get();
        $mood = Kategori::where('kategori', 'mood')->get();
        $kondisi = Kategori::where('kategori', 'kondisi')->get();
        $perkembangan = Kategori::where('kategori', 'perkembangan')->get();
        $pengasuh = Pengasuh::get();

        return view('pages.laporan.edit', compact(
            'peserta',
            'laporan',
            'kegiatan',
            'mood',
            'kondisi',
            'perkembangan',
            'pengasuh'
        ));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $laporan = Laporan::findOrFail($id);

            $laporan->update([
                'pengasuh_id'             => $request->pengasuh_id,
                'minum_air'               => $request->minum_air,
                'selera_makan'            => $request->selera_makan,

                'toilet_pipis'            => $request->toilet_pipis,
                'toilet_pup'              => $request->toilet_pup,
                'kondisi_popok'           => $request->kondisi_popok,

                'informasi_orang_tua'     => $request->informasi_orang_tua,

                'catatan_kegiatan'        => $request->catatan_kegiatan,
                'catatan_makan'           => $request->catatan_makan,
                'catatan_kondisi'         => $request->catatan_kondisi,
                'catatan_makan_minum'     => $request->catatan_makan_minum,
                'catatan_toilet_training' => $request->catatan_toilet_training,

                'ttd_pengasuh'            => $request->ttd_pengasuh,
                'ttd_orangtua'            => $request->ttd_orangtua,
            ]);

            /*
        |--------------------------------------------------------------------------
        | KEGIATAN
        |--------------------------------------------------------------------------
        */
            if ($request->kegiatan) {
                foreach ($request->kegiatan as $kategoriId => $nilai) {
                    LaporanDetail::where('laporan_id', $id)->where('kategori_id', $kategoriId)->update([
                        'laporan_id'  => $id,
                        'kategori_id' => $kategoriId,
                        'nilai'       => $nilai,
                        'keterangan'  => 'Kegiatan'
                    ]);
                }
            }
            /*
        |--------------------------------------------------------------------------
        | MOOD
        |--------------------------------------------------------------------------
        */
            if ($request->mood) {
                $kategori = Kategori::where('id', $request->mood)->first();
                LaporanDetail::where('laporan_id', $id)->where('keterangan', 'Mood')->update([
                    'laporan_id'  => $id,
                    'kategori_id' => $kategori->id,
                    'nilai'       => $kategori->deskripsi,
                    'keterangan'  => 'Mood'
                ]);
            }
            /*
        |--------------------------------------------------------------------------
        | KONDISI
        |--------------------------------------------------------------------------
        */
            if ($request->has('kondisi_fisik')) {

                $kondisiLama = LaporanDetail::where('laporan_id', $laporan->id)
                    ->whereHas('kategori', function ($q) {
                        $q->where('kategori', 'kondisi');
                    })
                    ->pluck('kategori_id')
                    ->toArray();

                $kondisiBaru = $request->kondisi_fisik ?? [];

                sort($kondisiLama);
                sort($kondisiBaru);

                if ($kondisiLama != $kondisiBaru) {

                    LaporanDetail::where('laporan_id', $laporan->id)
                        ->whereHas('kategori', function ($q) {
                            $q->where('kategori', 'kondisi');
                        })
                        ->delete();

                    foreach ($kondisiBaru as $kategoriId) {

                        $kategori = Kategori::find($kategoriId);

                        LaporanDetail::create([
                            'id'          => LaporanDetail::withTrashed()->max('id') + 1,
                            'laporan_id'  => $laporan->id,
                            'kategori_id' => $kategoriId,
                            'nilai'       => $kategori->deskripsi,
                            'keterangan'  => 'Kondisi'
                        ]);
                    }
                }
            }

            /*
        |--------------------------------------------------------------------------
        | PERKEMBANGAN
        |--------------------------------------------------------------------------
        */
            if ($request->perkembangan) {
                foreach ($request->perkembangan as $kategoriId => $nilai) {
                    LaporanDetail::where('laporan_id', $id)->where('kategori_id', $kategoriId)->update([
                        'laporan_id'  => $id,
                        'kategori_id' => $kategoriId,
                        'nilai'       => $nilai,
                        'keterangan'  => 'Perkembangan'
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('laporan')
                ->with('success', 'Laporan harian berhasil disimpan');
            // return redirect()
            //     ->route('laporan.detail', $laporan->id)
            //     ->with('success', 'Laporan berhasil diperbarui');
        } catch (\Throwable $th) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }
}
