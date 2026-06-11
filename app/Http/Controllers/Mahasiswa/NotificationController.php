<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->appNotifications()->paginate(20);
        return view('mahasiswa.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->appNotifications()->findOrFail($id);
        $notification->markAsRead();
        return back()->with('success', 'Notifikasi telah ditandai dibaca.');
    }

    public function markAllRead()
    {
        auth()->user()->appNotifications()->where('is_read', false)->update(['is_read' => true]);
        return back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }
}
