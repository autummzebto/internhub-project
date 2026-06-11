<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'student_id',
        'vacancy_id',
        'dokumen_tambahan_url',
        'status_lamaran',
        'tanggal_apply',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_apply' => 'date',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_lamaran) {
            'pending' => 'Menunggu Verifikasi',
            'verified_by_admin' => 'Diverifikasi Admin',
            'accepted_by_company' => 'Diterima',
            'rejected' => 'Ditolak',
            default => 'Unknown',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status_lamaran) {
            'pending' => 'yellow',
            'verified_by_admin' => 'blue',
            'accepted_by_company' => 'green',
            'rejected' => 'red',
            default => 'gray',
        };
    }
}
