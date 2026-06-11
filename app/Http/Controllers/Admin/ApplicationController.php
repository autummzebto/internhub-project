<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Application;
use App\Models\AppNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with('student.user', 'vacancy.company');

        if ($request->filled('status')) {
            $query->where('status_lamaran', $request->status);
        }

        $applications = $query->latest()->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function verify(Application $application)
    {
        if ($application->status_lamaran !== 'pending') {
            return back()->with('error', 'Lamaran ini sudah diproses sebelumnya.');
        }

        $application->update(['status_lamaran' => 'verified_by_admin']);

        ActivityLog::log('admin_verify', "Admin memverifikasi lamaran {$application->student->nama_lengkap}");

        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $application->student->user_id,
            'type' => 'application_verified',
            'title' => 'Lamaran Diverifikasi',
            'message' => "Lamaran Anda untuk posisi {$application->vacancy->posisi} di {$application->vacancy->company->company_name} telah diverifikasi oleh admin.",
        ]);

        return back()->with('success', 'Lamaran berhasil diverifikasi.');
    }

    public function accept(Application $application)
    {
        if ($application->status_lamaran !== 'verified_by_admin') {
            return back()->with('error', 'Lamaran harus diverifikasi terlebih dahulu.');
        }

        $application->update(['status_lamaran' => 'accepted_by_company']);

        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $application->student->user_id,
            'type' => 'application_accepted',
            'title' => 'Lamaran Diterima! 🎉',
            'message' => "Selamat! Lamaran Anda untuk posisi {$application->vacancy->posisi} di {$application->vacancy->company->company_name} telah diterima.",
        ]);

        ActivityLog::log('admin_accept', "Admin menerima lamaran {$application->student->nama_lengkap}");

        return back()->with('success', 'Lamaran berhasil diterima.');
    }

    public function reject(Application $application)
    {
        $application->update(['status_lamaran' => 'rejected']);

        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $application->student->user_id,
            'type' => 'application_rejected',
            'title' => 'Lamaran Ditolak',
            'message' => "Mohon maaf, lamaran Anda untuk posisi {$application->vacancy->posisi} di {$application->vacancy->company->company_name} tidak dapat diterima.",
        ]);

        ActivityLog::log('admin_reject', "Admin menolak lamaran {$application->student->nama_lengkap}");

        return back()->with('success', 'Lamaran berhasil ditolak.');
    }
}
