@extends('layouts.app')
@section('title', 'Penilaian')
@section('page-title', 'Penilaian Laporan Akhir')
@section('sidebar-nav') @include('partials.sidebar-dosen') @endsection

@section('content')
<div class="space-y-4 animate-fade-in">
    <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-white/10 text-left">
                    <th class="px-6 py-3 font-semibold text-slate-300">Mahasiswa</th>
                    <th class="px-6 py-3 font-semibold text-slate-300">Dikirim</th>
                    <th class="px-6 py-3 font-semibold text-slate-300">Nilai</th>
                    <th class="px-6 py-3 font-semibold text-slate-300">Aksi</th>
                </tr></thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($reports as $report)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <p class="font-medium">{{ $report->student->nama_lengkap }}</p>
                                <p class="text-xs text-slate-400">{{ $report->student->nim }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $report->submitted_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($report->nilai_angka)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-400">{{ $report->nilai_angka }} ({{ $report->nilai_huruf }})</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400">Belum Dinilai</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('dosen.grading.download', $report) }}" class="px-3 py-1.5 rounded-lg bg-white/5 text-slate-300 text-xs font-medium hover:bg-white/10 transition">Download</a>
                                    <a href="{{ route('dosen.grading.show', $report) }}" class="px-3 py-1.5 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs font-medium hover:bg-indigo-500/30 transition">{{ $report->nilai_angka ? 'Detail' : 'Beri Nilai' }}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Belum ada laporan akhir</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $reports->links() }}
</div>
@endsection
