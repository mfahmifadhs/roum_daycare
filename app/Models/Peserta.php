<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peserta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "peserta";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'jadwal_id',
        'anak_id',
        'paket_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'keterangan',
        'status'
    ];

    public function jadwal() {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function anak() {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function paket() {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function laporan() {
        return $this->hasMany(Laporan::class, 'peserta_id');
    }
}
