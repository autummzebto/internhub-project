@extends('layouts.app')
@section('title', 'Lowongan Magang')
@section('page-title', 'Lowongan Magang')
@section('sidebar-nav')
    @include('partials.sidebar-mahasiswa')
@endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    {{-- Search & Filter --}}
    <form method="GET" class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari posisi atau perusahaan..."
                   class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
        </div>
        <input type="text" name="lokasi" value="{{ request('lokasi') }}" placeholder="Filter lokasi..."
               class="px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition sm:w-48">
        <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-medium transition">
            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari
        </button>
    </form>

    {{-- Vacancy Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($vacancies as $vacancy)
            <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover flex flex-col">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-500/20 flex items-center justify-center shrink-0">
                        <span class="text-lg font-bold text-indigo-400">{{ strtoupper(substr($vacancy->company->company_name, 0, 1)) }}</span>
                    </div>
                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-400">{{ $vacancy->durasi_bulan }} bulan</span>
                </div>
                <h3 class="font-semibold text-white mb-1">{{ $vacancy->posisi }}</h3>
                <p class="text-sm text-indigo-400 mb-2">{{ $vacancy->company->company_name }}</p>
                <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ Str::limit($vacancy->company->lokasi, 40) }}
                </div>
                <p class="text-xs text-slate-400 mb-4 flex-1">{{ Str::limit($vacancy->deskripsi_tugas, 100) }}</p>
                <div class="flex items-center justify-between pt-3 border-t border-white/5">
                    <span class="text-xs text-slate-500">Kuota: {{ $vacancy->kuota - $vacancy->acceptedApplicationsCount() }}/{{ $vacancy->kuota }}</span>
                    <a href="{{ route('mahasiswa.vacancies.show', $vacancy) }}" class="text-xs text-indigo-400 hover:text-indigo-300 font-medium transition">Detail →</a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-slate-500">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <p>Belum ada lowongan yang tersedia</p>
            </div>
        @endforelse
    </div>

    {{ $vacancies->withQueryString()->links() }}
</div>
@endsection
