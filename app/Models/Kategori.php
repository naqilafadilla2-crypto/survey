<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'urutan'
    ];

    /**
     * Relation dengan Question
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'kategori', 'nama');
    }
}
