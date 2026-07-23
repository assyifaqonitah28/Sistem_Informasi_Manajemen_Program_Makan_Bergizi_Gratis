<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Program;
use App\Models\Report;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Statistik untuk user
        $stats = [
            'active_programs' => Program::where('status', 'active')->count(),
            'total_distributions' => Distribution::count(),
            'my_reports' => Report::where('user_id', $user->id)->count(),
            'pending_reports' => Report::where('user_id', $user->id)->where('status', 'pending')->count(),
        ];

        // Distribusi terbaru
        $recentDistributions = Distribution::with(['program', 'beneficiary'])
            ->latest()
            ->take(5)
            ->get();

        // Program aktif
        $activePrograms = Program::where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        return view('user.dashboard', compact('stats', 'recentDistributions', 'activePrograms'));
    }
}
