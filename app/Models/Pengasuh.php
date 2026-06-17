<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengasuh extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "pengasuh";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'keterangan'
    ];

    public function jadwal() {
        return $this->hasMany(Jadwal::class, 'pengasuh_id');
    }
}
