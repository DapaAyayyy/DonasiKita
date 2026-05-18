<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pengelola;
use App\Models\Penerima;
use App\Models\Donasi;
use App\Models\Laporan;

class KampanyeSosial extends Model
{
    protected $table = 'kampanye_sosial';
    protected $primaryKey = 'id_kampanye';

    public $timestamps = false;

    protected $fillable = [
        'id_pengelola',
        'id_penerima',
        'judul_kampanye',
        'deskripsi',
        'target_donasi',
        'foto_sampul',
        'deadline',
        'status',
    ];
    public function pengelola()
    {
        return $this->belongsTo(Pengelola::class, 'id_pengelola', 'id_pengelola');
    }

    public function penerima()
    {
        return $this->belongsTo(Penerima::class, 'id_penerima', 'id_penerima');
    }

    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'id_kampanye', 'id_kampanye');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_kampanye', 'id_kampanye');
    }
}
