<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user()->lecturer;
        $plottings = $lecturer->plottings()
            ->with(['student.user', 'student.logbooks', 'student.finalReports'])
            ->get();

        $students = $plottings->map(function ($plotting) {
            $student = $plotting->student;
            return [
                'student' => $student,
                'plotting' => $plotting,
                'total_logbooks' => $student->logbooks->count(),
                'validated_logbooks' => $student->logbooks->where('validasi_dosen', true)->count(),
                'last_logbook' => $student->logbooks->sortByDesc('tanggal')->first(),
                'has_final_report' => $student->finalReports->isNotEmpty(),
                'final_report' => $student->finalReports->first(),
            ];
        });

        $stats = [
            'total_students' => $plottings->count(),
            'total_logbooks_pending' => $plottings->sum(fn($p) => $p->student->logbooks->where('validasi_dosen', false)->count()),
            'reports_to_grade' => $plottings->sum(fn($p) => $p->student->finalReports->where('nilai_angka', null)->count()),
        ];

        return view('dosen.dashboard', compact('students', 'stats', 'lecturer'));
    }
}
