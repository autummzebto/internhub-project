<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index(Request $request)
    {
        $query = Lecturer::with('user');

        if ($request->filled('search')) {
            $query->where('nama_dosen', 'like', "%{$request->search}%")
                  ->orWhere('nidn', 'like', "%{$request->search}%");
        }

        $lecturers = $query->latest()->paginate(15);
        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        return view('admin.lecturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'nidn' => 'required|string|unique:lecturers,nidn',
            'nama_dosen' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->nama_dosen,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'dosen',
        ]);

        Lecturer::create([
            'user_id' => $user->id,
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
        ]);

        ActivityLog::log('admin_create_lecturer', "Admin membuat akun dosen: {$request->nama_dosen}");

        return redirect()->route('admin.lecturers.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Lecturer $lecturer)
    {
        $lecturer->load('user');
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $lecturer->user_id,
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|string|unique:lecturers,nidn,' . $lecturer->id,
        ]);

        $lecturer->user->update([
            'name' => $request->nama_dosen,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $lecturer->user->update(['password' => $request->password]);
        }

        $lecturer->update($request->only('nidn', 'nama_dosen'));

        ActivityLog::log('admin_update_lecturer', "Admin memperbarui data dosen: {$request->nama_dosen}");

        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Lecturer $lecturer)
    {
        $name = $lecturer->nama_dosen;
        $lecturer->user->delete();
        ActivityLog::log('admin_delete_lecturer', "Admin menghapus akun dosen: {$name}");
        return redirect()->route('admin.lecturers.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
