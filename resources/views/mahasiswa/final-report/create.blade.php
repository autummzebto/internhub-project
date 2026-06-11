@extends('layouts.app')
@section('title', 'Laporan Akhir')
@section('page-title', 'Laporan Akhir Magang')
@section('sidebar-nav') @include('partials.sidebar-mahasiswa') @endsection

@section('content')
<div class="max-w-2xl animate-fade-in space-y-6">
    @if($existingReport)
        {{-- Report Already Submitted --}}
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-4">
            <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="font-semibold">Laporan akhir sudah dikirim</p>
                    <p class="text-sm opacity-80">Dikirim pada {{ $existingReport->submitted_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 rounded-xl bg-white/5">
                    <p class="text-xs text-slate-400 mb-1">Nilai</p>
                    <p class="text-2xl font-bold {{ $existingReport->nilai_angka ? 'text-indigo-400' : 'text-slate-500' }}">
                        {{ $existingReport->nilai_angka ?? 'Belum dinilai' }}
                        @if($existingReport->nilai_angka)
                            <span class="text-sm font-medium">({{ $existingReport->nilai_huruf }})</span>
                        @endif
                    </p>
                </div>
                <div class="p-4 rounded-xl bg-white/5">
                    <p class="text-xs text-slate-400 mb-1">File Laporan</p>
                    <a href="{{ Storage::url($existingReport->file_laporan_url) }}" target="_blank"
                       class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">Download PDF →</a>
                </div>
            </div>

            @if($existingReport->feedback_dosen)
                <div class="p-4 rounded-xl bg-indigo-500/10 border border-indigo-500/20">
                    <p class="text-xs text-indigo-400 font-medium mb-2">Feedback Dosen:</p>
                    <p class="text-sm text-slate-300">{{ $existingReport->feedback_dosen }}</p>
                </div>
            @endif
        </div>
    @else
        {{-- Upload Form --}}
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
            @if(!$plotting)
                <div class="flex items-center gap-3 p-4 rounded-xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    <p class="text-sm">Anda belum memiliki dosen pembimbing. Hubungi admin untuk plotting terlebih dahulu.</p>
                </div>
            @else
                <h3 class="text-lg font-semibold">Upload Laporan Akhir</h3>
                <p class="text-sm text-slate-400">Setelah dikirim, laporan tidak dapat diubah. Pastikan file yang diupload sudah final.</p>

                <form action="{{ route('mahasiswa.final-report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="border-2 border-dashed border-white/10 rounded-2xl p-8 text-center hover:border-indigo-500/50 transition">
                        <svg class="w-12 h-12 mx-auto text-slate-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        <input type="file" name="file_laporan" accept=".pdf" required
                               class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-500/20 file:text-indigo-300 file:font-medium hover:file:bg-indigo-500/30 file:cursor-pointer">
                        <p class="text-xs text-slate-500 mt-2">Format: PDF · Maksimal: 5MB</p>
                    </div>
                    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-semibold shadow-lg shadow-emerald-500/30 transition-all duration-300"
                            onclick="return confirm('Setelah dikirim, laporan tidak dapat diubah. Yakin kirim sekarang?')">
                        Kirim Laporan Akhir
                    </button>
                </form>
            @endif
        </div>
    @endif
</div>
@endsection
