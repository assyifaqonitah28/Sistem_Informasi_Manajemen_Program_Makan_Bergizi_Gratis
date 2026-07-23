@extends('layouts.admin')

@section('page-title', 'Tambah Penerima Manfaat')

@section('breadcrumb')
    <a href="{{ route('admin.beneficiaries.index') }}" class="hover:text-blue-600">Penerima Manfaat</a>
    <span class="mx-2">/</span>
    <span>Tambah</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-user-plus mr-2 text-green-600"></i> Tambah Penerima Manfaat
        </h2>

        <form method="POST" action="{{ route('admin.beneficiaries.store') }}" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-input @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama lengkap penerima">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- NIK -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nik" value="{{ old('nik') }}"
                       class="form-input @error('nik') border-red-500 @enderror"
                       placeholder="16 digit NIK"
                       maxlength="16"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                @error('nik')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
                <p class="text-xs text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i> NIK harus 16 digit angka dan unik.
                </p>
            </div>

            <!-- Wilayah -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Wilayah (Desa/Kelurahan) <span class="text-red-500">*</span>
                </label>
                <select name="region_id" class="form-select @error('region_id') border-red-500 @enderror">
                    <option value="">-- Pilih Wilayah --</option>
                    @foreach($regions as $id => $name)
                        <option value="{{ $id }}" {{ old('region_id') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('region_id')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
                <p class="text-xs text-gray-500">
                    <i class="fas fa-map-marker-alt mr-1"></i> Pilih desa/kelurahan tempat penerima tinggal.
                </p>
            </div>

            <!-- Alamat -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Alamat Lengkap <span class="text-red-500">*</span>
                </label>
                <textarea name="address" rows="3"
                          class="form-textarea @error('address') border-red-500 @enderror"
                          placeholder="Masukkan alamat lengkap (RT/RW, Dusun, Desa)">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Nomor Telepon <span class="text-red-500">*</span>
                </label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="form-input @error('phone') border-red-500 @enderror"
                       placeholder="08xxxxxxxxxx">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Status -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" class="form-select @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active (Aktif)</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive (Tidak Aktif)</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending (Menunggu Verifikasi)</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-green-600 mt-0.5 mr-3"></i>
                    <div class="text-sm text-green-800">
                        <p class="font-medium mb-1">Informasi Penting:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>NIK harus sesuai dengan KTP penerima manfaat.</li>
                            <li>Setiap NIK hanya dapat didaftarkan satu kali.</li>
                            <li>Status "Active" berarti penerima dapat menerima distribusi.</li>
                            <li>Status "Pending" berarti data masih dalam proses verifikasi.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.beneficiaries.index') }}"
                   class="btn btn-secondary w-full sm:w-auto">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto">
                    <i class="fas fa-save mr-2"></i> Simpan Penerima
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
