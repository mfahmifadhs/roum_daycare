<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "jadwal";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tanggal',
        'kuota',
        'keterangan'

    ];

    public function peserta() {
        return $this->hasMany(Peserta::class, 'jadwal_id');
    }
}
