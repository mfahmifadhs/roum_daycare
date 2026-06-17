<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penalti extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "penalti";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'absen_id',
        'anak_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status'
    ];

    public function anak() {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
}
