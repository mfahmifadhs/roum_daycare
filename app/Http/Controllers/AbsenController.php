<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Anak;
use App\Models\Penalti;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        $dataAbsen = Absen::with('anak.user')
        ->whereDate('created_at', Carbon::today())
        ->latest()
        ->get();

        return view('absen', compact('dataAbsen'));
    }

    public function store(Request $request)
    {
        $kode = $request->kode;

        $anak = Anak::where('kode', $kode)->first();

        if (!$anak) {
            return back()->with(
                'error',
                'Kode member tidak ditemukan'
            );
        }

        if (
            $anak->tanggal_pinalti &&
            now()->lt($anak->tanggal_pinalti)
        ) {

            return back()->with(
                'error',
                'Peserta sedang terkena pinalti'
            );
        }

        // CEK TERDAFTAR HARI INI
        $jadwalHariIni = Peserta::whereHas(
            'jadwal',
            function ($q) {
                $q->whereDate(
                    'tanggal',
                    today()
                );
            }
        )
            ->where('anak_id', $anak->id)
            ->whereNull('status')
            ->first();

        
        dd($jadwalHariIni);

        if (!$jadwalHariIni) {

            return back()->with(
                'error',
                'Peserta tidak terdaftar hari ini'
            );
        }

        $peserta = Peserta::where('jadwal_id', $jadwalHariIni->id)->first();

        $cekAbsen = Absen::where('tanggal', today())->where('anak_id', $anak->id)->first();

        // CEK KEHADIRAN
        if (!$cekAbsen && $jadwalHariIni) {
            $absenId = Absen::withTrashed()->count() + 1;
            Absen::firstOrCreate(
                [
                    'id'       => $absenId,
                    'anak_id'  => $anak->id,
                    'paket_id' => $anak->paket_id,
                    'tanggal'  => today(),
                    'check_in' => now()
                ],

                [
                    'status' => 'true'
                ]

            );

            if (now()->gt(today()->setTime(8, 0))) {
                Absen::where('id', $absenId)->update([
                    'status_checkin' => 'terlambat'
                ]);
            }


            return back()->with(
                'success',
                $anak->nama . ' check in berhasil'
            );
        }


        // CHECK OUT
        if (now()->gte(today()->setTime(14, 58))) {

            if ($cekAbsen->check_in && !$cekAbsen->check_out) {

                Absen::where('id', $cekAbsen->id)->update([
                    'check_out' => now()
                ]);

                Absen::where('id', $cekAbsen->id)->update([
                    'status_checkout' => 'terlambat'
                ]);

                // KHUSUS REGULER
                if ($anak->paket_id == 1) {
                    $penalti = new Penalti();
                    $penalti->id = Penalti::withTrashed()->count() + 1;
                    $penalti->absen_id = $cekAbsen->id;
                    $penalti->anak_id = $cekAbsen->anak_id;
                    $penalti->tanggal_mulai = now();
                    $penalti->tanggal_selesai = now()->addDay();
                    $penalti->alasan = 'terlambat pengambilan';
                    $penalti->save();
                }

                return back()->with(
                    'success',
                    $anak->nama . ' check out berhasil'
                );
            } else {
                return back()->with(
                    'error',
                    'Absen masuk tidak ditemukan'
                );
            }
        } else {
            return back()->with(
                'error',
                'Belum waktunya check out'
            );
        }
    }
}
