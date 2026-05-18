<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KampanyeSosial;
use App\Models\Laporan;

class Pengelola extends Model
{
    protected $table = 'pengelola';
    protected $primaryKey = 'id_pengelola';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password_hash',
        'no_hp',
        'role',
        'status',
    ];



    public function kampanye()
    {
        return $this->hasMany(KampanyeSosial::class, 'id_pengelola', 'id_pengelola');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_pengelola', 'id_pengelola');
    }
}
