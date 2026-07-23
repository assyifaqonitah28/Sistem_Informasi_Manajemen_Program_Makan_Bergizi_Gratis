@extends('layouts.user')

@section('page-title', 'Riwayat Penerimaan')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Riwayat Distribusi</h1>
        <p class="text-sm text-gray-500 mt-1">Pantau penyaluran makanan bergizi gratis.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4">
        <form method="GET" action="{{ route('user.history.index') }}" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama penerima..." class="form-input flex-1">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search mr-2"></i> Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Program</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Penerima</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Wilayah</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($distributions as $dist)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $dist->program->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $dist->beneficiary->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $dist->beneficiary->region->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $dist->distribution_date->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = ['scheduled' => 'bg-blue-100 text-blue-700', 'distributed' => 'bg-green-100 text-green-700', 'failed' => 'bg-red-100 text-red-700', 'cancelled' => 'bg-gray-100 text-gray-700'];
                                $statusLabels = ['scheduled' => 'Terjadwal', 'distributed' => 'Terdistribusi', 'failed' => 'Gagal', 'cancelled' => 'Dibatalkan'];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$dist->status] }}">
                                {{ $statusLabels[$dist->status] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada riwayat distribusi.</td></tr>
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
