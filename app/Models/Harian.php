<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Harian extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "harian";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'paket_id',
        'anak_id',
        'tanggal_booking',
        'status',
        'keterangan'

    ];

    public function paket() {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
    
    public function anak() {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
}
