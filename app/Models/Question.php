<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'konten_survei_id',
        'pertanyaan',
        'kategori',
        'type',
        'options',
        'foto',
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
