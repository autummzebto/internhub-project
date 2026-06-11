@extends('layouts.app')
@section('title', 'Tambah Plotting')
@section('page-title', 'Tambah Plotting')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="max-w-2xl animate-fade-in">
    <form action="{{ route('admin.plottings.store') }}" method="POST" class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">@csrf
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Mahasiswa</label><select name="student_id" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            <option value="" class="bg-slate-800">Pilih Mahasiswa</option>
            @foreach($students as $s)<option value="{{ $s->id }}" class="bg-slate-800">{{ $s->nama_lengkap }} ({{ $s->nim }})</option>@endforeach
        </select>
        @if($students->isEmpty())<p class="text-xs text-yellow-400 mt-1">Semua mahasiswa sudah memiliki plotting.</p>@endif
        </div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Dosen Pembimbing</label><select name="lecturer_id" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            <option value="" class="bg-slate-800">Pilih Dosen</option>
            @foreach($lecturers as $l)<option value="{{ $l->id }}" class="bg-slate-800">{{ $l->nama_dosen }} ({{ $l->nidn }})</option>@endforeach
        </select></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Tahun Akademik</label><input type="text" name="tahun_akademik" value="{{ old('tahun_akademik', date('Y').'/'.(date('Y')+1).' Ganjil') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" placeholder="2025/2026 Ganjil"></div>
        <div class="flex gap-3"><a href="{{ route('admin.plottings.index') }}" class="px-6 py-2.5 rounded-xl border border-white/10 text-slate-400 hover:text-white hover:bg-white/5 transition text-sm">Batal</a><button type="submit" class="flex-1 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-medium shadow-lg shadow-indigo-500/30 transition-all duration-300">Simpan Plotting</button></div>
    </form>
</div>
@endsection
