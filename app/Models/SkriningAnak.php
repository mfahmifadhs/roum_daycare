<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkriningAnak extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "anak_skrining";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'anak_id',
        'berat_badan',
        'tinggi_badan',
        'alergi',
        'riwayat_penyakit',
        'kebutuhan_khusus',
        'konsumsi_obat',
        'riwayat_rawat_inap',
        'imunisasi_dasar',
        'catatan_orang_tua'
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
}
