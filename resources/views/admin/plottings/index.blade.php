@extends('layouts.app')
@section('title', 'Plotting Dosen')
@section('page-title', 'Plotting Dosen Pembimbing')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="space-y-4 animate-fade-in">
    <div class="flex justify-end"><a href="{{ route('admin.plottings.create') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-sm font-medium shadow-lg shadow-indigo-500/30 transition-all">+ Tambah Plotting</a></div>
    <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden"><div class="overflow-x-auto"><table class="w-full text-sm"><thead><tr class="border-b border-white/10 text-left"><th class="px-6 py-3 font-semibold text-slate-300">Mahasiswa</th><th class="px-6 py-3 font-semibold text-slate-300">Dosen Pembimbing</th><th class="px-6 py-3 font-semibold text-slate-300">Tahun Akademik</th><th class="px-6 py-3 font-semibold text-slate-300">Aksi</th></tr></thead>
    <tbody class="divide-y divide-white/5">
        @forelse($plottings as $p)
            <tr class="hover:bg-white/5 transition">
                <td class="px-6 py-4"><p class="font-medium">{{ $p->student->nama_lengkap }}</p><p class="text-xs text-slate-400">{{ $p->student->nim }}</p></td>
                <td class="px-6 py-4"><p class="font-medium">{{ $p->lecturer->nama_dosen }}</p><p class="text-xs text-slate-400">{{ $p->lecturer->nidn }}</p></td>
                <td class="px-6 py-4 text-slate-400">{{ $p->tahun_akademik }}</td>
                <td class="px-6 py-4"><form action="{{ route('admin.plottings.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin hapus plotting?')">@csrf @method('DELETE')<button class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-300 text-xs font-medium hover:bg-red-500/30 transition">Hapus</button></form></td>
            </tr>
        @empty<tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Belum ada plotting</td></tr>@endforelse
    </tbody></table></div></div>
    {{ $plottings->links() }}
</div>
@endsection
