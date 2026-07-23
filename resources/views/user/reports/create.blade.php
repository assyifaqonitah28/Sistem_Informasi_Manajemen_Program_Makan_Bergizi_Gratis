@extends('layouts.user')

@section('page-title', 'Buat Laporan Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-file-medical mr-2 text-green-600"></i> Input Laporan Distribusi
        </h2>

        <form method="POST" action="{{ route('user.reports.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Pilih Distribusi -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Distribusi yang Dilaporkan <span class="text-red-500">*</span>
                </label>
                <select name="distribution_id" class="form-select @error('distribution_id') border-red-500 @enderror">
                    <option value="">-- Pilih Distribusi --</option>
                    @forelse($distributions as $dist)
                        <option value="{{ $dist->id }}" {{ old('distribution_id') == $dist->id ? 'selected' : '' }}>
                            {{ $dist->program->name }} - {{ $dist->beneficiary->name }} ({{ $dist->distribution_date->format('d M Y') }})
                        </option>
                    @empty
                        <option value="" disabled>Tidak ada distribusi yang tersedia untuk dilaporkan.</option>
                    @endforelse
                </select>
                @error('distribution_id')
                    <p class="text-red-500 text-xs mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500"><i class="fas fa-info-circle mr-1"></i> Hanya menampilkan distribusi berstatus "Terdistribusi" yang belum dilaporkan.</p>
            </div>

            <!-- Tanggal Laporan -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Tanggal Laporan <span class="text-red-500">*</span></label>
                <input type="date" name="report_date" value="{{ old('report_date', date('Y-m-d')) }}" class="form-input @error('report_date') border-red-500 @enderror">
                @error('report_date')
                    <p class="text-red-500 text-xs mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Keterangan / Catatan Lapangan <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" class="form-textarea @error('description') border-red-500 @enderror" placeholder="Contoh: Penerima hadir dan menerima 2 porsi makanan...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Foto Bukti -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Foto Bukti Distribusi</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-green-500 transition">
                    <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(event)">
                    <label for="image" class="cursor-pointer flex flex-col items-center">
                        <i class="fas fa-camera text-4xl text-gray-400 mb-2"></i>
                        <span class="text-sm text-gray-600 font-medium">Klik untuk upload foto</span>
                        <span class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</span>
                    </label>
                </div>
                <img id="preview" class="mt-4 hidden max-h-48 rounded-lg shadow-sm">
                @error('image')
                    <p class="text-red-500 text-xs mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('user.reports.index') }}" class="btn btn-secondary w-full sm:w-auto">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    }
}
</script>
@endsection
