@extends('layouts.app')
@section('title', 'Notifikasi')
@section('page-title', 'Notifikasi')
@section('sidebar-nav') @include('partials.sidebar-mahasiswa') @endsection

@section('content')
<div class="space-y-4 animate-fade-in">
    @if($notifications->where('is_read', false)->count() > 0)
        <div class="flex justify-end">
            <form action="{{ route('mahasiswa.notifications.readAll') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-indigo-400 hover:text-indigo-300 transition">Tandai semua dibaca</button>
            </form>
        </div>
    @endif

    <div class="space-y-2">
        @forelse($notifications as $notif)
            <div class="rounded-xl p-4 {{ !$notif->is_read ? 'bg-indigo-500/10 border border-indigo-500/20' : 'bg-slate-800/50 border border-white/5' }} transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-medium text-sm {{ !$notif->is_read ? 'text-indigo-300' : 'text-slate-300' }}">{{ $notif->title }}</p>
                        <p class="text-sm text-slate-400 mt-1">{{ $notif->message }}</p>
                        <p class="text-xs text-slate-500 mt-2">{{ $notif->created_at->diffForHumans() }}</p>
                    </div>
                    @if(!$notif->is_read)
                        <form action="{{ route('mahasiswa.notifications.read', $notif->id) }}" method="POST">
                            @csrf
                            <button class="text-xs text-indigo-400 hover:text-indigo-300 whitespace-nowrap">Tandai dibaca</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-slate-500">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                <p>Tidak ada notifikasi</p>
            </div>
        @endforelse
    </div>
    {{ $notifications->links() }}
</div>
@endsection
