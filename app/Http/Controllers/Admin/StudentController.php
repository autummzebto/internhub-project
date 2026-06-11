<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }

        $students = $query->latest()->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:students,nim',
            'nama_lengkap' => 'required|string|max:255',
            'jurusan' => 'required|in:Teknik Informatika,Sistem Informasi,Bisnis Digital',
        ]);

        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'mahasiswa',
        ]);

        Student::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'jurusan' => $request->jurusan,
        ]);

        ActivityLog::log('admin_create_student', "Admin membuat akun mahasiswa: {$request->nama_lengkap}");

        return redirect()->route('admin.students.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Student $student)
    {
        $student->load('user');
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'nama_lengkap' => 'required|string|max:255',
            'jurusan' => 'required|in:Teknik Informatika,Sistem Informasi,Bisnis Digital',
            'nim' => 'required|string|unique:students,nim,' . $student->id,
        ]);

        $student->user->update([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $student->user->update(['password' => $request->password]);
        }

        $student->update($request->only('nim', 'nama_lengkap', 'jurusan'));

        ActivityLog::log('admin_update_student', "Admin memperbarui data mahasiswa: {$request->nama_lengkap}");

        return redirect()->route('admin.students.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $name = $student->nama_lengkap;
        $student->user->delete(); // Cascades to student
        ActivityLog::log('admin_delete_student', "Admin menghapus akun mahasiswa: {$name}");
        return redirect()->route('admin.students.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
