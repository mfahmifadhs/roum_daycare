<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anak extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "anak";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'kode',
        'user_id',
        'paket_id',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'golongan_darah',
        'kondisi_kesehatan',
        'catatan_khusus',
        'foto'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paket() {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function paketReguler() {
        return $this->hasOne(Reguler::class, 'anak_id');
    }

    public function skrining() {
        return $this->hasOne(SkriningAnak::class, 'anak_id');
    }

    public function peserta() {
        return $this->hasMany(Peserta::class, 'anak_id');
    }
    
    public function laporan() {
        return $this->hasMany(Laporan::class, 'anak_id');
    }
}
