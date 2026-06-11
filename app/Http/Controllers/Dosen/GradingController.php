<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AppNotification;
use App\Models\FinalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GradingController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user()->lecturer;
        $reports = $lecturer->finalReports()
            ->with('student.user')
            ->latest('submitted_at')
            ->paginate(10);

        return view('dosen.grading.index', compact('reports', 'lecturer'));
    }

    public function show(FinalReport $finalReport)
    {
        $lecturer = auth()->user()->lecturer;

        if ($finalReport->lecturer_id !== $lecturer->id) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        $finalReport->load('student.user');

        return view('dosen.grading.show', compact('finalReport', 'lecturer'));
    }

    public function grade(Request $request, FinalReport $finalReport)
    {
        $lecturer = auth()->user()->lecturer;

        if ($finalReport->lecturer_id !== $lecturer->id) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        $request->validate([
            'nilai_angka' => 'required|integer|min:0|max:100',
            'feedback_dosen' => 'nullable|string|max:2000',
        ]);

        $finalReport->update([
            'nilai_angka' => $request->nilai_angka,
            'feedback_dosen' => $request->feedback_dosen,
        ]);

        ActivityLog::log('grading', "Dosen {$lecturer->nama_dosen} memberikan nilai {$request->nilai_angka} kepada {$finalReport->student->nama_lengkap}");

        // Notify student
        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $finalReport->student->user_id,
            'type' => 'graded',
            'title' => 'Nilai Laporan Akhir',
            'message' => "Laporan akhir Anda telah dinilai. Nilai: {$request->nilai_angka}/100 ({$finalReport->fresh()->nilai_huruf})." .
                ($request->feedback_dosen ? " Feedback: {$request->feedback_dosen}" : ''),
        ]);

        return redirect()->route('dosen.grading.index')
            ->with('success', 'Nilai berhasil disimpan.');
    }

    public function download(FinalReport $finalReport)
    {
        $lecturer = auth()->user()->lecturer;

        if ($finalReport->lecturer_id !== $lecturer->id) {
            abort(403);
        }

        return Storage::disk('public')->download($finalReport->file_laporan_url);
    }
}
