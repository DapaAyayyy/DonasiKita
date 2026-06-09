<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengelola;
use App\Models\Penerima;
use App\Models\Donasi;
use App\Models\Laporan;

class KampanyeSosial extends Model
{   
    use HasFactory;
    
    protected $table = 'kampanye_sosial';
    protected $primaryKey = 'id_kampanye';

    public $timestamps = false;

    protected $fillable = [
        'id_pengelola',
        'id_penerima',
        'judul_kampanye',
        'deskripsi',
        'target_donasi',
        'terkumpul',
        'foto_sampul',
        'deadline',
        'status',
    ];

    public function getKategoriVirtualAttribute(): string
    {
        $text = strtolower(implode(' ', [
            $this->judul_kampanye ?? '',
            $this->deskripsi ?? '',
            $this->penerima->nama ?? '',
            $this->penerima->kategori_penerima ?? '',
            $this->penerima->deskripsi_kebutuhan ?? '',
        ]));

        $kategoriMap = [
            'bencana' => ['banjir', 'longsor', 'kekeringan', 'korban', 'darurat', 'air bersih'],
            'pendidikan' => ['sekolah', 'pendidikan', 'mahasiswa', 'beasiswa', 'belajar'],
            'kesehatan' => ['pengobatan', 'penyakit', 'medis', 'obat', 'rumah sakit'],
        ];

        foreach ($kategoriMap as $kategori => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($text, $keyword)) {
                    return $kategori;
                }
            }
        }

        return 'sosial';
    }

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

    public function kampanyeSosial()
    {
    return $this->belongsTo(KampanyeSosial::class, 'id_kampanye', 'id_kampanye');
    }
}
