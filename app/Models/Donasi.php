<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Donatur;
use App\Models\KampanyeSosial;
use App\Models\MetodePembayaran;
use App\Models\Feedback;
class Donasi extends Model
{
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';

    public $timestamps = false;

    protected $fillable = [
        'id_donatur',
        'id_kampanye',
        'id_metode',
        'nominal',
        'status_donasi',
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'id_donatur', 'id_donatur');
    }

    public function kampanye()
    {
        return $this->belongsTo(KampanyeSosial::class, 'id_kampanye', 'id_kampanye');
    }

    public function metodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class, 'id_metode', 'id_metode');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'id_donasi', 'id_donasi');
    }
}