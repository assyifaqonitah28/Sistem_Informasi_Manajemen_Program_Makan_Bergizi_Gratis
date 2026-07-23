@extends('layouts.admin')
@section('page-title', 'Buat Laporan')
@section('breadcrumb')<a href="{{ route('admin.reports.index') }}" class="hover:text-blue-600">Laporan</a><span class="mx-2">/</span><span>Buat</span>@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6"><i class="fas fa-file-medical mr-2 text-blue-600"></i> Buat Laporan Distribusi</h2>
        <form method="POST" action="{{ route('admin.reports.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Distribusi <span class="text-red-500">*</span></label>
                <select name="distribution_id" class="form-select @error('distribution_id') border-red-500 @enderror">
                    <option value="">-- Pilih Distribusi --</option>
                    @foreach($distributions as $dist)
                        <option value="{{ $dist->id }}">{{ $dist->program->name }} - {{ $dist->beneficiary->name }} ({{ $dist->distribution_date->format('d M Y') }})</option>
                    @endforeach
                </select>
                @error('distribution_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Laporan <span class="text-red-500">*</span></label>
                    <input type="date" name="report_date" value="{{ old('report_date', date('Y-m-d')) }}" class="form-input">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                    <select name="status" class="form-select">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" class="form-textarea">{{ old('description') }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Foto Bukti</label>
                <input type="file" name="image" class="form-input">
                <p class="text-xs text-gray-500">Max 2MB (JPG, PNG, WEBP)</p>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection
