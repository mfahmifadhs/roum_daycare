<?php

namespace App\Http\Controllers;

use App\Models\Pengasuh;
use Illuminate\Http\Request;

class PengasuhController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengasuh::query();

        if ($request->search) {

            $query->where('nama', 'like', '%' . $request->search . '%');
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

        $pengasuh = $query->paginate(10);

        $data = new \stdClass();

        return view('pages.pengasuh.show', compact('pengasuh', 'data'));
    }

    public function edit($id)
    {
        $pengasuh = Pengasuh::findOrFail($id);
        return response()->json($pengasuh);
    }

    public function update(Request $request, $id)
    {
        $pengasuh = Pengasuh::findOrFail($id);

        $pengasuh->nama          = $request->input('nama');
        $pengasuh->jenis_kelamin = $request->input('jenis_kelamin');
        $pengasuh->tanggal_lahir = $request->input('tanggal_lahir');
        $pengasuh->no_hp         = $request->input('no_hp');
        $pengasuh->alamat        = $request->input('alamat');
        $pengasuh->save();

        return redirect()->back()->with('success', 'Berhasil memperbarui data!');
    }

    public function store(Request $request)
    {
        $pengasuhId = Pengasuh::withTrashed()->count() + 1;

        $pengasuh = new Pengasuh();
        $pengasuh->id            = $pengasuhId;
        $pengasuh->nama          = $request->input('nama') ?? 4; // Set role_id sesuai kebutuhan
        $pengasuh->jenis_kelamin = $request->input('jenis_kelamin');
        $pengasuh->tanggal_lahir = $request->input('tanggal_lahir');
        $pengasuh->no_hp         = $request->input('no_hp');
        $pengasuh->alamat        = $request->input('alamat');
        $pengasuh->save();

        return redirect()->back()->with('success', 'Berhasil melakukan pendaftaran');
    }

    public function destroy($id)
    {
        $pengasuh = Pengasuh::findOrFail($id);
        $pengasuh->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}
