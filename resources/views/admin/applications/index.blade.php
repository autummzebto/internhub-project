@extends('layouts.app')
@section('title', 'Verifikasi Lamaran')
@section('page-title', 'Verifikasi Lamaran')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="space-y-4 animate-fade-in">
    <form method="GET" class="flex gap-3">
        <select name="status" class="px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" onchange="this.form.submit()">
            <option value="" class="bg-slate-800">Semua Status</option>
            @foreach(['pending' => 'Pending', 'verified_by_admin' => 'Terverifikasi', 'accepted_by_company' => 'Diterima', 'rejected' => 'Ditolak'] as $key => $label)
                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }} class="bg-slate-800">{{ $label }}</option>
            @endforeach
        </select>
    </form>
    <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden"><div class="overflow-x-auto"><table class="w-full text-sm"><thead><tr class="border-b border-white/10 text-left"><th class="px-6 py-3 font-semibold text-slate-300">Mahasiswa</th><th class="px-6 py-3 font-semibold text-slate-300">Posisi</th><th class="px-6 py-3 font-semibold text-slate-300">Perusahaan</th><th class="px-6 py-3 font-semibold text-slate-300">Tanggal</th><th class="px-6 py-3 font-semibold text-slate-300">Status</th><th class="px-6 py-3 font-semibold text-slate-300">Aksi</th></tr></thead>
    <tbody class="divide-y divide-white/5">
        @forelse($applications as $app)
            <tr class="hover:bg-white/5 transition">
                <td class="px-6 py-4"><p class="font-medium">{{ $app->student->nama_lengkap }}</p><p class="text-xs text-slate-400">{{ $app->student->nim }}</p></td>
                <td class="px-6 py-4">{{ $app->vacancy->posisi }}</td>
                <td class="px-6 py-4 text-slate-400">{{ $app->vacancy->company->company_name }}</td>
                <td class="px-6 py-4 text-slate-400 text-xs">{{ $app->tanggal_apply->format('d M Y') }}</td>
                <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $app->status_lamaran === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : ($app->status_lamaran === 'verified_by_admin' ? 'bg-blue-500/20 text-blue-400' : ($app->status_lamaran === 'accepted_by_company' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400')) }}">{{ $app->status_label }}</span></td>
                <td class="px-6 py-4">
                    <div class="flex gap-1.5 flex-wrap">
                        @if($app->dokumen_tambahan_url)<a href="{{ Storage::url($app->dokumen_tambahan_url) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-white/5 text-slate-300 text-xs hover:bg-white/10 transition">Dok</a>@endif
                        @if($app->status_lamaran === 'pending')<form action="{{ route('admin.applications.verify', $app) }}" method="POST" class="inline">@csrf<button class="px-2.5 py-1 rounded-lg bg-blue-500/20 text-blue-300 text-xs font-medium hover:bg-blue-500/30 transition">Verifikasi</button></form>@endif
                        @if($app->status_lamaran === 'verified_by_admin')
                            <form action="{{ route('admin.applications.accept', $app) }}" method="POST" class="inline">@csrf<button class="px-2.5 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 text-xs font-medium hover:bg-emerald-500/30 transition">Terima</button></form>
                            <form action="{{ route('admin.applications.reject', $app) }}" method="POST" class="inline">@csrf<button class="px-2.5 py-1 rounded-lg bg-red-500/20 text-red-300 text-xs font-medium hover:bg-red-500/30 transition">Tolak</button></form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty<tr><td colspan="6" class="px-6 py-12 text-center text-slate-500">Belum ada lamaran</td></tr>@endforelse
    </tbody></table></div></div>
    {{ $applications->withQueryString()->links() }}
</div>
@endsection
