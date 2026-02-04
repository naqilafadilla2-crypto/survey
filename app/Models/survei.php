<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class survei extends Model
{
    protected $table = 'surveis';
    
    protected $fillable = [
        'pegawai_id',
        'konten_survei_id',
        'mode',
        'q1', 'q2', 'q3', 'q4', 'q5', 'q6',
        'q7', 'q8', 'q9', 'q10', 'q11', 'q12',
        'q13', 'q14', 'q15', 'q16', 'q17', 'q18',
        'saran',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class, 'pegawai_id');
    }

    public function kontenSurvei()
    {
        return $this->belongsTo(konten_survei::class, 'konten_survei_id');
    }
}
