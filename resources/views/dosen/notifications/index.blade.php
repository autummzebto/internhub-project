@extends('layouts.app')
@section('title', 'Notifikasi')
@section('page-title', 'Notifikasi')
@section('sidebar-nav') @include('partials.sidebar-dosen') @endsection

@section('content')
<div class="space-y-4 animate-fade-in">
    @if($notifications->where('is_read', false)->count() > 0)
        <div class="flex justify-end">
            <form action="{{ route('dosen.notifications.readAll') }}" method="POST">@csrf
                <button type="submit" class="text-sm text-indigo-400 hover:text-indigo-300 transition">Tandai semua dibaca</button>
            </form>
        </div>
    @endif
    <div class="space-y-2">
        @forelse($notifications as $notif)
            <div class="rounded-xl p-4 {{ !$notif->is_read ? 'bg-indigo-500/10 border border-indigo-500/20' : 'bg-slate-800/50 border border-white/5' }}">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-medium text-sm {{ !$notif->is_read ? 'text-indigo-300' : 'text-slate-300' }}">{{ $notif->title }}</p>
                        <p class="text-sm text-slate-400 mt-1">{{ $notif->message }}</p>
                        <p class="text-xs text-slate-500 mt-2">{{ $notif->created_at->diffForHumans() }}</p>
                    </div>
                    @if(!$notif->is_read)
                        <form action="{{ route('dosen.notifications.read', $notif->id) }}" method="POST">@csrf
                            <button class="text-xs text-indigo-400 hover:text-indigo-300 whitespace-nowrap">Tandai dibaca</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-slate-500">Tidak ada notifikasi</div>
        @endforelse
    </div>
    {{ $notifications->links() }}
</div>
@endsection
