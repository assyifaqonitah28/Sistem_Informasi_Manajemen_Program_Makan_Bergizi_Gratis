<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Http\Requests\Admin\StoreRegionRequest;
use App\Http\Requests\Admin\UpdateRegionRequest;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        $query = Region::with('parent');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $regions = $query->latest()->paginate(15)->withQueryString();

        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        $provinces = Region::where('type', 'provinsi')->pluck('name', 'id');
        $cities = Region::where('type', 'kabupaten')->pluck('name', 'id');
        $districts = Region::where('type', 'kecamatan')->pluck('name', 'id');

        return view('admin.regions.create', compact('provinces', 'cities', 'districts'));
    }

    public function store(StoreRegionRequest $request)
    {
        Region::create($request->validated());

        return redirect()->route('admin.regions.index')
            ->with('success', 'Wilayah berhasil ditambahkan!');
    }

    public function edit(Region $region)
    {
        $provinces = Region::where('type', 'provinsi')->pluck('name', 'id');
        $cities = Region::where('type', 'kabupaten')->pluck('name', 'id');
        $districts = Region::where('type', 'kecamatan')->pluck('name', 'id');

        return view('admin.regions.edit', compact('region', 'provinces', 'cities', 'districts'));
    }

    public function update(UpdateRegionRequest $request, Region $region)
    {
        $region->update($request->validated());

        return redirect()->route('admin.regions.index')
            ->with('success', 'Wilayah berhasil diperbarui!');
    }

    public function destroy(Region $region)
    {
        // Cek apakah ada child region
        if ($region->children()->count() > 0) {
            return redirect()->route('admin.regions.index')
                ->with('error', 'Tidak dapat menghapus wilayah yang memiliki anak wilayah!');
        }

        // Cek apakah ada beneficiary di wilayah ini
        if ($region->beneficiaries()->count() > 0) {
            return redirect()->route('admin.regions.index')
                ->with('error', 'Tidak dapat menghapus wilayah yang memiliki penerima manfaat!');
        }

        $region->delete();

        return redirect()->route('admin.regions.index')
            ->with('success', 'Wilayah berhasil dihapus!');
    }

    // Endpoint untuk AJAX cascading dropdown
    public function getChildren(Request $request)
    {
        $parentId = $request->parent_id;
        $type = $request->type;

        $children = Region::where('parent_id', $parentId)
            ->where('type', $type)
            ->pluck('name', 'id');

        return response()->json($children);
    }
}
