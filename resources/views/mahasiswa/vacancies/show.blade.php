@extends('layouts.app')
@section('title', $vacancy->posisi)
@section('page-title', 'Detail Lowongan')
@section('sidebar-nav')
    @include('partials.sidebar-mahasiswa')
@endsection

@section('content')
<div class="max-w-3xl space-y-6 animate-fade-in">
    <a href="{{ route('mahasiswa.vacancies.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar
    </a>

    <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
        <div class="flex items-start gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shrink-0">
                <span class="text-xl font-bold text-white">{{ strtoupper(substr($vacancy->company->company_name, 0, 2)) }}</span>
            </div>
            <div>
                <h2 class="text-2xl font-bold">{{ $vacancy->posisi }}</h2>
                <p class="text-indigo-400 font-medium">{{ $vacancy->company->company_name }}</p>
                <div class="flex flex-wrap gap-3 mt-2 text-xs text-slate-400">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $vacancy->company->lokasi }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $vacancy->durasi_bulan }} bulan
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Kuota: {{ $vacancy->kuota - $vacancy->acceptedApplicationsCount() }}/{{ $vacancy->kuota }}
                    </span>
                </div>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t border-white/10">
            <div>
                <h4 class="text-sm font-semibold text-slate-300 mb-2">Deskripsi Tugas</h4>
                <p class="text-sm text-slate-400 whitespace-pre-line">{{ $vacancy->deskripsi_tugas }}</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-slate-300 mb-2">Persyaratan</h4>
                <p class="text-sm text-slate-400 whitespace-pre-line">{{ $vacancy->persyaratan }}</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-slate-300 mb-2">Tentang {{ $vacancy->company->company_name }}</h4>
                <p class="text-sm text-slate-400">{{ $vacancy->company->deskripsi }}</p>
                <p class="text-xs text-slate-500 mt-2">Industri: {{ $vacancy->company->bidang_industri }} · Kontak: {{ $vacancy->company->kontak_person }}</p>
            </div>
        </div>
    </div>

    {{-- Apply Form --}}
    <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-6">
        @if($hasApplied)
            <div class="flex items-center gap-3 p-4 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm">Anda sudah melamar ke posisi ini. Cek status lamaran di halaman <a href="{{ route('mahasiswa.applications.index') }}" class="underline">Lamaran Saya</a>.</p>
            </div>
        @elseif($vacancy->isQuotaFull())
            <div class="flex items-center gap-3 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm">Kuota untuk posisi ini sudah penuh.</p>
            </div>
        @else
            <h3 class="font-semibold mb-4">Lamar Posisi Ini</h3>
            <form action="{{ route('mahasiswa.applications.store', $vacancy) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1.5">Dokumen Tambahan (opsional, PDF maks 5MB)</label>
                    <input type="file" name="dokumen_tambahan" accept=".pdf"
                           class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-500/20 file:text-indigo-300 file:text-sm file:font-medium hover:file:bg-indigo-500/30 file:cursor-pointer transition">
                </div>
                <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-semibold shadow-lg shadow-emerald-500/30 transition-all duration-300">
                    Kirim Lamaran
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
