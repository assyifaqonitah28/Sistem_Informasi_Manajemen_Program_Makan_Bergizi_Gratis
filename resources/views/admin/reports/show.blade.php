@extends('layouts.admin')

@section('page-title', 'Detail Laporan')
@section('breadcrumb')
    <a href="{{ route('admin.reports.index') }}" class="hover:text-blue-600">Laporan</a>
    <span class="mx-2">/</span><span>Detail</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Laporan #{{ $report->id }}</h1>
            <p class="text-sm text-gray-500 mt-1">Verifikasi dan tinjau laporan distribusi</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.reports.edit', $report) }}" class="btn btn-secondary">
                <i class="fas fa-edit mr-2"></i> Edit / Verifikasi
            </a>
            <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Info Distribusi -->
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
            <i class="fas fa-truck mr-2 text-blue-600"></i> Informasi Distribusi
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase">Program</p>
                <p class="font-medium text-gray-800 mt-1">{{ $report->distribution->program->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase">Penerima</p>
                <p class="font-medium text-gray-800 mt-1">{{ $report->distribution->beneficiary->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase">Tanggal Distribusi</p>
                <p class="font-medium text-gray-800 mt-1">{{ $report->distribution->distribution_date->format('d M Y') ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Detail Laporan -->
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
            <i class="fas fa-file-medical mr-2 text-green-600"></i> Detail Laporan
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase">Dilaporkan Oleh</p>
                <p class="font-medium text-gray-800 mt-1 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold mr-2">
                        {{ strtoupper(substr($report->user->name ?? 'S', 0, 1)) }}
                    </div>
                    {{ $report->user->name ?? 'System' }}
                </p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase">Tanggal Laporan</p>
                <p class="font-medium text-gray-800 mt-1">{{ $report->report_date->format('d M Y') }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-xs font-medium text-gray-500 uppercase">Status Verifikasi</p>
                <div class="mt-2">
                    @php
                        $colors = ['pending' => 'bg-yellow-100 text-yellow-700', 'approved' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700'];
                        $labels = ['pending' => 'Menunggu Verifikasi', 'approved' => 'Disetujui', 'rejected' => 'Ditolak'];
                    @endphp
                    <span class="px-4 py-2 text-sm font-medium rounded-full {{ $colors[$report->status] }}">
                        {{ $labels[$report->status] }}
                    </span>
                </div>
            </div>
            <div class="md:col-span-2">
                <p class="text-xs font-medium text-gray-500 uppercase">Deskripsi / Catatan Lapangan</p>
                <p class="text-sm text-gray-700 mt-1 bg-gray-50 p-4 rounded-lg border border-gray-100 whitespace-pre-wrap">{{ $report->description }}</p>
            </div>
        </div>

        @if($report->image)
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase mb-2">Foto Bukti Distribusi</p>
            <div class="border border-gray-200 rounded-lg p-2 inline-block">
                <img src="{{ asset('storage/' . $report->image) }}" class="max-h-80 rounded shadow-sm">
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
