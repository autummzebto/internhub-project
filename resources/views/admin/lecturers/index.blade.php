@extends('layouts.app')
@section('title', 'Kelola Dosen')
@section('page-title', 'Kelola Dosen')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="space-y-4 animate-fade-in">
    <div class="flex flex-col sm:flex-row gap-3 justify-between">
        <form method="GET" class="flex gap-3 flex-1"><input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/NIDN..." class="flex-1 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"><button class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition">Cari</button></form>
        <a href="{{ route('admin.lecturers.create') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-sm font-medium shadow-lg shadow-indigo-500/30 transition-all text-center">+ Tambah Dosen</a>
    </div>
    <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden"><div class="overflow-x-auto"><table class="w-full text-sm"><thead><tr class="border-b border-white/10 text-left"><th class="px-6 py-3 font-semibold text-slate-300">NIDN</th><th class="px-6 py-3 font-semibold text-slate-300">Nama</th><th class="px-6 py-3 font-semibold text-slate-300">Email</th><th class="px-6 py-3 font-semibold text-slate-300">Aksi</th></tr></thead>
    <tbody class="divide-y divide-white/5">
        @forelse($lecturers as $l)
            <tr class="hover:bg-white/5 transition"><td class="px-6 py-4 font-mono text-indigo-400">{{ $l->nidn }}</td><td class="px-6 py-4 font-medium">{{ $l->nama_dosen }}</td><td class="px-6 py-4 text-slate-400">{{ $l->user->email }}</td>
            <td class="px-6 py-4"><div class="flex gap-2"><a href="{{ route('admin.lecturers.edit', $l) }}" class="px-3 py-1.5 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs font-medium hover:bg-indigo-500/30 transition">Edit</a><form action="{{ route('admin.lecturers.destroy', $l) }}" method="POST" onsubmit="return confirm('Yakin?')">@csrf @method('DELETE')<button class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-300 text-xs font-medium hover:bg-red-500/30 transition">Hapus</button></form></div></td></tr>
        @empty<tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Belum ada data dosen</td></tr>@endforelse
    </tbody></table></div></div>
    {{ $lecturers->withQueryString()->links() }}
</div>
@endsection
