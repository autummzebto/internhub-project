<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'bidang_industri',
        'lokasi',
        'deskripsi',
        'kontak_person',
        'status_aktif',
    ];

    protected function casts(): array
    {
        return [
            'status_aktif' => 'boolean',
        ];
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function activeVacancies()
    {
        return $this->vacancies()->where('status_aktif', true);
    }
}
