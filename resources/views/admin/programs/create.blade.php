@extends('layouts.admin')

@section('page-title', 'Tambah Program')

@section('breadcrumb')
    <a href="{{ route('admin.programs.index') }}" class="hover:text-blue-600">Program</a>
    <span class="mx-2">/</span>
    <span>Tambah</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-plus-circle mr-2 text-blue-600"></i> Tambah Program
        </h2>

        <form method="POST" action="{{ route('admin.programs.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Nama Program <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-input @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama program">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Deskripsi
                </label>
                <textarea name="description" rows="4"
                          class="form-textarea @error('description') border-red-500 @enderror"
                          placeholder="Masukkan deskripsi program">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Gambar -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Gambar Program
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-500 transition duration-200">
                    <input type="file" name="image" id="image" accept="image/*"
                           class="hidden"
                           onchange="previewImage(event)">
                    <label for="image" class="cursor-pointer flex flex-col items-center">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <span class="text-sm text-gray-600 font-medium">Klik untuk upload gambar</span>
                        <span class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB.</span>
                    </label>
                </div>
                <img id="preview" class="mt-4 hidden max-h-48 rounded-lg shadow-sm">
                @error('image')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Tanggal Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                           class="form-input @error('start_date') border-red-500 @enderror">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Tanggal Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                           class="form-input @error('end_date') border-red-500 @enderror">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" class="form-select @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.programs.index') }}"
                   class="btn btn-secondary w-full sm:w-auto">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto">
                    <i class="fas fa-save mr-2"></i> Simpan Program
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
