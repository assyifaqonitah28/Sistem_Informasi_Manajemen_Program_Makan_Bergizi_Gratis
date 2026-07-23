@extends('layouts.admin')

@section('page-title', 'Edit / Verifikasi Laporan')
@section('breadcrumb')
    <a href="{{ route('admin.reports.index') }}" class="hover:text-blue-600">Laporan</a>
    <span class="mx-2">/</span><span>Edit</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-edit mr-2 text-blue-600"></i> Edit & Verifikasi Laporan
        </h2>

        <!-- Info Distribusi (Read Only) -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <p class="text-xs font-medium text-blue-800 uppercase mb-2">Distribusi Terkait</p>
            <p class="text-sm text-blue-900 font-medium">{{ $report->distribution->program->name }} - {{ $report->distribution->beneficiary->name }}</p>
            <p class="text-xs text-blue-700 mt-1">{{ $report->distribution->distribution_date->format('d M Y') }}</p>
        </div>

        <form method="POST" action="{{ route('admin.reports.update', $report) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Laporan <span class="text-red-500">*</span></label>
                    <input type="date" name="report_date" value="{{ old('report_date', $report->report_date->format('Y-m-d')) }}" class="form-input @error('report_date') border-red-500 @enderror">
                    @error('report_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Status Verifikasi <span class="text-red-500">*</span></label>
                    <select name="status" class="form-select @error('status') border-red-500 @enderror">
                        <option value="pending" {{ old('status', $report->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $report->status) == 'approved' ? 'selected' : '' }}>Approved (Disetujui)</option>
                        <option value="rejected" {{ old('status', $report->status) == 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                    </select>
                    @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" class="form-textarea @error('description') border-red-500 @enderror">{{ old('description', $report->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Foto Bukti</label>
                @if($report->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $report->image) }}" class="max-h-40 rounded-lg shadow-sm border">
                        <p class="text-xs text-gray-500 mt-1">Upload foto baru untuk mengganti.</p>
                    </div>
                @endif
                <input type="file" name="image" class="form-input">
                <p class="text-xs text-gray-500">Max 2MB (JPG, PNG, WEBP)</p>
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection
