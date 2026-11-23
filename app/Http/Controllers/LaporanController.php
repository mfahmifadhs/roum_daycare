<?php

namespace App\Http\Controllers;

use App\Models\Absen;
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
use Barryvdh\DomPDF\Facade\Pdf;

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

            if ($request->mood_datang) {
                $kategoriMood = Kategori::where('kategori', 'mood')->where('deskripsi', $request->mood_datang)->first();

                LaporanDetail::create([
                    'id'           => LaporanDetail::withTrashed()->count() + 1,
                    'laporan_id'   => $laporanId,
                    'kategori_id'  => $kategoriMood->id,
                    'nilai'        => $request->mood_datang,
                    'keterangan'   => 'Mood',
                    'tahap'        => 'Datang'
                ]);
            }

            if ($request->mood_pulang) {
                $kategoriMood = Kategori::where('kategori', 'mood')->where('deskripsi', $request->mood_pulang)->first();

                LaporanDetail::create([
                    'id'           => LaporanDetail::withTrashed()->count() + 1,
                    'laporan_id'   => $laporanId,
                    'kategori_id'  => $kategoriMood->id,
                    'nilai'        => $request->mood_pulang,
                    'keterangan'   => 'Mood',
                    'tahap'        => 'Pulang'
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | KONDISI
        |--------------------------------------------------------------------------
        */
            if ($request->kondisi_fisik_datang) {
                foreach ($request->kondisi_fisik_datang as $kategoriId => $nilai) {
                    $kategori = Kategori::where('kategori', 'kondisi')->where('deskripsi', $request->kondisi_fisik_datang)->first();

                    LaporanDetail::create([
                        'id'          => LaporanDetail::withTrashed()->count() + 1,
                        'laporan_id'  => $laporanId,
                        'kategori_id' => $kategori->id,
                        'nilai'       => $nilai,
                        'keterangan'  => 'Kondisi',
                        'tahap'       => 'Datang'
                    ]);
                }
            }

            if ($request->kondisi_fisik_pulang) {
                foreach ($request->kondisi_fisik_pulang as $kategoriId => $nilai) {
                    $kategori = Kategori::where('kategori', 'kondisi')->where('deskripsi', $request->kondisi_fisik_pulang)->first();

                    LaporanDetail::create([
                        'id'          => LaporanDetail::withTrashed()->count() + 1,
                        'laporan_id'  => $laporanId,
                        'kategori_id' => $kategori->id,
                        'nilai'       => $nilai,
                        'keterangan'  => 'Kondisi',
                        'tahap'       => 'Pulang'
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
                ->route('home.laporan.detail', $laporanId)
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

    public function cetakBulanan(Request $request, $id)
    {
        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1),
        ]);

        $anak = Anak::with('user')->findOrFail($id);

        $bulan = (int) $request->bulan;
        $tahun = (int) $request->tahun;

        $tanggalAwal = Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $tanggalAkhir = $tanggalAwal->copy()->endOfMonth();

        $start = $tanggalAwal->toDateString();
        $end = $tanggalAkhir->toDateString();

        // ==========================================
        // 1. KEHADIRAN BULANAN
        // ==========================================

        $totalHari = $tanggalAwal->daysInMonth;

        $totalHariDatang = Absen::where('anak_id', $id)
            ->whereBetween('tanggal', [$start, $end])
            ->distinct()
            ->count('tanggal');

        $totalHariTidakDatang = max(0, $totalHari - $totalHariDatang);

        // ==========================================
        // 2. AMBIL LAPORAN BULANAN
        // ==========================================

        $laporan = Laporan::with('detail.kategori')
            ->where('anak_id', $id)
            ->whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal')
            ->get();

        $laporanIds = $laporan->pluck('id');

        $detail = LaporanDetail::with('kategori')
            ->whereIn('laporan_id', $laporanIds)
            ->get();

        // ==========================================
        // 3. RINGKASAN AKTIVITAS BULANAN
        // ==========================================

        $aktivitas = LaporanDetail::with('kategori', 'laporan')
            ->whereHas('kategori', function ($q) {
                $q->where('kategori', 'kegiatan');
            })
            ->whereHas('laporan', function ($q) use ($id, $start, $end) {
                $q->where('anak_id', $id)
                    ->whereBetween('tanggal', [$start, $end]);
            })
            ->select(
                'kategori_id',
                'nilai',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('kategori_id', 'nilai')
            ->get()
            ->groupBy('kategori_id');

        $rekapAktivitas = [];

        foreach ($aktivitas as $kategoriId => $items) {

            $namaKegiatan = optional($items->first()->kategori)->deskripsi
                ?? optional($items->first()->kategori)->nama
                ?? '-';

            $rekapAktivitas[] = [
                'kegiatan'       => $namaKegiatan,
                'sangat_baik'    => $items->where('nilai', 'Sangat Baik')->sum('total'),
                'baik'           => $items->where('nilai', 'Baik')->sum('total'),
                'cukup'          => $items->where('nilai', 'Cukup')->sum('total'),
                'pendampingan'   => $items->where('nilai', 'Pendampingan')->sum('total'),
            ];
        }

        // ==========================================
        // 4. RINGKASAN MOOD DAN KONDISI
        // ==========================================

        $moodKondisi = $detail
            ->filter(function ($item) {
                return in_array(
                    strtolower($item->kategori->kategori ?? ''),
                    ['mood', 'kondisi']
                );
            })
            ->groupBy(function ($item) {
                return strtolower($item->kategori->kategori ?? '') . '|' .
                    ($item->tahap ?? 'Tidak Ditentukan') . '|' .
                    $item->nilai;
            })
            ->map(function ($items) {
                return $items->count();
            });

        // ==========================================
        // 5. RINGKASAN PERKEMBANGAN
        // ==========================================

        $perkembangan = $detail
            ->filter(function ($item) {
                return strtolower($item->kategori->kategori ?? '') == 'perkembangan';
            });

        $totalPenilaian = $perkembangan->count();

        $totalBSB = $perkembangan->where('nilai', 'BSB')->count();
        $totalBSH = $perkembangan->where('nilai', 'BSH')->count();
        $totalMB  = $perkembangan->where('nilai', 'MB')->count();

        // ==========================================
        // 6. RINGKASAN MAKAN DAN MINUM
        // ==========================================

        $ringkasanMakan = $laporan
            ->pluck('selera_makan')
            ->filter()
            ->countBy();

        $ringkasanMinum = $laporan
            ->pluck('minum_air')
            ->filter()
            ->countBy();

        // ==========================================
        // 7. RINGKASAN TOILET TRAINING
        // ==========================================

        $ringkasanPipis = $laporan
            ->pluck('toilet_pipis')
            ->filter()
            ->countBy();

        $ringkasanPup = $laporan
            ->pluck('toilet_pup')
            ->filter()
            ->countBy();

        $ringkasanPopok = $laporan
            ->pluck('kondisi_popok')
            ->filter()
            ->countBy();

        // ==========================================
        // 8. INFORMASI UNTUK ORANG TUA
        // ==========================================

        $informasiOrangTua = $laporan
            ->whereNotNull('informasi_orang_tua')
            ->where('informasi_orang_tua', '!=', '')
            ->values();

        // ==========================================
        // 9. CATATAN TAMBAHAN
        // ==========================================

        $catatanMakan = $laporan
            ->whereNotNull('catatan_makan')
            ->where('catatan_makan', '!=', '')
            ->values();

        $catatanMakanMinum = $laporan
            ->whereNotNull('catatan_makan_minum')
            ->where('catatan_makan_minum', '!=', '')
            ->values();

        $catatanToilet = $laporan
            ->whereNotNull('catatan_toilet_training')
            ->where('catatan_toilet_training', '!=', '')
            ->values();

        // ==========================================
        // 10. GENERATE PDF
        // ==========================================

        Carbon::setLocale('id');

        $namaBulan = $tanggalAwal->translatedFormat('F');

        $pdf = Pdf::loadView('pages.laporan.pdf.bulanan', compact(
            'anak',
            'bulan',
            'tahun',
            'namaBulan',
            'tanggalAwal',
            'tanggalAkhir',
            'totalHari',
            'totalHariDatang',
            'totalHariTidakDatang',
            'laporan',
            'aktivitas',
            'moodKondisi',
            'totalPenilaian',
            'totalBSB',
            'totalBSH',
            'totalMB',
            'rekapAktivitas',
            'ringkasanMakan',
            'ringkasanMinum',
            'ringkasanPipis',
            'ringkasanPup',
            'ringkasanPopok',
            'informasiOrangTua',
            'catatanMakan',
            'catatanMakanMinum',
            'catatanToilet'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream(
            'Laporan-Bulanan-' . $anak->nama . '-' . $namaBulan . '-' . $tahun . '.pdf'
        );
    }
}
