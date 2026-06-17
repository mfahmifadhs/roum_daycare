<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "laporan_kategori";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'kategori',
        'deskripsi',
        'keterangan',
        'keterangan'

    ];

    public function laporanDetail() {
        return $this->hasMany(LaporanDetail::class, 'kategori_id');
    }
}
