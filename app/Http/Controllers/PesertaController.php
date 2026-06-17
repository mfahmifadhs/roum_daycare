<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Jadwal;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function detail()
    {
        $user = Auth::user();

        // ANAK USER
        $anak = Anak::where('user_id', $user->id)
            ->first();

        // JADWAL HARI INI
        $jadwal = Jadwal::with([
            'peserta.anak',
            'peserta.laporanHariIni'
        ])
            ->whereDate('tanggal', today())
            ->whereHas('peserta', function ($q) use ($anak) {

                $q->where('anak_id', $anak?->id);
            })
            ->first();

        // KEGIATAN
        $kegiatan = Kategori::where('kategori', 'kegiatan')
            ->orderBy('id')
            ->get();

        return view(
            'pages.user.jadwal.index',
            compact(
                'jadwal',
                'kegiatan',
                'anak'
            )
        );
    }
}
