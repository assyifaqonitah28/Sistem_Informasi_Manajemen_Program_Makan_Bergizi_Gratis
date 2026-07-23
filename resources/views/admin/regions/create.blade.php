@extends('layouts.admin')

@section('page-title', 'Tambah Wilayah')

@section('breadcrumb')
    <a href="{{ route('admin.regions.index') }}" class="hover:text-blue-600">Wilayah</a>
    <span class="mx-2">/</span>
    <span>Tambah</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i> Tambah Wilayah Baru
        </h2>

        <form method="POST" action="{{ route('admin.regions.store') }}" class="space-y-6">
            @csrf

            <!-- Tipe Wilayah -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Tipe Wilayah <span class="text-red-500">*</span>
                </label>
                <select name="type" id="type" class="form-select @error('type') border-red-500 @enderror" onchange="updateParentOptions()">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="provinsi" {{ old('type') == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                    <option value="kabupaten" {{ old('type') == 'kabupaten' ? 'selected' : '' }}>Kabupaten/Kota</option>
                    <option value="kecamatan" {{ old('type') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                    <option value="desa" {{ old('type') == 'desa' ? 'selected' : '' }}>Desa/Kelurahan</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Wilayah Induk (Parent) -->
            <div class="space-y-2" id="parent-container" style="display: none;">
                <label class="block text-sm font-medium text-gray-700">
                    Wilayah Induk <span class="text-red-500">*</span>
                </label>
                <select name="parent_id" id="parent_id" class="form-select @error('parent_id') border-red-500 @enderror">
                    <option value="">-- Pilih Wilayah Induk --</option>
                </select>
                @error('parent_id')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
                <p class="text-xs text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i> Pilih wilayah induk sesuai hierarki.
                </p>
            </div>

            <!-- Nama Wilayah -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Nama Wilayah <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-input @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama wilayah">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-medium mb-1">Struktur Hierarki Wilayah:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li><strong>Provinsi</strong> → Tidak memiliki wilayah induk</li>
                            <li><strong>Kabupaten/Kota</strong> → Induk: Provinsi</li>
                            <li><strong>Kecamatan</strong> → Induk: Kabupaten/Kota</li>
                            <li><strong>Desa/Kelurahan</strong> → Induk: Kecamatan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary w-full sm:w-auto">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto">
                    <i class="fas fa-save mr-2"></i> Simpan Wilayah
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Data dari controller
const provinces = @json($provinces);
const cities = @json($cities);
const districts = @json($districts);

function updateParentOptions() {
    const type = document.getElementById('type').value;
    const parentContainer = document.getElementById('parent-container');
    const parentSelect = document.getElementById('parent_id');

    parentSelect.innerHTML = '<option value="">-- Pilih Wilayah Induk --</option>';

    if (type === 'provinsi') {
        parentContainer.style.display = 'none';
        parentSelect.value = '';
        return;
    }

    parentContainer.style.display = 'block';

    let options = {};
    if (type === 'kabupaten') options = provinces;
    else if (type === 'kecamatan') options = cities;
    else if (type === 'desa') options = districts;

    for (const [id, name] of Object.entries(options)) {
        const option = document.createElement('option');
        option.value = id;
        option.textContent = name;
        parentSelect.appendChild(option);
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateParentOptions();
});
</script>
@endsection
