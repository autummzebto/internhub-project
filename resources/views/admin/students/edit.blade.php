@extends('layouts.app')
@section('title', 'Edit Mahasiswa')
@section('page-title', 'Edit Mahasiswa')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection

@section('content')
<div class="max-w-2xl animate-fade-in">
    <form action="{{ route('admin.students.update', $student) }}" method="POST" class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div><label class="block text-sm font-medium text-slate-300 mb-1.5">NIM</label><input type="text" name="nim" value="{{ old('nim', $student->nim) }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
            <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Nama Lengkap</label><input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $student->nama_lengkap) }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        </div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Email</label><input type="email" name="email" value="{{ old('email', $student->user->email) }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Jurusan</label><select name="jurusan" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            @foreach(['Teknik Informatika', 'Sistem Informasi', 'Bisnis Digital'] as $j)<option value="{{ $j }}" {{ $student->jurusan == $j ? 'selected' : '' }} class="bg-slate-800">{{ $j }}</option>@endforeach
        </select></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Password Baru (kosongkan jika tidak diubah)</label><input type="password" name="password" minlength="8" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        <div class="flex gap-3"><a href="{{ route('admin.students.index') }}" class="px-6 py-2.5 rounded-xl border border-white/10 text-slate-400 hover:text-white hover:bg-white/5 transition text-sm">Batal</a>
            <button type="submit" class="flex-1 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-medium shadow-lg shadow-indigo-500/30 transition-all duration-300">Update</button>
        </div>
    </form>
</div>
@endsection
