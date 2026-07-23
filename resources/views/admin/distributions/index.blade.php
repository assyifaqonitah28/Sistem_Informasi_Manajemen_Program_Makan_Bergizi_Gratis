@extends('layouts.admin')

@section('page-title', 'Manajemen Distribusi')
@section('breadcrumb')<span>Distribusi</span>@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Distribusi</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau penyaluran makanan bergizi gratis</p>
        </div>
        <a href="{{ route('admin.distributions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah Distribusi
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <form method="GET" action="{{ route('admin.distributions.index') }}" class="flex flex-col sm:flex-row gap-3">
            <select name="program_id" class="form-select sm:w-64">
                <option value="">Semua Program</option>
                @foreach($programs as $id => $name)
                    <option value="{{ $id }}" {{ request('program_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            <select name="status" class="form-select sm:w-48">
                <option value="">Semua Status</option>
                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                <option value="distributed" {{ request('status') == 'distributed' ? 'selected' : '' }}>Terdistribusi</option>
                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="btn btn-secondary"><i class="fas fa-filter mr-2"></i> Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Program</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Penerima</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Qty</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($distributions as $dist)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $dist->program->name }}</td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm text-gray-800">{{ $dist->beneficiary->name }}</p>
                                <p class="text-xs text-gray-500">{{ $dist->beneficiary->region->name ?? '-' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $dist->distribution_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $dist->quantity }} Porsi</td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = ['scheduled' => 'bg-blue-100 text-blue-700', 'distributed' => 'bg-green-100 text-green-700', 'failed' => 'bg-red-100 text-red-700', 'cancelled' => 'bg-gray-100 text-gray-700'];
                                $statusLabels = ['scheduled' => 'Terjadwal', 'distributed' => 'Terdistribusi', 'failed' => 'Gagal', 'cancelled' => 'Dibatalkan'];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$dist->status] }}">
                                {{ $statusLabels[$dist->status] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <!-- Tombol Detail (Show) -->
                                <a href="{{ route('admin.distributions.show', $dist) }}"
                                class="text-gray-600 hover:text-gray-800 transition" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.distributions.edit', $dist) }}"
                                class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form method="POST" action="{{ route('admin.distributions.destroy', $dist) }}" class="inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data distribusi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($distributions->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">{{ $distributions->links() }}</div>
        @endif
    </div>
</div>
@endsection
