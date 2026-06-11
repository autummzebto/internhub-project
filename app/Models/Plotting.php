<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plotting extends Model
{
    protected $fillable = [
        'student_id',
        'lecturer_id',
        'tahun_akademik',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
