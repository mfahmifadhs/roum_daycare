<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function post(Request $request)
    {
        $login = $request->input('nip');
        $password = $request->input('password');

        $credentials = [
            function ($query) use ($login) {
                $query->where('nip', $login)
                    ->orWhere('nik', $login);
            },
            'password' => $password,
        ];

        if (auth()->attempt($credentials)) {
            $role = Auth::user()->role_id;
            if ($role == 4) {
                return redirect()->route('home')->with('success', 'Selamat Datang');
            } else {
                return redirect()->route('admin')->with('success', 'Selamat Datang');
            }
        }

        return back()->with('error', 'NIP atau Password salah');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
