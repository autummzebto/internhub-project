<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'nim' => 'required|string|unique:students,nim',
            'nama_lengkap' => 'required|string|max:255',
            'jurusan' => 'required|in:Teknik Informatika,Sistem Informasi,Bisnis Digital',
        ]);

        $user = User::create([
            'name' => $request->name,
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

        ActivityLog::log('register', "Mahasiswa baru terdaftar: {$request->nama_lengkap}", $user->id);

        auth()->login($user);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Registrasi berhasil! Selamat datang di InternHub.');
    }
}
