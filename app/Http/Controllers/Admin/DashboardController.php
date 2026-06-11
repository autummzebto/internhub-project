<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Company;
use App\Models\Logbook;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'total_lecturers' => Lecturer::count(),
            'total_companies' => Company::count(),
            'total_vacancies' => Vacancy::where('status_aktif', true)->count(),
            'pending_applications' => Application::where('status_lamaran', 'pending')->count(),
            'active_applications' => Application::where('status_lamaran', '!=', 'rejected')->count(),
            'total_logbooks' => Logbook::count(),
            'total_users' => User::count(),
        ];

        $recentApplications = Application::with('student.user', 'vacancy.company')
            ->latest()
            ->take(10)
            ->get();

        $recentLogbooks = Logbook::with('student')
            ->latest('tanggal')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications', 'recentLogbooks'));
    }
}
