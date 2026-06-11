<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AppNotification;
use App\Models\Logbook;
use App\Models\Plotting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogbookController extends Controller
{
    public function index()
    {
        $logbooks = auth()->user()->student
            ->logbooks()
            ->orderByDesc('tanggal')
            ->paginate(15);

        return view('mahasiswa.logbooks.index', compact('logbooks'));
    }

    public function create()
    {
        return view('mahasiswa.logbooks.create');
    }

    public function store(Request $request)
    {
        $student = auth()->user()->student;

        $request->validate([
            'tanggal' => 'required|date|before_or_equal:today',
            'kegiatan_harian' => 'required|string|min:10',
            'progress_persen' => 'required|integer|min:0|max:100',
        ]);

        // Prevent duplicate entry for same date
        if ($student->logbooks()->where('tanggal', $request->tanggal)->exists()) {
            return back()->with('error', 'Logbook untuk tanggal tersebut sudah ada.')->withInput();
        }

        $logbook = Logbook::create([
            'student_id' => $student->id,
            'tanggal' => $request->tanggal,
            'kegiatan_harian' => $request->kegiatan_harian,
            'progress_persen' => $request->progress_persen,
        ]);

        ActivityLog::log('logbook_create', "Mahasiswa {$student->nama_lengkap} mengisi logbook tanggal {$request->tanggal}");

        // Notify assigned lecturer
        $plotting = $student->plotting;
        if ($plotting) {
            $lecturerUser = $plotting->lecturer->user;
            AppNotification::create([
                'id' => Str::uuid(),
                'user_id' => $lecturerUser->id,
                'type' => 'logbook_entry',
                'title' => 'Logbook Baru',
                'message' => "{$student->nama_lengkap} telah mengisi logbook untuk tanggal {$request->tanggal}. Silakan review dan validasi.",
                'data' => json_encode(['logbook_id' => $logbook->id, 'student_id' => $student->id]),
            ]);
        }

        return redirect()->route('mahasiswa.logbooks.index')
            ->with('success', 'Logbook berhasil disimpan.');
    }
}
