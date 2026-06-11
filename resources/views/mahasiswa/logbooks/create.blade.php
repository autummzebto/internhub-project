@extends('layouts.app')
@section('title', 'Isi Logbook')
@section('page-title', 'Isi Logbook Harian')
@section('sidebar-nav') @include('partials.sidebar-mahasiswa') @endsection

@section('content')
<div class="max-w-2xl animate-fade-in">
    <form action="{{ route('mahasiswa.logbooks.store') }}" method="POST" class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
        @csrf
        <div>
            <label for="tanggal" class="block text-sm font-medium text-slate-300 mb-1.5">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required max="{{ date('Y-m-d') }}"
                   class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
        </div>
        <div>
            <label for="kegiatan_harian" class="block text-sm font-medium text-slate-300 mb-1.5">Kegiatan Harian</label>
            <textarea id="kegiatan_harian" name="kegiatan_harian" rows="5" required minlength="10"
                      class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none"
                      placeholder="Deskripsikan kegiatan yang dilakukan hari ini...">{{ old('kegiatan_harian') }}</textarea>
        </div>
        <div>
            <label for="progress_persen" class="block text-sm font-medium text-slate-300 mb-1.5">Progress Keseluruhan (%)</label>
            <input type="range" id="progress_persen" name="progress_persen" min="0" max="100" value="{{ old('progress_persen', 0) }}"
                   class="w-full accent-indigo-500" oninput="document.getElementById('progress_val').textContent = this.value + '%'">
            <p class="text-center text-sm text-indigo-400 font-semibold mt-1" id="progress_val">{{ old('progress_persen', 0) }}%</p>
        </div>
        <div class="flex gap-3 pt-2">
            <a href="{{ route('mahasiswa.logbooks.index') }}" class="px-6 py-2.5 rounded-xl border border-white/10 text-slate-400 hover:text-white hover:bg-white/5 transition text-sm">Batal</a>
            <button type="submit" class="flex-1 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-medium shadow-lg shadow-indigo-500/30 transition-all duration-300">
                Simpan Logbook
            </button>
        </div>
    </form>
</div>
@endsection
