@extends('layouts.app')
@section('title', 'Tambah Dosen')
@section('page-title', 'Tambah Dosen')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="max-w-2xl animate-fade-in">
    <form action="{{ route('admin.lecturers.store') }}" method="POST" class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">@csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div><label class="block text-sm font-medium text-slate-300 mb-1.5">NIDN</label><input type="text" name="nidn" value="{{ old('nidn') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
            <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Nama Dosen</label><input type="text" name="nama_dosen" value="{{ old('nama_dosen') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        </div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Password</label><input type="password" name="password" required minlength="8" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        <div class="flex gap-3"><a href="{{ route('admin.lecturers.index') }}" class="px-6 py-2.5 rounded-xl border border-white/10 text-slate-400 hover:text-white hover:bg-white/5 transition text-sm">Batal</a><button type="submit" class="flex-1 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-medium shadow-lg shadow-indigo-500/30 transition-all duration-300">Simpan</button></div>
    </form>
</div>
@endsection
