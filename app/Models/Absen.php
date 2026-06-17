<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absen extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "absen";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'anak_id',
        'tanggal',
        'check_in',
        'status_checkin',
        'check_out',
        'status_checkout',
        'paket_id',
        'keterangan',
        'status'
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function penalti()
    {
        return $this->hasOne(Penalti::class, 'absen_id');
    }

    public function penaltiHari()
    {
        if (!$this->penalti) {
            return 0;
        }

        return Carbon::parse($this->penalti->tanggal_mulai)
            ->diffInDays(
                Carbon::parse($this->penalti->tanggal_selesai)
            );
    }
}
