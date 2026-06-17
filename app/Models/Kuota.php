<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kuota extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "kuota";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'kategori',
        'tipe',
        'jenis_kelamin',
        'kuota',
        'keterangan'
    ];
}
