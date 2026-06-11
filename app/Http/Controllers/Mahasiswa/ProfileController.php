<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $student = auth()->user()->student;
        return view('mahasiswa.profile.edit', compact('student'));
    }

    public function update(Request $request)
    {
        $student = auth()->user()->student;

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jurusan' => 'required|in:Teknik Informatika,Sistem Informasi,Bisnis Digital',
            'portofolio_url' => 'nullable|url|max:500',
            'cv_file' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->only('nama_lengkap', 'jurusan', 'portofolio_url');

        if ($request->hasFile('cv_file')) {
            // Delete old CV if exists
            if ($student->cv_url) {
                Storage::disk('public')->delete($student->cv_url);
            }
            $data['cv_url'] = $request->file('cv_file')->store('cv', 'public');
        }

        $student->update($data);

        ActivityLog::log('profile_update', "Mahasiswa {$student->nama_lengkap} memperbarui profil");

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
