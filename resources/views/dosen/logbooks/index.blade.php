@extends('layouts.app')
@section('title', 'Logbook ' . $student->nama_lengkap)
@section('page-title', 'Review Logbook')
@section('sidebar-nav') @include('partials.sidebar-dosen') @endsection

@section('content')
<div class="space-y-4 animate-fade-in">
    <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('dosen.dashboard') }}" class="text-slate-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <div>
            <h3 class="font-semibold">{{ $student->nama_lengkap }}</h3>
            <p class="text-xs text-slate-400">{{ $student->nim }} · {{ $student->jurusan }}</p>
        </div>
    </div>

    @forelse($logbooks as $log)
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5" x-data="{ showForm: false }">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl {{ $log->validasi_dosen ? 'bg-emerald-500/20' : 'bg-yellow-500/20' }} flex items-center justify-center">
                        @if($log->validasi_dosen)
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        @else
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-sm">{{ $log->tanggal->format('l, d M Y') }}</p>
                        <p class="text-xs {{ $log->validasi_dosen ? 'text-emerald-400' : 'text-yellow-400' }}">{{ $log->validasi_dosen ? 'Tervalidasi' : 'Menunggu Validasi' }}</p>
                    </div>
                </div>
                <span class="text-sm text-indigo-400 font-medium">{{ $log->progress_persen }}%</span>
            </div>
            <p class="text-sm text-slate-300 mt-3">{{ $log->kegiatan_harian }}</p>
            @if($log->komentar_dosen)
                <div class="mt-3 p-3 rounded-xl bg-indigo-500/10 border border-indigo-500/20">
                    <p class="text-xs text-indigo-400 font-medium mb-1">Komentar Anda:</p>
                    <p class="text-sm text-slate-300">{{ $log->komentar_dosen }}</p>
                </div>
            @endif
            @if(!$log->validasi_dosen)
                <div class="mt-3">
                    <button @click="showForm = !showForm" class="text-xs text-indigo-400 hover:text-indigo-300 transition">Validasi & Beri Komentar ↓</button>
                    <form x-show="showForm" x-transition action="{{ route('dosen.logbooks.validate', $log) }}" method="POST" class="mt-3 space-y-3">
                        @csrf
                        <textarea name="komentar_dosen" rows="2" placeholder="Komentar (opsional)..." class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none text-sm"></textarea>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-medium transition">✓ Validasi Logbook</button>
                    </form>
                </div>
            @endif
        </div>
    @empty
        <div class="text-center py-12 text-slate-500">Belum ada logbook dari mahasiswa ini</div>
    @endforelse
    {{ $logbooks->links() }}
</div>
@endsection
