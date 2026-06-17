<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kuota;
use App\Models\Reguler;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Hash as Hash;

class HomeController extends Controller
{
    public function index()
    {
        $anak = Auth::user()->anak;
        $usiaBulan = null;
        $kategoriAnak = '-';

        if ($anak) {
            $usiaBulan = round(Carbon::parse($anak->tanggal_lahir)->diffInMonths(now(), true));
            $kategoriAnak = $usiaBulan < 18 ? 'Infant' : ($usiaBulan < 48 ? 'Toddler' : '-');
        }

        $besok = Carbon::tomorrow();

        $jadwal = $besok->isWeekend()
            ? collect()
            : Jadwal::whereDate('tanggal', $besok)->get();


        $total = new \stdClass();
        $total->kuota   = Kuota::where('tipe', 'reguler')->sum('kuota');
        $total->peserta = Reguler::where('status', 'true')->count();
        $total->sisa    = max($total->kuota - $total->peserta, 0);

        return view('pages.home', compact('anak', 'jadwal', 'kategoriAnak', 'total'));
    }

    public function profile()
    {
        return view('pages.profile', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'nip' => 'nullable',
            'jabatan' => 'nullable',
            'golongan' => 'nullable',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'golongan' => $request->golongan,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', Auth::user()->id)->update($data);

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
