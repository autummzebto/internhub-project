<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Application;
use App\Models\AppNotification;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = auth()->user()->student
            ->applications()
            ->with('vacancy.company')
            ->latest()
            ->paginate(10);

        return view('mahasiswa.applications.index', compact('applications'));
    }

    public function store(Request $request, Vacancy $vacancy)
    {
        $student = auth()->user()->student;

        // Check if already applied
        if ($student->applications()->where('vacancy_id', $vacancy->id)->exists()) {
            return back()->with('error', 'Anda sudah pernah melamar ke posisi ini.');
        }

        // Check quota
        if ($vacancy->isQuotaFull()) {
            return back()->with('error', 'Kuota untuk posisi ini sudah penuh.');
        }

        $request->validate([
            'dokumen_tambahan' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = [
            'student_id' => $student->id,
            'vacancy_id' => $vacancy->id,
            'tanggal_apply' => now()->toDateString(),
            'status_lamaran' => 'pending',
        ];

        if ($request->hasFile('dokumen_tambahan')) {
            $data['dokumen_tambahan_url'] = $request->file('dokumen_tambahan')
                ->store('documents', 'public');
        }

        Application::create($data);

        ActivityLog::log('apply', "Mahasiswa {$student->nama_lengkap} melamar ke {$vacancy->posisi} di {$vacancy->company->company_name}");

        // Notify admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            AppNotification::create([
                'id' => Str::uuid(),
                'user_id' => $admin->id,
                'type' => 'new_application',
                'title' => 'Lamaran Baru',
                'message' => "{$student->nama_lengkap} melamar posisi {$vacancy->posisi} di {$vacancy->company->company_name}",
            ]);
        }

        return redirect()->route('mahasiswa.applications.index')
            ->with('success', 'Lamaran berhasil dikirim! Silakan tunggu verifikasi admin.');
    }
}
