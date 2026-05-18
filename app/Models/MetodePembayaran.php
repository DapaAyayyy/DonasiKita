<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Donasi;

class MetodePembayaran extends Model
{
    protected $table = 'metode_pembayaran';
    protected $primaryKey = 'id_metode';

    public $timestamps = false;

    protected $fillable = [
        'nama_metode',
        'nomor_akun',
        'status_aktif',
    ];

    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'id_metode', 'id_metode');
    }
}
