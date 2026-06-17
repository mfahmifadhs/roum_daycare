<?php

namespace App\Http\Controllers;

use App\Models\Uker;
use Illuminate\Http\Request;

class UkerController extends Controller
{
    public function getUker($id)
    {
        $data = Uker::where('utama_id', $id)->get();
        return response()->json($data);
    }
}
