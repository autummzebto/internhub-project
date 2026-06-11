<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AppNotification;
use App\Models\FinalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FinalReportController extends Controller
{
    public function create()
    {
        $student = auth()->user()->student;
        $existingReport = $student->finalReports()->first();
        $plotting = $student->plotting;

        return view('mahasiswa.final-report.create', compact('student', 'existingReport', 'plotting'));
    }

    public function store(Request $request)
    {
        $student = auth()->user()->student;

        // Lock check - if report already submitted, cannot upload again
        if ($student->finalReports()->exists()) {
            return back()->with('error', 'Laporan akhir sudah pernah dikirim. Anda tidak dapat mengirim ulang.');
        }

        $plotting = $student->plotting;
        if (!$plotting) {
            return back()->with('error', 'Anda belum memiliki dosen pembimbing yang ditugaskan. Hubungi admin.');
        }

        $request->validate([
            'file_laporan' => 'required|file|mimes:pdf|max:5120',
        ]);

        $filePath = $request->file('file_laporan')->store('final_reports', 'public');

        FinalReport::create([
            'student_id' => $student->id,
            'lecturer_id' => $plotting->lecturer_id,
            'file_laporan_url' => $filePath,
            'submitted_at' => now(),
        ]);

        ActivityLog::log('final_report', "Mahasiswa {$student->nama_lengkap} mengirim laporan akhir");

        // Notify lecturer
        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $plotting->lecturer->user_id,
            'type' => 'final_report',
            'title' => 'Laporan Akhir Baru',
            'message' => "{$student->nama_lengkap} telah mengirimkan laporan akhir magang. Silakan review dan berikan penilaian.",
        ]);

        return redirect()->route('mahasiswa.final-report.create')
            ->with('success', 'Laporan akhir berhasil dikirim! Menunggu penilaian dosen.');
    }
}
