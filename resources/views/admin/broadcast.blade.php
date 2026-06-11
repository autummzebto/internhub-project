@extends('layouts.app')
@section('title', 'Broadcast')
@section('page-title', 'Broadcast Pengumuman')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="max-w-2xl animate-fade-in">
    <form action="{{ route('admin.broadcast.send') }}" method="POST" class="rounded-2xl bg-slate-800/50 border border-white/5 p-6 space-y-5">@csrf
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Judul Pengumuman</label><input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" placeholder="Judul pengumuman"></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Isi Pesan</label><textarea name="message" rows="4" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition resize-none" placeholder="Tulis pesan pengumuman...">{{ old('message') }}</textarea></div>
        <div><label class="block text-sm font-medium text-slate-300 mb-1.5">Target Penerima</label><select name="target" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            <option value="all" class="bg-slate-800">Semua (Mahasiswa & Dosen)</option>
            <option value="mahasiswa" class="bg-slate-800">Mahasiswa</option>
            <option value="dosen" class="bg-slate-800">Dosen</option>
        </select></div>
        <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold shadow-lg shadow-indigo-500/30 transition-all duration-300" onclick="return confirm('Kirim pengumuman?')">
            📢 Kirim Broadcast
        </button>
    </form>
</div>
@endsection
