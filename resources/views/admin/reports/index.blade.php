@extends('layouts.admin')

@section('page-title', 'Manajemen Laporan')
@section('breadcrumb')<span>Laporan</span>@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Laporan</h1>
            <p class="text-sm text-gray-500 mt-1">Verifikasi dan kelola laporan distribusi</p>
        </div>
        <a href="{{ route('admin.reports.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Buat Laporan
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4">
        <form method="GET" action="{{ route('admin.reports.index') }}" class="flex gap-3">
            <select name="status" class="form-select sm:w-48">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <button type="submit" class="btn btn-secondary"><i class="fas fa-filter mr-2"></i> Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Program & Penerima</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Pelapor</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Bukti</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($reports as $report)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-800">{{ $report->distribution->program->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $report->distribution->beneficiary->name ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $report->user->name ?? 'System' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $report->report_date->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @if($report->image)
                                <img src="{{ asset('storage/' . $report->image) }}" class="w-10 h-10 rounded object-cover">
                            @else
                                <span class="text-xs text-gray-400">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $colors = ['pending' => 'bg-yellow-100 text-yellow-700', 'approved' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700'];
                                $labels = ['pending' => 'Pending', 'approved' => 'Disetujui', 'rejected' => 'Ditolak'];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $colors[$report->status] }}">{{ $labels[$report->status] }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <!-- Tombol Detail (Show) -->
                                <a href="{{ route('admin.reports.show', $report) }}"
                                class="text-gray-600 hover:text-gray-800 transition" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.reports.edit', $report) }}"
                                class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form method="POST" action="{{ route('admin.reports.destroy', $report) }}" class="inline" onsubmit="return confirm('Hapus laporan?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada laporan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reports->hasPages())<div class="px-6 py-4 border-t bg-gray-50">{{ $reports->links() }}</div>@endif
    </div>
</div>
@endsection
