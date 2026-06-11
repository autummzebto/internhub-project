@extends('layouts.app')
@section('title', 'Kelola Perusahaan')
@section('page-title', 'Kelola Perusahaan')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="space-y-4 animate-fade-in">
    <div class="flex flex-col sm:flex-row gap-3 justify-between">
        <form method="GET" class="flex gap-3 flex-1"><input type="text" name="search" value="{{ request('search') }}" placeholder="Cari perusahaan..." class="flex-1 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"><button class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition">Cari</button></form>
        <a href="{{ route('admin.companies.create') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-sm font-medium shadow-lg shadow-indigo-500/30 text-center">+ Tambah Perusahaan</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($companies as $c)
            <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center"><span class="text-lg font-bold text-emerald-400">{{ strtoupper(substr($c->company_name, 0, 1)) }}</span></div>
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $c->status_aktif ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">{{ $c->status_aktif ? 'Aktif' : 'Nonaktif' }}</span>
                </div>
                <h3 class="font-semibold">{{ $c->company_name }}</h3>
                <p class="text-xs text-indigo-400">{{ $c->bidang_industri }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ Str::limit($c->lokasi, 50) }}</p>
                <p class="text-xs text-slate-500 mt-1">{{ $c->vacancies_count }} lowongan · {{ $c->kontak_person }}</p>
                <div class="flex gap-2 mt-3 pt-3 border-t border-white/5">
                    <a href="{{ route('admin.companies.edit', $c) }}" class="px-3 py-1.5 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs font-medium hover:bg-indigo-500/30 transition">Edit</a>
                    <form action="{{ route('admin.companies.destroy', $c) }}" method="POST" onsubmit="return confirm('Yakin?')">@csrf @method('DELETE')<button class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-300 text-xs font-medium hover:bg-red-500/30 transition">Hapus</button></form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-slate-500">Belum ada perusahaan</div>
        @endforelse
    </div>
    {{ $companies->withQueryString()->links() }}
</div>
@endsection
