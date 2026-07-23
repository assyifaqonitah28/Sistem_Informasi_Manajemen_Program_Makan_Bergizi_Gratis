@extends('layouts.admin')

@section('page-title', 'Tambah User')

@section('breadcrumb')
    <a href="{{ route('admin.users.index') }}" class="hover:text-blue-600">User</a>
    <span class="mx-2">/</span>
    <span>Tambah</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-user-plus mr-2 text-blue-600"></i> Tambah Pengguna Baru
        </h2>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-input @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama lengkap">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
                <p class="text-xs text-gray-500">Masukkan nama lengkap pengguna.</p>
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-input @error('email') border-red-500 @enderror"
                       placeholder="contoh@email.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
                <p class="text-xs text-gray-500">Email akan digunakan untuk login dan verifikasi.</p>
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password"
                       class="form-input @error('password') border-red-500 @enderror"
                       placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
                <p class="text-xs text-gray-500">Minimal 8 karakter, kombinasi huruf dan angka.</p>
            </div>

            <!-- Konfirmasi Password -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Konfirmasi Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password_confirmation"
                       class="form-input @error('password_confirmation') border-red-500 @enderror"
                       placeholder="••••••••">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Role & Status (2 kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Role -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Role <span class="text-red-500">*</span>
                    </label>
                    <select name="role" class="form-select @error('role') border-red-500 @enderror">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i> Admin memiliki akses penuh ke sistem.
                    </p>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Status Akun <span class="text-red-500">*</span>
                    </label>
                    <select name="status" class="form-select @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                        <option value="banned" {{ old('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-shield-alt mr-1"></i> Suspended/Banned tidak bisa login.
                    </p>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-medium mb-1">Informasi Penting:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Email verifikasi akan otomatis ditandai sebagai verified.</li>
                            <li>Password default yang disarankan: minimal 8 karakter.</li>
                            <li>User dapat mengubah password mereka setelah login.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-secondary w-full sm:w-auto">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto">
                    <i class="fas fa-save mr-2"></i> Simpan User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
