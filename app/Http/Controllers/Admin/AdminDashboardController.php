<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Beneficiary;
use App\Models\Distribution;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_programs' => Program::count(),
            'active_programs' => Program::where('status', 'active')->count(),
            'total_beneficiaries' => Beneficiary::count(),
            'total_distributions' => Distribution::count(),
            'total_reports' => Report::count(),
            'my_reports' => Report::count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
        ];

        $monthlyDistributions = Distribution::select(
                DB::raw("DATE_FORMAT(distribution_date, '%b') as month"),
                DB::raw('count(*) as total')
            )
            ->where('distribution_date', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthName = $months[now()->subMonths($i)->month - 1];
            $chartLabels[] = $monthName;
            $chartData[] = $monthlyDistributions[$monthName] ?? 0;
        }

        $recentActivities = Distribution::with(['program', 'beneficiary'])
            ->latest()
            ->take(5)
            ->get();

        $activePrograms = Program::where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        $recentDistributions = Distribution::with(['program', 'beneficiary'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'chartLabels',
            'chartData',
            'recentActivities',
            'activePrograms',
            'recentDistributions'
        ));
    }
}
