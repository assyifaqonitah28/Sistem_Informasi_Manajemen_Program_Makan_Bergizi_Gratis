<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Region;
use App\Http\Requests\Admin\StoreBeneficiaryRequest;
use App\Http\Requests\Admin\UpdateBeneficiaryRequest;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        $query = Beneficiary::with('region');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $beneficiaries = $query->latest()->paginate(15)->withQueryString();
        $regions = Region::where('type', 'desa')->pluck('name', 'id');

        return view('admin.beneficiaries.index', compact('beneficiaries', 'regions'));
    }

    public function create()
    {
        $regions = Region::where('type', 'desa')->pluck('name', 'id');
        return view('admin.beneficiaries.create', compact('regions'));
    }

    public function store(StoreBeneficiaryRequest $request)
    {
        Beneficiary::create($request->validated());

        return redirect()->route('admin.beneficiaries.index')
            ->with('success', 'Penerima manfaat berhasil ditambahkan!');
    }

    public function edit(Beneficiary $beneficiary)
    {
        $regions = Region::where('type', 'desa')->pluck('name', 'id');
        return view('admin.beneficiaries.edit', compact('beneficiary', 'regions'));
    }

    public function update(UpdateBeneficiaryRequest $request, Beneficiary $beneficiary)
    {
        $beneficiary->update($request->validated());

        return redirect()->route('admin.beneficiaries.index')
            ->with('success', 'Penerima manfaat berhasil diperbarui!');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        if ($beneficiary->distributions()->count() > 0) {
            return redirect()->route('admin.beneficiaries.index')
                ->with('error', 'Tidak dapat menghapus penerima yang memiliki riwayat distribusi!');
        }

        $beneficiary->delete();

        return redirect()->route('admin.beneficiaries.index')
            ->with('success', 'Penerima manfaat berhasil dihapus!');
    }
}
