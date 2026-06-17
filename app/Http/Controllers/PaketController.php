<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Harian;
use App\Models\Reguler;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function store($tipe, $id)
    {
        if ($tipe === 'harian') {
            Anak::where('id', $id)->update(['paket_id' => '2']);

            $harianId = Harian::withTrashed()->count() + 1;
            $harian = new Harian();
            $harian->id = $harianId;
            $harian->paket_id = 2;
            $harian->anak_id = $id;
            $harian->tanggal_booking = now();
            $harian->status = 'true';
            $harian->save();

        } elseif ($tipe === 'reguler') {
            // Anak::where('id', $id)->update(['paket_id' => '1']);

            $regulerId = Reguler::withTrashed()->count() + 1;
            $reguler = new Reguler();
            $reguler->id = $regulerId;
            $reguler->paket_id = 1;
            $reguler->anak_id = $id;
            $reguler->tanggal_mulai = now();
            $reguler->tanggal_selesai = now()->addMonth(6);
            $reguler->save();
        } else {
            return redirect()->back()->with('error', 'Tipe paket tidak valid!');
        }


        return redirect()->back()->with('success', 'Paket berhasil disimpan!');
    }
}
