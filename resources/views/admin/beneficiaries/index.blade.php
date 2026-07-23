@extends('layouts.admin')

@section('page-title', 'Penerima Manfaat')
@section('breadcrumb')<span>Penerima Manfaat</span>@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Penerima Manfaat</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data penerima program makan bergizi gratis</p>
        </div>
        <a href="{{ route('admin.beneficiaries.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus mr-2"></i> Tambah Penerima
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <form method="GET" action="{{ route('admin.beneficiaries.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/NIK..." class="form-input flex-1">
            <select name="region_id" class="form-select sm:w-48">
                <option value="">Semua Wilayah</option>
                @foreach($regions as $id => $name)
                    <option value="{{ $id }}" {{ request('region_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            <select name="status" class="form-select sm:w-40">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
            <button type="submit" class="btn btn-secondary"><i class="fas fa-filter mr-2"></i> Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">NIK</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Wilayah</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kontak</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($beneficiaries as $b)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-semibold mr-3">
                                    {{ strtoupper(substr($b->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $b->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Str::limit($b->address, 30) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <code class="text-sm bg-gray-100 px-2 py-1 rounded">{{ $b->nik }}</code>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $b->region->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-phone text-gray-400 mr-2 text-xs"></i>
                                {{ $b->phone }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = ['active' => 'bg-green-100 text-green-700', 'inactive' => 'bg-gray-100 text-gray-700', 'pending' => 'bg-yellow-100 text-yellow-700'];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$b->status] }}">
                                {{ ucfirst($b->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.beneficiaries.edit', $b) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('admin.beneficiaries.destroy', $b) }}" class="inline" onsubmit="return confirm('Hapus penerima ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-users text-5xl text-gray-300 mb-3"></i>
                            <p>Belum ada data penerima manfaat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($beneficiaries->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">{{ $beneficiaries->links() }}</div>
        @endif
    </div>
</div>
@endsection
