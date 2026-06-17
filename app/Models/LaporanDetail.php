<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "laporan_detail";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'laporan_id',
        'kategori_id',
        'nilai',
        'keterangan'
    ];

    public function laporan() {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
