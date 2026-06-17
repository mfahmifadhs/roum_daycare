<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'role_id',
        'uker_id',
        'nama',
        'nik',
        'nip',
        'jabatan',
        'golongan',
        'email',
        'no_hp',
        'password',
        'password_text'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function uker()
    {
        return $this->belongsTo(Uker::class, 'uker_id');
    }

    public function utama()
    {
        return $this->belongsTo(Uker::class, 'uker_id')->join('utama', 'utama.id', '=', 'uker.utama_id')->select('utama.*');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'uker_id');
    }

    public function anak()
    {
        return $this->hasOne(Anak::class, 'user_id');
    }
}
