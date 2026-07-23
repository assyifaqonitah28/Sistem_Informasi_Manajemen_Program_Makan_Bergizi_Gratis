@extends('layouts.admin')

@section('page-title', 'Edit Program')

@section('breadcrumb')
    <a href="{{ route('admin.programs.index') }}" class="hover:text-blue-600">Program</a>
    <span class="mx-2">/</span>
    <span>Edit</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-edit mr-2 text-blue-600"></i> Edit Program
        </h2>

        <form method="POST" action="{{ route('admin.programs.update', $program) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Program <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $program->name) }}"
                       class="form-input @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="form-textarea @error('description') border-red-500 @enderror">{{ old('description', $program->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Program</label>
                @if($program->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $program->image) }}" class="max-h-48 rounded-lg shadow-sm">
                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i> Upload gambar baru untuk mengganti.
                        </p>
                    </div>
                @endif
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-500 transition">
                    <input type="file" name="image" id="image" accept="image/*"
                           class="hidden"
                           onchange="previewImage(event)">
                    <label for="image" class="cursor-pointer flex flex-col items-center">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <span class="text-sm text-gray-600 font-medium">Klik untuk upload gambar baru</span>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="start_date" value="{{ old('start_date', $program->start_date->format('Y-m-d')) }}"
                           class="form-input @error('start_date') border-red-500 @enderror">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="end_date" value="{{ old('end_date', $program->end_date->format('Y-m-d')) }}"
                           class="form-input @error('end_date') border-red-500 @enderror">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" class="form-select @error('status') border-red-500 @enderror">
                    @foreach(['draft' => 'Draft', 'active' => 'Aktif', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $value => $label)
                        <option value="{{ $value }}" {{ old('status', $program->status) == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.programs.index') }}"
                   class="btn btn-secondary">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Update Program
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
