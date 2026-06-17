<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utama;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $utama = Utama::all();
        return view('register', compact('utama'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'nama' => 'required',
        //     'nik' => 'required|unique:users,nik',
        //     'nip' => 'required|unique:users,nip',
        //     'jabatan' => 'required',
        //     'golongan' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'no_hp' => 'required|unique:users,no_hp',
        //     'username' => 'required|unique:users,username',
        //     'password' => 'required|min:6|confirmed',
        // ]);

        $userId = User::withTrashed()->count() + 1;

        $user = new User();
        $user->id = $userId;
        $user->role_id = $request->input('role_id') ?? 4; // Set role_id sesuai kebutuhan
        $user->uker_id = $request->input('uker_id');
        $user->nama = $request->input('nama');
        $user->nik = $request->input('nik');
        $user->nip = $request->input('nip');
        $user->jabatan = $request->input('jabatan');
        $user->golongan = $request->input('golongan');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
        $user->password = bcrypt($request->input('password'));
        $user->password_text = $request->input('password'); // Simpan password asli jika diperlukan
        $user->save();

        return redirect()->route('login')->with('success', 'Berhasil melakukan pendaftaran');
    }

    public function checkNip(Request $request)
    {
        $exists = User::where('nip', $request->nip)
            ->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
}
