<?php

namespace App\Http\Controllers;

use App\Models\Kuota;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function updateKuota(Request $request, $id)
    {
        $kuota = Kuota::findOrFail($id);
        $kuota->kuota = $request->kuota;
        $kuota->save();

        return redirect()->route('admin')->with('success', 'Kuota berhasil diperbarui.');
    }
}
