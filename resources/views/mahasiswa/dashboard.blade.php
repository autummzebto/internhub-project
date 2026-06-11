@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')
@section('page-title', 'Dashboard')

@section('sidebar-nav') @include('partials.sidebar-mahasiswa') @endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    {{-- Welcome --}}
    <div class="rounded-2xl bg-gradient-to-r from-indigo-600/20 to-purple-600/20 border border-indigo-500/20 p-6">
        <h3 class="text-xl font-bold">Halo, {{ $student->nama_lengkap }}! 👋</h3>
        <p class="text-slate-400 mt-1">NIM: {{ $student->nim }} · {{ $student->jurusan }}</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
            <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="text-2xl font-bold">{{ $stats['applications'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Total Lamaran</p>
        </div>
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-2xl font-bold text-emerald-400">{{ $stats['accepted'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Diterima</p>
        </div>
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
            <div class="w-10 h-10 rounded-xl bg-purple-500/20 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <p class="text-2xl font-bold">{{ $stats['logbooks'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Logbook ({{ $stats['validated_logbooks'] }} valid)</p>
        </div>
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
            <div class="w-10 h-10 rounded-xl bg-amber-500/20 flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-2xl font-bold {{ $stats['has_final_report'] ? 'text-emerald-400' : 'text-amber-400' }}">
                {{ $stats['has_final_report'] ? '✓' : '—' }}
            </p>
            <p class="text-xs text-slate-400 mt-1">Laporan Akhir</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Applications --}}
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <h3 class="font-semibold">Lamaran Terbaru</h3>
                <a href="{{ route('mahasiswa.applications.index') }}" class="text-xs text-indigo-400 hover:text-indigo-300">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-white/5">
                @forelse($recentApplications as $app)
                    <div class="px-6 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">{{ $app->vacancy->posisi }}</p>
                            <p class="text-xs text-slate-400">{{ $app->vacancy->company->company_name }}</p>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium
                            {{ $app->status_color === 'green' ? 'bg-emerald-500/20 text-emerald-400' :
                               ($app->status_color === 'yellow' ? 'bg-yellow-500/20 text-yellow-400' :
                               ($app->status_color === 'blue' ? 'bg-blue-500/20 text-blue-400' :
                               'bg-red-500/20 text-red-400')) }}">
                            {{ $app->status_label }}
                        </span>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500 text-sm">Belum ada lamaran</div>
                @endforelse
            </div>
        </div>

        {{-- Recent Logbooks --}}
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <h3 class="font-semibold">Logbook Terbaru</h3>
                <a href="{{ route('mahasiswa.logbooks.index') }}" class="text-xs text-indigo-400 hover:text-indigo-300">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-white/5">
                @forelse($recentLogbooks as $log)
                    <div class="px-6 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">{{ $log->tanggal->format('d M Y') }}</p>
                            <p class="text-xs text-slate-400 truncate max-w-[200px]">{{ $log->kegiatan_harian }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-400">{{ $log->progress_persen }}%</span>
                            @if($log->validasi_dosen)
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500 text-sm">Belum ada logbook</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <a href="{{ route('mahasiswa.vacancies.index') }}" class="flex items-center gap-4 p-5 rounded-2xl bg-gradient-to-r from-blue-600/10 to-blue-500/5 border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 card-hover">
            <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-sm">Cari Magang</p>
                <p class="text-xs text-slate-400">Temukan lowongan terbaik</p>
            </div>
        </a>
        <a href="{{ route('mahasiswa.logbooks.create') }}" class="flex items-center gap-4 p-5 rounded-2xl bg-gradient-to-r from-purple-600/10 to-purple-500/5 border border-purple-500/20 hover:border-purple-500/40 transition-all duration-300 card-hover">
            <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-sm">Isi Logbook</p>
                <p class="text-xs text-slate-400">Catat kegiatan harian</p>
            </div>
        </a>
        <a href="{{ route('mahasiswa.final-report.create') }}" class="flex items-center gap-4 p-5 rounded-2xl bg-gradient-to-r from-amber-600/10 to-amber-500/5 border border-amber-500/20 hover:border-amber-500/40 transition-all duration-300 card-hover">
            <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            </div>
            <div>
                <p class="font-semibold text-sm">Upload Laporan</p>
                <p class="text-xs text-slate-400">Kirim laporan akhir</p>
            </div>
        </a>
    </div>
</div>
@endsection
