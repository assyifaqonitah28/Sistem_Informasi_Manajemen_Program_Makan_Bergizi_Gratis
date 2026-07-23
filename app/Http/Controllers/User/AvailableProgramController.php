<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class AvailableProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::where('status', 'active');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $programs = $query->latest()->paginate(10)->withQueryString();

        return view('user.programs.index', compact('programs'));
    }
}
