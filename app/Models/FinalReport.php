<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalReport extends Model
{
    protected $fillable = [
        'student_id',
        'lecturer_id',
        'file_laporan_url',
        'nilai_angka',
        'feedback_dosen',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function getNilaiHurufAttribute(): string
    {
        if (is_null($this->nilai_angka)) return '-';

        return match (true) {
            $this->nilai_angka >= 85 => 'A',
            $this->nilai_angka >= 75 => 'B',
            $this->nilai_angka >= 65 => 'C',
            $this->nilai_angka >= 50 => 'D',
            default => 'E',
        };
    }
}
