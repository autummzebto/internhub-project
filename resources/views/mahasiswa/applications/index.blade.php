@extends('layouts.app')
@section('title', 'Lamaran Saya')
@section('page-title', 'Lamaran Saya')
@section('sidebar-nav') @include('partials.sidebar-mahasiswa') @endsection

@section('content')
<div class="space-y-4 animate-fade-in">
    <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="px-6 py-4 font-semibold text-slate-300">Posisi</th>
                        <th class="px-6 py-4 font-semibold text-slate-300">Perusahaan</th>
                        <th class="px-6 py-4 font-semibold text-slate-300">Tanggal</th>
                        <th class="px-6 py-4 font-semibold text-slate-300">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($applications as $app)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-medium">{{ $app->vacancy->posisi }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $app->vacancy->company->company_name }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $app->tanggal_apply->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $app->status_color === 'green' ? 'bg-emerald-500/20 text-emerald-400' :
                                       ($app->status_color === 'yellow' ? 'bg-yellow-500/20 text-yellow-400' :
                                       ($app->status_color === 'blue' ? 'bg-blue-500/20 text-blue-400' :
                                       'bg-red-500/20 text-red-400')) }}">
                                    {{ $app->status_label }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Belum ada lamaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $applications->links() }}
</div>
@endsection
