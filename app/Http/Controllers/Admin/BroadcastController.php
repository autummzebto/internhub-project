<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AppNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BroadcastController extends Controller
{
    public function index()
    {
        return view('admin.broadcast');
    }

    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'target' => 'required|in:all,mahasiswa,dosen',
        ]);

        $query = User::query();
        if ($request->target !== 'all') {
            $query->where('role', $request->target);
        } else {
            $query->whereIn('role', ['mahasiswa', 'dosen']);
        }

        $users = $query->get();

        foreach ($users as $user) {
            AppNotification::create([
                'id' => Str::uuid(),
                'user_id' => $user->id,
                'type' => 'broadcast',
                'title' => $request->title,
                'message' => $request->message,
            ]);
        }

        ActivityLog::log('admin_broadcast', "Admin mengirim broadcast ke {$request->target}: {$request->title}");

        return back()->with('success', "Pengumuman berhasil dikirim ke {$users->count()} pengguna.");
    }
}
