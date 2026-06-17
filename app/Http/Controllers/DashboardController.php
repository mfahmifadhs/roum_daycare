<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Laporan;
use App\Models\LaporanDetail;
use App\Models\Penalti;
use App\Models\Pengasuh;
use App\Models\Peserta;
use App\Models\Reguler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();

        
        $total = new \stdClass();
        $total->anak     = Anak::count();
        $total->pengasuh = Pengasuh::count();
        $total->reguler  = Reguler::whereNot('tanggal_selesai', '<=', today())->count();

        $belumCheckout = Peserta::whereDate('tanggal', $today)
            ->whereNotNull('waktu_masuk')
            ->whereNull('waktu_keluar')
            ->count();

        $penaltiAktif = Penalti::whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->count();

        $aktivitas = collect();

        // CHECK IN
        $checkin = Peserta::with('anak')
            ->whereDate('tanggal', $today)
            ->whereNotNull('waktu_masuk')
            ->latest('waktu_masuk')
            ->take(5)
            ->get()
            ->map(function ($item) {

                return (object)[
                    'judul' => $item->anak->nama . ' melakukan check in',
                    'created_at' => Carbon::parse($item->waktu_masuk)
                ];
            });

        // CHECK OUT
        $checkout = Peserta::with('anak')
            ->whereDate('tanggal', $today)
            ->whereNotNull('waktu_keluar')
            ->latest('waktu_keluar')
            ->take(5)
            ->get()
            ->map(function ($item) {

                return (object)[
                    'judul' => $item->anak->nama . ' melakukan check out',
                    'created_at' => Carbon::parse($item->waktu_keluar)
                ];
            });

        // LAPORAN
        $laporan = Laporan::with('anak')
            ->whereDate('tanggal', $today)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {

                return (object)[
                    'judul' => 'Laporan harian ' . $item->anak->nama . ' telah dibuat',
                    'created_at' => $item->created_at
                ];
            });

        $aktivitas = $checkin
            ->merge($checkout)
            ->merge($laporan)
            ->sortByDesc('created_at')
            ->take(10);

        $moodAnak = LaporanDetail::select(
            'nilai',
            DB::raw('count(*) as total')
        )
            ->whereHas('kategori', function ($q) {
                $q->where('kategori', 'mood');
            })
            ->groupBy('nilai')
            ->orderByDesc('total')
            ->get();

        $totalMood = $moodAnak->sum('total');

        // KONDISI ANAK
        $kondisiAnak = LaporanDetail::select(
            'nilai',
            DB::raw('count(*) as total')
        )
            ->whereHas('kategori', function ($q) {
                $q->where('kategori', 'kondisi');
            })
            ->groupBy('nilai')
            ->orderByDesc('total')
            ->get();

        $totalKondisi = $kondisiAnak->sum('total');

        $perkembanganAnak = LaporanDetail::select(
            'kategori_id',
            DB::raw('AVG(
            CASE
                WHEN nilai = "MB" THEN 1
                WHEN nilai = "BSH" THEN 2
                WHEN nilai = "BSB" THEN 3
                ELSE 0
            END
        ) as rata_nilai'),
            DB::raw('COUNT(*) as total')
        )
            ->with('kategori')
            ->whereHas('kategori', function ($q) {
                $q->where('kategori', 'perkembangan');
            })
            ->groupBy('kategori_id')
            ->get();

        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $jumlahHari = Carbon::create($tahun, $bulan)->daysInMonth;

        $grafikTanggal = [];
        $grafikHadir   = [];

        for ($i = 1; $i <= $jumlahHari; $i++) {

            $tanggal = Carbon::create($tahun, $bulan, $i);

            $grafikTanggal[] = $i;

            $grafikHadir[] = Peserta::whereDate('tanggal', $tanggal)
                ->whereNotNull('waktu_masuk')
                ->count();
        }

        return view('pages.dashboard', compact(
            'total',
            'belumCheckout',
            'penaltiAktif',
            'aktivitas',
            'kondisiAnak',
            'totalKondisi',
            'grafikTanggal',
            'grafikHadir',
            'bulan',
            'tahun',
            'moodAnak',
            'totalMood',
            'perkembanganAnak'
        ));
    }
}
