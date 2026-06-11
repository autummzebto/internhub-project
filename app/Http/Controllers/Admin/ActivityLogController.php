<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        if ($request->filled('search')) {
            $query->where('description', 'like', "%{$request->search}%")
                  ->orWhere('action', 'like', "%{$request->search}%");
        }

        $logs = $query->paginate(25);
        return view('admin.activity-log', compact('logs'));
    }
}
