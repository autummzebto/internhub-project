<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AppNotification;
use App\Models\Logbook;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogbookController extends Controller
{
    public function index(Student $student)
    {
        $lecturer = auth()->user()->lecturer;

        // Ensure this student is assigned to this lecturer
        $isAssigned = $lecturer->plottings()->where('student_id', $student->id)->exists();
        if (!$isAssigned) {
            abort(403, 'Anda tidak memiliki akses ke data mahasiswa ini.');
        }

        $logbooks = $student->logbooks()->orderByDesc('tanggal')->paginate(15);

        return view('dosen.logbooks.index', compact('student', 'logbooks'));
    }

    public function validate_entry(Request $request, Logbook $logbook)
    {
        $lecturer = auth()->user()->lecturer;

        // Ensure this logbook's student is assigned to this lecturer
        $isAssigned = $lecturer->plottings()->where('student_id', $logbook->student_id)->exists();
        if (!$isAssigned) {
            abort(403, 'Anda tidak memiliki akses ke data mahasiswa ini.');
        }

        $request->validate([
            'komentar_dosen' => 'nullable|string|max:1000',
        ]);

        $logbook->update([
            'validasi_dosen' => true,
            'komentar_dosen' => $request->komentar_dosen,
        ]);

        ActivityLog::log('logbook_validate', "Dosen {$lecturer->nama_dosen} memvalidasi logbook mahasiswa {$logbook->student->nama_lengkap}");

        // Notify student
        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $logbook->student->user_id,
            'type' => 'logbook_validated',
            'title' => 'Logbook Divalidasi',
            'message' => "Logbook tanggal {$logbook->tanggal->format('d/m/Y')} telah divalidasi oleh {$lecturer->nama_dosen}." .
                ($request->komentar_dosen ? " Komentar: {$request->komentar_dosen}" : ''),
        ]);

        return back()->with('success', 'Logbook berhasil divalidasi.');
    }
}
