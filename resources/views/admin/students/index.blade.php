@extends('layouts.app')
@section('title', 'Kelola Mahasiswa')
@section('page-title', 'Kelola Mahasiswa')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection

@section('content')
<div class="space-y-4 animate-fade-in">
    <div class="flex flex-col sm:flex-row gap-3 justify-between">
        <form method="GET" class="flex gap-3 flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/NIM..."
                   class="flex-1 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            <select name="jurusan" class="px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" onchange="this.form.submit()">
                <option value="" class="bg-slate-800">Semua Jurusan</option>
                @foreach(['Teknik Informatika', 'Sistem Informasi', 'Bisnis Digital'] as $j)
                    <option value="{{ $j }}" {{ request('jurusan') == $j ? 'selected' : '' }} class="bg-slate-800">{{ $j }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('admin.students.create') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 text-white text-sm font-medium shadow-lg shadow-indigo-500/30 transition-all duration-300 text-center">+ Tambah Mahasiswa</a>
    </div>
    <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden">
        <div class="overflow-x-auto"><table class="w-full text-sm"><thead><tr class="border-b border-white/10 text-left">
            <th class="px-6 py-3 font-semibold text-slate-300">NIM</th><th class="px-6 py-3 font-semibold text-slate-300">Nama</th><th class="px-6 py-3 font-semibold text-slate-300">Jurusan</th><th class="px-6 py-3 font-semibold text-slate-300">Email</th><th class="px-6 py-3 font-semibold text-slate-300">Aksi</th>
        </tr></thead><tbody class="divide-y divide-white/5">
            @forelse($students as $s)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 font-mono text-indigo-400">{{ $s->nim }}</td>
                    <td class="px-6 py-4 font-medium">{{ $s->nama_lengkap }}</td>
                    <td class="px-6 py-4 text-slate-400">{{ $s->jurusan }}</td>
                    <td class="px-6 py-4 text-slate-400">{{ $s->user->email }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.students.edit', $s) }}" class="px-3 py-1.5 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs font-medium hover:bg-indigo-500/30 transition">Edit</a>
                            <form action="{{ route('admin.students.destroy', $s) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')
                                <button class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-300 text-xs font-medium hover:bg-red-500/30 transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Belum ada data mahasiswa</td></tr>
            @endforelse
        </tbody></table></div>
    </div>
    {{ $students->withQueryString()->links() }}
</div>
@endsection
