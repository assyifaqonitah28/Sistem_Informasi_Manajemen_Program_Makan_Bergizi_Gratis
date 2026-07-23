@extends('layouts.admin')

@section('page-title', 'Edit Penerima Manfaat')

@section('breadcrumb')
    <a href="{{ route('admin.beneficiaries.index') }}" class="hover:text-blue-600">Penerima Manfaat</a>
    <span class="mx-2">/</span>
    <span>Edit</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-user-edit mr-2 text-green-600"></i> Edit Penerima Manfaat
        </h2>

        <form method="POST" action="{{ route('admin.beneficiaries.update', $beneficiary) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $beneficiary->name) }}"
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
                <input type="text" name="nik" value="{{ old('nik', $beneficiary->nik) }}"
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
                        <option value="{{ $id }}" {{ old('region_id', $beneficiary->region_id) == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('region_id')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Alamat Lengkap <span class="text-red-500">*</span>
                </label>
                <textarea name="address" rows="3"
                          class="form-textarea @error('address') border-red-500 @enderror"
                          placeholder="Masukkan alamat lengkap">{{ old('address', $beneficiary->address) }}</textarea>
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
                <input type="text" name="phone" value="{{ old('phone', $beneficiary->phone) }}"
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
                    <option value="active" {{ old('status', $beneficiary->status) == 'active' ? 'selected' : '' }}>Active (Aktif)</option>
                    <option value="inactive" {{ old('status', $beneficiary->status) == 'inactive' ? 'selected' : '' }}>Inactive (Tidak Aktif)</option>
                    <option value="pending" {{ old('status', $beneficiary->status) == 'pending' ? 'selected' : '' }}>Pending (Menunggu Verifikasi)</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Info Penerima Saat Ini -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-user-shield text-gray-600 mt-0.5 mr-3"></i>
                    <div class="text-sm text-gray-700 flex-1">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">ID Penerima</p>
                                <p class="font-medium">#{{ $beneficiary->id }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Wilayah Saat Ini</p>
                                <p class="font-medium">{{ $beneficiary->region->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Total Distribusi</p>
                                <p class="font-medium">{{ $beneficiary->distributions()->count() }} kali</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Terdaftar Sejak</p>
                                <p class="font-medium">{{ $beneficiary->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warning jika punya riwayat distribusi -->
            @if($beneficiary->distributions()->count() > 0)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-3"></i>
                    <div class="text-sm text-yellow-800">
                        <p class="font-medium mb-1">Perhatian!</p>
                        <p class="text-xs">Penerima ini memiliki {{ $beneficiary->distributions()->count() }} riwayat distribusi. Mengubah NIK atau menghapus data dapat mempengaruhi riwayat distribusi.</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.beneficiaries.index') }}"
                   class="btn btn-secondary w-full sm:w-auto">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto">
                    <i class="fas fa-save mr-2"></i> Update Penerima
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
