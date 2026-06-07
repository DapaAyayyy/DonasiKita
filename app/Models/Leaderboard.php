<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Donatur;

class Leaderboard extends Model
{
    protected $table = 'leaderboard';
    protected $primaryKey = 'id_leaderboard';

    public $timestamps = false;

    protected $fillable = [
        'id_donatur',
        'total_donasi',
        'total_transaksi',
        'level',
    ];


    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'id_donatur', 'id_donatur');
    }
}
