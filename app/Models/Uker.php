<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Uker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "unit_kerja";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'utama_id',
        'nama_uker'
    ];

    public function utama() {
        return $this->belongsTo(Utama::class, 'utama_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'uker_id');
    }
}
