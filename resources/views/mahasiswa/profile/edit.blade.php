@extends('layouts.app')
@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')
@section('sidebar-nav')
    @include('partials.sidebar-mahasiswa')
@endsection

@section('content')
<div class="max-w-3xl animate-fade-in">
    <form action="{{ route('mahasiswa.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
            <h3 class="text-lg font-semibold border-b border-white/10 pb-3">Informasi Pribadi</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1.5">NIM</label>
                    <input type="text" value="{{ $student->nim }}" disabled class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-500 cursor-not-allowed">
                </div>
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-slate-300 mb-1.5">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $student->nama_lengkap) }}" required
                           class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                </div>
            </div>

            <div>
                <label for="jurusan" class="block text-sm font-medium text-slate-300 mb-1.5">Jurusan</label>
                <select id="jurusan" name="jurusan" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    @foreach(['Teknik Informatika', 'Sistem Informasi', 'Bisnis Digital'] as $j)
                        <option value="{{ $j }}" {{ $student->jurusan == $j ? 'selected' : '' }} class="bg-slate-800">{{ $j }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="portofolio_url" class="block text-sm font-medium text-slate-300 mb-1.5">Link Portofolio</label>
                <input type="url" id="portofolio_url" name="portofolio_url" value="{{ old('portofolio_url', $student->portofolio_url) }}"
                       class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                       placeholder="https://portfolio.com/username">
            </div>
        </div>

        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
            <h3 class="text-lg font-semibold border-b border-white/10 pb-3">Dokumen CV</h3>

            @if($student->cv_url)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-sm text-emerald-400">CV telah diunggah</span>
                    <a href="{{ Storage::url($student->cv_url) }}" target="_blank" class="ml-auto text-xs text-indigo-400 hover:text-indigo-300">Lihat →</a>
                </div>
            @endif

            <div>
                <label for="cv_file" class="block text-sm font-medium text-slate-300 mb-1.5">Upload CV Baru (PDF, maks 5MB)</label>
                <input type="file" id="cv_file" name="cv_file" accept=".pdf"
                       class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-500/20 file:text-indigo-300 file:text-sm file:font-medium hover:file:bg-indigo-500/30 file:cursor-pointer transition">
            </div>
        </div>

        <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
