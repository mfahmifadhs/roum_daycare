<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Utama extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "unit_utama";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_utama'
    ];

    public function uker() {
        return $this->hasMany(Uker::class, 'utama_id');
    }
}
