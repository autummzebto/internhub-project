<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $student = $user->student;

        $stats = [
            'applications' => $student->applications()->count(),
            'accepted' => $student->applications()->where('status_lamaran', 'accepted_by_company')->count(),
            'logbooks' => $student->logbooks()->count(),
            'validated_logbooks' => $student->logbooks()->where('validasi_dosen', true)->count(),
            'has_final_report' => $student->finalReports()->exists(),
        ];

        $recentApplications = $student->applications()
            ->with('vacancy.company')
            ->latest()
            ->take(5)
            ->get();

        $recentLogbooks = $student->logbooks()
            ->latest('tanggal')
            ->take(5)
            ->get();

        $notifications = $user->appNotifications()
            ->where('is_read', false)
            ->take(5)
            ->get();

        return view('mahasiswa.dashboard', compact('student', 'stats', 'recentApplications', 'recentLogbooks', 'notifications'));
    }
}
