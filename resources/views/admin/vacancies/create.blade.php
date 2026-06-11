@extends('layouts.app')
@section('title', isset($vacancy) ? 'Edit Lowongan' : 'Tambah Lowongan')
@section('page-title', isset($vacancy) ? 'Edit Lowongan' : 'Tambah Lowongan')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="max-w-2xl animate-fade-in">
    <form action="{{ isset($vacancy) ? route('admin.vacancies.update', $vacancy) : route('admin.vacancies.store') }}" method="POST" class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
        @csrf @if(isset($vacancy)) @method('PUT') @endif
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Perusahaan</label><select name="company_id" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            <option value="" class="bg-slate-800">Pilih Perusahaan</option>
            @foreach($companies as $c)<option value="{{ $c->id }}" {{ old('company_id', $vacancy->company_id ?? '') == $c->id ? 'selected' : '' }} class="bg-slate-800">{{ $c->company_name }}</option>@endforeach
        </select></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Posisi</label><input type="text" name="posisi" value="{{ old('posisi', $vacancy->posisi ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Deskripsi Tugas</label><textarea name="deskripsi_tugas" rows="3" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none">{{ old('deskripsi_tugas', $vacancy->deskripsi_tugas ?? '') }}</textarea></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Persyaratan</label><textarea name="persyaratan" rows="3" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none">{{ old('persyaratan', $vacancy->persyaratan ?? '') }}</textarea></div>
        <div class="grid grid-cols-2 gap-5">
            <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Durasi (bulan)</label><input type="number" name="durasi_bulan" min="1" max="12" value="{{ old('durasi_bulan', $vacancy->durasi_bulan ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
            <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Kuota</label><input type="number" name="kuota" min="1" value="{{ old('kuota', $vacancy->kuota ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        </div>
        @if(isset($vacancy))
            <div class="flex items-center gap-3"><input type="hidden" name="status_aktif" value="0"><input type="checkbox" name="status_aktif" value="1" {{ $vacancy->status_aktif ? 'checked' : '' }} class="w-4 h-4 rounded border-white/20 bg-white/5 text-indigo-500 focus:ring-indigo-500"><label class="text-sm text-slate-300">Lowongan Aktif</label></div>
        @endif
        <div class="flex gap-3"><a href="{{ route('admin.vacancies.index') }}" class="px-6 py-2.5 rounded-xl border border-white/10 text-slate-400 hover:text-white hover:bg-white/5 transition text-sm">Batal</a><button type="submit" class="flex-1 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-medium shadow-lg shadow-indigo-500/30 transition-all duration-300">{{ isset($vacancy) ? 'Update' : 'Simpan' }}</button></div>
    </form>
</div>
@endsection
