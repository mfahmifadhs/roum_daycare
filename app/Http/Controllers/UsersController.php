<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Utama;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {

            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nip', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
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

        $users = $query->paginate(10);

        $data = new \stdClass();
        $data->utama = Utama::get();
        $data->role  = Role::get();

        return view('pages.users.show', compact('users', 'data'));
    }

    public function edit($id)
    {
        $user = User::with('uker')->findOrFail($id);

        $user->nik = (string) $user->nik;
        $user->nip = (string) $user->nip;

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::with('uker')->findOrFail($id);

        $user->role_id = $request->input('role_id');
        $user->uker_id = $request->input('uker_id');
        $user->nama = $request->input('nama');
        $user->nik = $request->input('nik');
        $user->nip = $request->input('nip');
        $user->jabatan = $request->input('jabatan');
        $user->golongan = $request->input('golongan');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
            $user->password_text = $request->input('password');
        }

        $user->save();

        return redirect()->back()->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}
