@extends('layouts.admin')

@section('page-title', 'Manajemen Wilayah')
@section('breadcrumb')<span>Wilayah</span>@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Wilayah</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data provinsi, kabupaten, kecamatan, dan desa</p>
        </div>
        <a href="{{ route('admin.regions.create') }}" class="btn btn-primary">
            <i class="fas fa-map-marker-alt mr-2"></i> Tambah Wilayah
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <form method="GET" action="{{ route('admin.regions.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama wilayah..." class="form-input flex-1">
            <select name="type" class="form-select sm:w-48">
                <option value="">Semua Tipe</option>
                <option value="provinsi" {{ request('type') == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                <option value="kabupaten" {{ request('type') == 'kabupaten' ? 'selected' : '' }}>Kabupaten/Kota</option>
                <option value="kecamatan" {{ request('type') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                <option value="desa" {{ request('type') == 'desa' ? 'selected' : '' }}>Desa/Kelurahan</option>
            </select>
            <button type="submit" class="btn btn-secondary"><i class="fas fa-filter mr-2"></i> Filter</button>
            @if(request()->hasAny(['search', 'type']))
                <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary"><i class="fas fa-times mr-2"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama Wilayah</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tipe</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Wilayah Induk</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($regions as $region)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $region->name }}</p>
                                    <p class="text-xs text-gray-500">ID: #{{ $region->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $typeColors = [
                                    'provinsi' => 'bg-purple-100 text-purple-700',
                                    'kabupaten' => 'bg-blue-100 text-blue-700',
                                    'kecamatan' => 'bg-green-100 text-green-700',
                                    'desa' => 'bg-yellow-100 text-yellow-700',
                                ];
                                $typeLabels = [
                                    'provinsi' => 'Provinsi',
                                    'kabupaten' => 'Kabupaten',
                                    'kecamatan' => 'Kecamatan',
                                    'desa' => 'Desa',
                                ];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $typeColors[$region->type] }}">
                                {{ $typeLabels[$region->type] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $region->parent->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.regions.edit', $region) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.regions.destroy', $region) }}" class="inline" onsubmit="return confirm('Hapus wilayah ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-map text-5xl text-gray-300 mb-3"></i>
                            <p>Belum ada data wilayah.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($regions->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">{{ $regions->links() }}</div>
        @endif
    </div>
</div>
@endsection
