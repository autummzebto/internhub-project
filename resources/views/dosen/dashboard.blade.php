@extends('layouts.app')
@section('title', 'Dashboard Dosen')
@section('page-title', 'Dashboard Dosen Pembimbing')
@section('sidebar-nav') @include('partials.sidebar-dosen') @endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
            <div class="w-10 h-10 rounded-xl bg-indigo-500/20 flex items-center justify-center mb-3"><svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
            <p class="text-2xl font-bold">{{ $stats['total_students'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Mahasiswa Bimbingan</p>
        </div>
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
            <div class="w-10 h-10 rounded-xl bg-yellow-500/20 flex items-center justify-center mb-3"><svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <p class="text-2xl font-bold text-yellow-400">{{ $stats['total_logbooks_pending'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Logbook Perlu Review</p>
        </div>
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
            <div class="w-10 h-10 rounded-xl bg-purple-500/20 flex items-center justify-center mb-3"><svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
            <p class="text-2xl font-bold text-purple-400">{{ $stats['reports_to_grade'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Laporan Perlu Dinilai</p>
        </div>
    </div>

    {{-- Students Grid --}}
    <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10"><h3 class="font-semibold">Mahasiswa Bimbingan</h3></div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-white/10 text-left">
                    <th class="px-6 py-3 font-semibold text-slate-300">Mahasiswa</th>
                    <th class="px-6 py-3 font-semibold text-slate-300">Logbook</th>
                    <th class="px-6 py-3 font-semibold text-slate-300">Terakhir</th>
                    <th class="px-6 py-3 font-semibold text-slate-300">Laporan</th>
                    <th class="px-6 py-3 font-semibold text-slate-300">Aksi</th>
                </tr></thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($students as $s)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <p class="font-medium">{{ $s['student']->nama_lengkap }}</p>
                                <p class="text-xs text-slate-400">{{ $s['student']->nim }} · {{ $s['student']->jurusan }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-emerald-400 font-semibold">{{ $s['validated_logbooks'] }}</span>
                                <span class="text-slate-500">/{{ $s['total_logbooks'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">{{ $s['last_logbook'] ? $s['last_logbook']->tanggal->format('d M Y') : '-' }}</td>
                            <td class="px-6 py-4">
                                @if($s['has_final_report'])
                                    @if($s['final_report']->nilai_angka)
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-400">{{ $s['final_report']->nilai_angka }} ({{ $s['final_report']->nilai_huruf }})</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400">Perlu Dinilai</span>
                                    @endif
                                @else
                                    <span class="text-xs text-slate-500">Belum ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('dosen.logbooks.index', $s['student']) }}" class="px-3 py-1.5 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs font-medium hover:bg-indigo-500/30 transition">Logbook</a>
                                    @if($s['has_final_report'] && !$s['final_report']->nilai_angka)
                                        <a href="{{ route('dosen.grading.show', $s['final_report']) }}" class="px-3 py-1.5 rounded-lg bg-purple-500/20 text-purple-300 text-xs font-medium hover:bg-purple-500/30 transition">Nilai</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Belum ada mahasiswa yang ditugaskan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
