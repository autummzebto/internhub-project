@extends('layouts.app')
@section('title', 'Penilaian - ' . $finalReport->student->nama_lengkap)
@section('page-title', 'Beri Penilaian')
@section('sidebar-nav') @include('partials.sidebar-dosen') @endsection

@section('content')
<div class="max-w-2xl space-y-6 animate-fade-in">
    <a href="{{ route('dosen.grading.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>Kembali
    </a>

    <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-500/20 flex items-center justify-center"><span class="text-lg font-bold text-indigo-400">{{ strtoupper(substr($finalReport->student->nama_lengkap, 0, 2)) }}</span></div>
            <div>
                <h3 class="font-semibold">{{ $finalReport->student->nama_lengkap }}</h3>
                <p class="text-xs text-slate-400">{{ $finalReport->student->nim }} · Dikirim {{ $finalReport->submitted_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
        <a href="{{ route('dosen.grading.download', $finalReport) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-300 hover:bg-white/10 transition text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Download Laporan PDF
        </a>
    </div>

    <form action="{{ route('dosen.grading.grade', $finalReport) }}" method="POST" class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
        @csrf
        <div>
            <label for="nilai_angka" class="block text-sm font-medium text-slate-300 mb-1.5">Nilai (0-100)</label>
            <input type="number" id="nilai_angka" name="nilai_angka" min="0" max="100" value="{{ old('nilai_angka', $finalReport->nilai_angka) }}" required
                   class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
        </div>
        <div>
            <label for="feedback_dosen" class="block text-sm font-medium text-slate-300 mb-1.5">Feedback & Evaluasi</label>
            <textarea id="feedback_dosen" name="feedback_dosen" rows="4" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none"
                      placeholder="Berikan evaluasi menyeluruh...">{{ old('feedback_dosen', $finalReport->feedback_dosen) }}</textarea>
        </div>
        <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold shadow-lg shadow-indigo-500/30 transition-all duration-300">
            Simpan Penilaian
        </button>
    </form>
</div>
@endsection
