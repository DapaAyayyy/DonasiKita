<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Donasi;
class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';

    public $timestamps = false;

    protected $fillable = [
        'komentar',
        'id_donasi',
    ];



    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }
}