<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'company_id',
        'posisi',
        'deskripsi_tugas',
        'persyaratan',
        'durasi_bulan',
        'kuota',
        'status_aktif',
    ];

    protected function casts(): array
    {
        return [
            'status_aktif' => 'boolean',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function acceptedApplicationsCount(): int
    {
        return $this->applications()->where('status_lamaran', 'accepted_by_company')->count();
    }

    public function isQuotaFull(): bool
    {
        return $this->acceptedApplicationsCount() >= $this->kuota;
    }
}
