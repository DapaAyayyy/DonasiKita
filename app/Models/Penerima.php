<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KampanyeSosial;

class Penerima extends Model
{
    protected $table = 'penerima';
    protected $primaryKey = 'id_penerima';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'kategori_penerima',
        'alamat',
        'no_hp',
        'deskripsi_kebutuhan',
    ];
    

    public function kampanye()
    {
        return $this->hasMany(KampanyeSosial::class, 'id_penerima', 'id_penerima');
    }
}
