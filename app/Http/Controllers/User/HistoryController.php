<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Distribution::with(['program', 'beneficiary.region']);

        if ($request->filled('search')) {
            $query->whereHas('beneficiary', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $distributions = $query->latest('distribution_date')->paginate(10)->withQueryString();

        return view('user.distributions.index', compact('distributions'));
    }
}
