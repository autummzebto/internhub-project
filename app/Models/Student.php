<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nim',
        'nama_lengkap',
        'jurusan',
        'cv_url',
        'portofolio_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class)->orderByDesc('tanggal');
    }

    public function finalReports()
    {
        return $this->hasMany(FinalReport::class);
    }

    public function plotting()
    {
        return $this->hasOne(Plotting::class)->latest();
    }

    public function plottings()
    {
        return $this->hasMany(Plotting::class);
    }

    public function assignedLecturer()
    {
        return $this->hasOneThrough(
            Lecturer::class,
            Plotting::class,
            'student_id',
            'id',
            'id',
            'lecturer_id'
        );
    }
}
