<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "laporan";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'peserta_id',
        'jadwal_id',
        'anak_id',
        'pengasuh_id',
        'tanggal',
        'minum_air',
        'selera_makan',
        'toilet_pipis',
        'toilet_pup',
        'kondisi_popok',
        'informasi_orang_tua',
        'catatan_kegiatan',
        'catatan_makan',
        'catatan_kondisi',
        'catatan_makan_minum',
        'catatan_toilet_training',
        'ttd_pengasuh',
        'ttd_orangtua',

    ];

    public function jadwal() {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function anak() {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function pengasuh() {
        return $this->belongsTo(Pengasuh::class, 'pengasuh_id');
    }

    public function detail() {
        return $this->hasMany(LaporanDetail::class, 'laporan_id');
    }
}
