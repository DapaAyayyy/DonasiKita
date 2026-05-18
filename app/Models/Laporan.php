<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KampanyeSosial;
use App\Models\Pengelola;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    public $timestamps = false;

    protected $fillable = [
        'id_kampanye',
        'id_pengelola',
        'judul_laporan',
        'isi_laporan',
        'file_lampiran',
    ];


    public function kampanye()
    {
        return $this->belongsTo(KampanyeSosial::class, 'id_kampanye', 'id_kampanye');
    }

    public function pengelola()
    {
        return $this->belongsTo(Pengelola::class, 'id_pengelola', 'id_pengelola');
    }
}
