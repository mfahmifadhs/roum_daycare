<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Anak;
use App\Models\Jadwal;
use App\Models\Reguler;
use App\Models\Kuota;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $dataKuota   = Kuota::get();
        $dataReguler = Reguler::where('status', 'true')->get();
        $dataJadwal  = Jadwal::where('tanggal', today())->first();
        $dataInfant = 0;
        $dataToddlerLaki = 0;
        $dataToddlerPerempuan = 0;

        $hitungKategori = function ($items) {

            $result = (object) [
                'infant' => 0,
                'toddlerLaki' => 0,
                'toddlerPerempuan' => 0,
            ];

            foreach ($items as $item) {

                if (!$item->anak) {
                    continue;
                }

                $usiaBulan = Carbon::parse(
                    $item->anak->tanggal_lahir
                )->diffInMonths(now());

                if ($usiaBulan >= 3 && $usiaBulan < 24) {

                    $result->infant++;
                } elseif ($usiaBulan >= 24 && $usiaBulan <= 48) {

                    if ($item->anak->jenis_kelamin == 'L') {

                        $result->toddlerLaki++;
                    } else {

                        $result->toddlerPerempuan++;
                    }
                }
            }

            return $result;
        };

        $reguler = $hitungKategori($dataReguler);

        $jadwal = $hitungKategori(
            $dataJadwal?->peserta ?? collect()
        );

        $total = new \stdClass();
        $total->reguler = $dataReguler->count();
        $total->infant = $reguler->infant;
        $total->toddlerLaki = $reguler->toddlerLaki;
        $total->toddlerPerempuan = $reguler->toddlerPerempuan;
        $total->pesertaInfant = $jadwal->infant;
        $total->pesertaToddlerLaki = $jadwal->toddlerLaki;
        $total->pesertaToddlerPerempuan = $jadwal->toddlerPerempuan;

        $data = new \stdClass();
        $data->reguler = Reguler::get();
        $data->absen   = Absen::where('tanggal', today())->get();
        $data->jadwal  = Jadwal::where('tanggal', today())->first();
        $data->kuota   = Kuota::get();

        $kuota = new \stdClass();
        $kuota->infant           = $dataKuota->where('kategori', 'infant')->sum('kuota');
        $kuota->toddlerLaki      = $dataKuota->where('kategori', 'toddler')->where('jenis_kelamin', 'L')->sum('kuota');
        $kuota->toddlerPerempuan = $dataKuota->where('kategori', 'toddler')->where('jenis_kelamin', 'P')->sum('kuota');
        $kuota->infantReg = $dataKuota->where('kategori', 'infant')->where('tipe', 'reguler')->pluck('kuota')->first();
        $kuota->infantHarian = $dataKuota->where('kategori', 'infant')->where('tipe', 'harian')->pluck('kuota')->first();
        $kuota->toddlerLakiReg = $dataKuota->where('kategori', 'toddler')->where('tipe', 'reguler')->where('jenis_kelamin', 'L')->pluck('kuota')->first();
        $kuota->toddlerLakiHar = $dataKuota->where('kategori', 'toddler')->where('tipe', 'harian')->where('jenis_kelamin', 'L')->pluck('kuota')->first();
        $kuota->toddlerPerempuanReg = $dataKuota->where('kategori', 'toddler')->where('tipe', 'reguler')->where('jenis_kelamin', 'P')->pluck('kuota')->first();
        $kuota->toddlerPerempuanHar = $dataKuota->where('kategori', 'toddler')->where('tipe', 'harian')->where('jenis_kelamin', 'P')->pluck('kuota')->first();

        return view('pages.admin', compact('total', 'data', 'kuota'));
    }

    public function approve(Request $request, $aksi, $id)
    {
        $reguler = Reguler::findOrFail($id);

        if ($aksi == 'approve') {
            if (!$reguler->tanggal_wawancara && !$reguler->status) {
                $reguler->tanggal_wawancara = $request->tanggal_wawancara;
            }

            if ($reguler->tanggal_wawancara && $request->status == 'lolos') {
                Anak::where('id', $reguler->anak_id)->update([
                    'paket_id' => 1
                ]);
                $reguler->status = 'true';
            }
        }

        if ($aksi == 'reject') {
            if (!$reguler->tanggal_wawancara) {
                $reguler->keterangan = $request->keterangan;
                $reguler->status = $request->status;
            }

            if ($reguler->tanggal_wawancara) {
                $reguler->keterangan = $request->keterangan;
                $reguler->status = $request->status;
            }
        }

        $reguler->save();

        return redirect()->route('admin')->with('success', 'Status berhasil diubah');
    }
}
