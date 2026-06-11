@extends('layouts.app')
@section('title', 'Logbook Harian')
@section('page-title', 'Logbook Harian')
@section('sidebar-nav') @include('partials.sidebar-mahasiswa') @endsection

@section('content')
<div class="space-y-4 animate-fade-in">
    <div class="flex justify-end">
        <a href="{{ route('mahasiswa.logbooks.create') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white text-sm font-medium shadow-lg shadow-indigo-500/30 transition-all duration-300">
            + Isi Logbook
        </a>
    </div>

    <div class="space-y-3">
        @forelse($logbooks as $log)
            <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
                <div class="flex items-start justify-between mb-2">
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
                            <span class="text-xs {{ $log->validasi_dosen ? 'text-emerald-400' : 'text-yellow-400' }}">{{ $log->validasi_dosen ? 'Tervalidasi' : 'Menunggu Validasi' }}</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="w-16 h-2 rounded-full bg-slate-700 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-emerald-400" style="width: {{ $log->progress_persen }}%"></div>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">{{ $log->progress_persen }}%</p>
                    </div>
                </div>
                <p class="text-sm text-slate-300 mt-3">{{ $log->kegiatan_harian }}</p>
                @if($log->komentar_dosen)
                    <div class="mt-3 p-3 rounded-xl bg-indigo-500/10 border border-indigo-500/20">
                        <p class="text-xs text-indigo-400 font-medium mb-1">Komentar Dosen:</p>
                        <p class="text-sm text-slate-300">{{ $log->komentar_dosen }}</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-12 text-slate-500">
                <p>Belum ada logbook. <a href="{{ route('mahasiswa.logbooks.create') }}" class="text-indigo-400">Isi sekarang →</a></p>
            </div>
        @endforelse
    </div>

    {{ $logbooks->links() }}
</div>
@endsection
