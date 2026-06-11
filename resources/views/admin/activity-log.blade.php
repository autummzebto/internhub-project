@extends('layouts.app')
@section('title', 'Activity Log')
@section('page-title', 'Activity Log')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection
@section('content')
<div class="space-y-4 animate-fade-in">
    <form method="GET" class="flex gap-3"><input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aktivitas..." class="flex-1 px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"><button class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition">Cari</button></form>
    <div class="space-y-2">
        @forelse($logs as $log)
            <div class="rounded-xl bg-slate-800/50 border border-white/5 px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center shrink-0"><span class="text-xs font-bold text-indigo-400">{{ strtoupper(substr($log->action, 0, 2)) }}</span></div>
                    <div>
                        <p class="text-sm"><span class="font-medium">{{ $log->user->name ?? 'System' }}</span> · <span class="text-slate-400">{{ $log->description }}</span></p>
                        <p class="text-xs text-slate-500">{{ $log->created_at->format('d M Y H:i') }} · {{ $log->ip_address }}</p>
                    </div>
                </div>
                <span class="px-2 py-1 rounded-lg bg-white/5 text-xs text-slate-400 font-mono">{{ $log->action }}</span>
            </div>
        @empty
            <div class="text-center py-12 text-slate-500">Belum ada aktivitas</div>
        @endforelse
    </div>
    {{ $logs->withQueryString()->links() }}
</div>
@endsection
