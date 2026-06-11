<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Lecturer;
use App\Models\Plotting;
use App\Models\Student;
use Illuminate\Http\Request;

class PlottingController extends Controller
{
    public function index()
    {
        $plottings = Plotting::with('student.user', 'lecturer.user')
            ->latest()
            ->paginate(15);

        return view('admin.plottings.index', compact('plottings'));
    }

    public function create()
    {
        $students = Student::whereDoesntHave('plotting')->orderBy('nama_lengkap')->get();
        $lecturers = Lecturer::orderBy('nama_dosen')->get();

        return view('admin.plottings.create', compact('students', 'lecturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'tahun_akademik' => 'required|string|max:50',
        ]);

        // Check if student already has a plotting
        if (Plotting::where('student_id', $request->student_id)->exists()) {
            return back()->with('error', 'Mahasiswa sudah memiliki dosen pembimbing.')->withInput();
        }

        Plotting::create($request->only('student_id', 'lecturer_id', 'tahun_akademik'));

        $student = Student::find($request->student_id);
        $lecturer = Lecturer::find($request->lecturer_id);

        ActivityLog::log('admin_plotting', "Admin menugaskan {$student->nama_lengkap} ke dosen {$lecturer->nama_dosen}");

        return redirect()->route('admin.plottings.index')->with('success', 'Plotting berhasil dibuat.');
    }

    public function destroy(Plotting $plotting)
    {
        $plotting->delete();
        ActivityLog::log('admin_delete_plotting', "Admin menghapus plotting");
        return redirect()->route('admin.plottings.index')->with('success', 'Plotting berhasil dihapus.');
    }
}
