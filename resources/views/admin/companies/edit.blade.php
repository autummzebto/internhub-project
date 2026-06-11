@extends('layouts.app')
@section('title', isset($company) ? 'Edit Perusahaan' : 'Tambah Perusahaan')
@section('page-title', isset($company) ? 'Edit Perusahaan' : 'Tambah Perusahaan')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="max-w-2xl animate-fade-in">
    <form action="{{ isset($company) ? route('admin.companies.update', $company) : route('admin.companies.store') }}" method="POST" class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">
        @csrf @if(isset($company)) @method('PUT') @endif
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Nama Perusahaan</label><input type="text" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Bidang Industri</label><input type="text" name="bidang_industri" value="{{ old('bidang_industri', $company->bidang_industri ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Lokasi</label><textarea name="lokasi" rows="2" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none">{{ old('lokasi', $company->lokasi ?? '') }}</textarea></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Deskripsi</label><textarea name="deskripsi" rows="3" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none">{{ old('deskripsi', $company->deskripsi ?? '') }}</textarea></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Kontak Person</label><input type="text" name="kontak_person" value="{{ old('kontak_person', $company->kontak_person ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></div>
        @if(isset($company))
            <div class="flex items-center gap-3"><input type="hidden" name="status_aktif" value="0"><input type="checkbox" name="status_aktif" value="1" {{ $company->status_aktif ? 'checked' : '' }} class="w-4 h-4 rounded border-white/20 bg-white/5 text-indigo-500 focus:ring-indigo-500"><label class="text-sm text-slate-300">Perusahaan Aktif</label></div>
        @endif
        <div class="flex gap-3"><a href="{{ route('admin.companies.index') }}" class="px-6 py-2.5 rounded-xl border border-white/10 text-slate-400 hover:text-white hover:bg-white/5 transition text-sm">Batal</a><button type="submit" class="flex-1 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-medium shadow-lg shadow-indigo-500/30 transition-all duration-300">{{ isset($company) ? 'Update' : 'Simpan' }}</button></div>
    </form>
</div>
@endsection
