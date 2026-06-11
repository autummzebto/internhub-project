<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = [
        'user_id',
        'nidn',
        'nama_dosen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plottings()
    {
        return $this->hasMany(Plotting::class);
    }

    public function assignedStudents()
    {
        return $this->hasManyThrough(
            Student::class,
            Plotting::class,
            'lecturer_id',
            'id',
            'id',
            'student_id'
        );
    }

    public function finalReports()
    {
        return $this->hasMany(FinalReport::class);
    }
}
