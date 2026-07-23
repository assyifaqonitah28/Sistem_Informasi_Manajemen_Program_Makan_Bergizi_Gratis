@extends('layouts.admin')

@section('page-title', 'Detail Distribusi')
@section('breadcrumb')
    <a href="{{ route('admin.distributions.index') }}" class="hover:text-blue-600">Distribusi</a>
    <span class="mx-2">/</span><span>Detail</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Distribusi #{{ $distribution->id }}</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap penyaluran makanan</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.distributions.edit', $distribution) }}" class="btn btn-secondary">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.distributions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Main Info Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Program</p>
                    <p class="text-lg font-semibold text-gray-800 mt-1">{{ $distribution->program->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Penerima Manfaat</p>
                    <p class="text-lg font-semibold text-gray-800 mt-1">{{ $distribution->beneficiary->name }}</p>
                    <p class="text-sm text-gray-500 mt-1"><i class="fas fa-map-marker-alt mr-1"></i> {{ $distribution->beneficiary->region->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Distribusi</p>
                    <p class="text-lg font-semibold text-gray-800 mt-1">
                        <i class="fas fa-calendar-alt mr-2 text-gray-400"></i> {{ $distribution->distribution_date->format('d F Y') }}
                    </p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Porsi</p>
                    <p class="text-lg font-semibold text-gray-800 mt-1">
                        <i class="fas fa-utensils mr-2 text-gray-400"></i> {{ $distribution->quantity }} Porsi
                    </p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status</p>
                    <div class="mt-2">
                        @php
                            $statusColors = ['scheduled' => 'bg-blue-100 text-blue-700', 'distributed' => 'bg-green-100 text-green-700', 'failed' => 'bg-red-100 text-red-700', 'cancelled' => 'bg-gray-100 text-gray-700'];
                            $statusLabels = ['scheduled' => 'Terjadwal', 'distributed' => 'Terdistribusi', 'failed' => 'Gagal', 'cancelled' => 'Dibatalkan'];
                        @endphp
                        <span class="px-4 py-2 text-sm font-medium rounded-full {{ $statusColors[$distribution->status] }}">
                            {{ $statusLabels[$distribution->status] }}
                        </span>
                    </div>
                </div>
                @if($distribution->notes)
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</p>
                    <p class="text-sm text-gray-700 mt-1 bg-gray-50 p-3 rounded-lg">{{ $distribution->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Report Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-file-medical mr-2 text-blue-600"></i> Laporan Terkait
        </h3>
        @if($distribution->report)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Laporan</p>
                    <p class="text-base font-medium text-gray-800 mt-1">{{ $distribution->report->report_date->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status Laporan</p>
                    <div class="mt-1">
                        @php
                            $repColors = ['pending' => 'bg-yellow-100 text-yellow-700', 'approved' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700'];
                            $repLabels = ['pending' => 'Menunggu', 'approved' => 'Disetujui', 'rejected' => 'Ditolak'];
                        @endphp
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $repColors[$distribution->report->status] }}">
                            {{ $repLabels[$distribution->report->status] }}
                        </span>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</p>
                    <p class="text-sm text-gray-700 mt-1">{{ $distribution->report->description }}</p>
                </div>
                @if($distribution->report->image)
                <div class="md:col-span-2">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Foto Bukti</p>
                    <img src="{{ asset('storage/' . $distribution->report->image) }}" class="max-h-64 rounded-lg shadow-sm border border-gray-200">
                </div>
                @endif
            </div>
        @else
            <div class="text-center py-8 bg-gray-50 rounded-lg">
                <i class="fas fa-folder-open text-3xl text-gray-400 mb-2"></i>
                <p class="text-gray-500">Belum ada laporan yang dibuat untuk distribusi ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
