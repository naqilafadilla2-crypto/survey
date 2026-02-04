<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class konten_survei extends Model
{
    protected $table = 'konten_surveis';
    
    protected $fillable = [
        'judul',
        'pendahuluan',
        'indikator',
        'deskripsi_survei',
        'tujuan_1',
        'tujuan_2',
        'tujuan_3',
        'penutup',
        'tahun',
        'is_active',
    ];

    public function surveis()
    {
        return $this->hasMany(survei::class, 'konten_survei_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'konten_survei_id');
    }
}
