<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Donasi;
use App\Models\Leaderboard;

class Donatur extends Model
{
    protected $table = 'donatur';
    protected $primaryKey = 'id_donatur';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password_hash',
        'no_hp',
        'alamat',
    ];
    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'id_donatur', 'id_donatur');
    }

    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class, 'id_donatur', 'id_donatur');
    }
}
