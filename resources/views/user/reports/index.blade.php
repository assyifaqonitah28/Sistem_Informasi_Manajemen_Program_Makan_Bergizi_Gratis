@extends('layouts.user')

@section('page-title', 'Laporan Saya')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Laporan Saya</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar laporan distribusi yang pernah Anda buat.</p>
        </div>
        <a href="{{ route('user.reports.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Buat Laporan Baru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Program</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Penerima</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal Laporan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($reports as $report)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $report->distribution->program->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $report->distribution->beneficiary->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $report->report_date->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = ['pending' => 'bg-yellow-100 text-yellow-700', 'approved' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700'];
                                $statusLabels = ['pending' => 'Menunggu', 'approved' => 'Disetujui', 'rejected' => 'Ditolak'];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$report->status] }}">
                                {{ $statusLabels[$report->status] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-gray-500">Anda belum membuat laporan apapun.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reports->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">{{ $reports->links() }}</div>
        @endif
    </div>
</div>
@endsection
