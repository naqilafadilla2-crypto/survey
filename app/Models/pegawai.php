<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $table = 'pegawais';
    
    protected $fillable = [
        'nama',
        'direktorat',
        'divisi',
        'status_pegawai',
        'lama_bekerja',
    ];

    public function surveis()
    {
        return $this->hasMany(survei::class, 'pegawai_id');
    }
}
