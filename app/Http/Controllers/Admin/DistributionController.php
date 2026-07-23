<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Program;
use App\Models\Beneficiary;
use App\Http\Requests\Admin\StoreDistributionRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdateDistributionRequest;

class DistributionController extends Controller
{
    public function index(Request $request)
    {
        $query = Distribution::with(['program', 'beneficiary.region']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        $distributions = $query->latest('distribution_date')->paginate(15)->withQueryString();
        $programs = Program::pluck('name', 'id');

        return view('admin.distributions.index', compact('distributions', 'programs'));
    }

    public function create()
    {
        $programs = Program::where('status', 'active')->pluck('name', 'id');
        $beneficiaries = Beneficiary::where('status', 'active')->with('region')->get();
        return view('admin.distributions.create', compact('programs', 'beneficiaries'));
    }

    public function store(StoreDistributionRequest $request)
    {
        Distribution::create($request->validated());
        return redirect()->route('admin.distributions.index')->with('success', 'Distribusi berhasil dicatat!');
    }

    public function show(Distribution $distribution)
    {
        $distribution->load(['program', 'beneficiary.region', 'report']);
        return view('admin.distributions.show', compact('distribution'));
    }

    public function edit(Distribution $distribution)
    {
        $programs = Program::pluck('name', 'id');
        $beneficiaries = Beneficiary::where('status', 'active')->with('region')->get();
        return view('admin.distributions.edit', compact('distribution', 'programs', 'beneficiaries'));
    }

    public function update(UpdateDistributionRequest $request, Distribution $distribution)
    {
        $distribution->update($request->validated());
        return redirect()->route('admin.distributions.index')->with('success', 'Distribusi berhasil diperbarui!');
    }

    public function destroy(Distribution $distribution)
    {
        $distribution->report()->delete();
        $distribution->delete();
        return redirect()->route('admin.distributions.index')->with('success', 'Data distribusi dihapus.');
    }
}
