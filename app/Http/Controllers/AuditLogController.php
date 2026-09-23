<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user');

        // Filter berdasarkan aktivitas
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter berdasarkan pengguna
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $auditLogs = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $users = User::orderBy('name')->get();

        return view('audit-log.index', compact('auditLogs', 'users'));
    }
}
