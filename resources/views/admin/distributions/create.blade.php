@extends('layouts.admin')

@section('page-title', 'Tambah Distribusi')
@section('breadcrumb')
    <a href="{{ route('admin.distributions.index') }}" class="hover:text-blue-600">Distribusi</a>
    <span class="mx-2">/</span><span>Tambah</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-truck mr-2 text-blue-600"></i> Catat Distribusi Baru
        </h2>

        <form method="POST" action="{{ route('admin.distributions.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Program <span class="text-red-500">*</span></label>
                    <select name="program_id" class="form-select @error('program_id') border-red-500 @enderror">
                        <option value="">-- Pilih Program --</option>
                        @foreach($programs as $id => $name)
                            <option value="{{ $id }}" {{ old('program_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('program_id')<p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Penerima Manfaat <span class="text-red-500">*</span></label>
                    <select name="beneficiary_id" class="form-select @error('beneficiary_id') border-red-500 @enderror">
                        <option value="">-- Pilih Penerima --</option>
                        @foreach($beneficiaries as $b)
                            <option value="{{ $b->id }}" {{ old('beneficiary_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->name }} ({{ $b->region->name }})
                            </option>
                        @endforeach
                    </select>
                    @error('beneficiary_id')<p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" name="distribution_date" value="{{ old('distribution_date') }}" class="form-input @error('distribution_date') border-red-500 @enderror">
                    @error('distribution_date')<p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Jumlah (Porsi) <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" class="form-input @error('quantity') border-red-500 @enderror">
                    @error('quantity')<p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                    <select name="status" class="form-select @error('status') border-red-500 @enderror">
                        <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                        <option value="distributed" {{ old('status') == 'distributed' ? 'selected' : '' }}>Terdistribusi</option>
                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status')<p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="notes" rows="3" class="form-textarea @error('notes') border-red-500 @enderror" placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
                @error('notes')<p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>@enderror
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.distributions.index') }}" class="btn btn-secondary w-full sm:w-auto"><i class="fas fa-times mr-2"></i> Batal</a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto"><i class="fas fa-save mr-2"></i> Simpan Distribusi</button>
            </div>
        </form>
    </div>
</div>
@endsection
