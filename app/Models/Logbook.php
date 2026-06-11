<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $fillable = [
        'student_id',
        'tanggal',
        'kegiatan_harian',
        'progress_persen',
        'validasi_dosen',
        'komentar_dosen',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'validasi_dosen' => 'boolean',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
