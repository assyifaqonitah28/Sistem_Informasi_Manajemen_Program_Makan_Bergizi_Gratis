@extends('layouts.admin')

@section('page-title', 'Edit User')

@section('breadcrumb')
    <a href="{{ route('admin.users.index') }}" class="hover:text-blue-600">User</a>
    <span class="mx-2">/</span>
    <span>Edit</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-user-edit mr-2 text-blue-600"></i> Edit Pengguna
        </h2>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="form-input @error('name') border-red-500 @enderror"
                       placeholder="Masukkan nama lengkap">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="form-input @error('email') border-red-500 @enderror"
                       placeholder="contoh@email.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password (Optional) -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Password Baru
                    <span class="text-xs text-gray-500 font-normal">(kosongkan jika tidak ingin mengubah)</span>
                </label>
                <input type="password" name="password"
                       class="form-input @error('password') border-red-500 @enderror"
                       placeholder="•••••••• (kosongkan jika tidak diubah)">
                @error('password')
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
                <p class="text-xs text-gray-500">Kosongkan field ini jika tidak ingin mengubah password.</p>
            </div>

            <!-- Konfirmasi Password -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Konfirmasi Password Baru
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
                        <option value="user" {{ old('role', $userRole) == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $userRole) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Status Akun <span class="text-red-500">*</span>
                    </label>
                    <select name="status" class="form-select @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="suspended" {{ old('status', $user->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                        <option value="banned" {{ old('status', $user->status) == 'banned' ? 'selected' : '' }}>Banned</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- User Info Box -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-user-shield text-gray-600 mt-0.5 mr-3"></i>
                    <div class="text-sm text-gray-700 flex-1">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Terdaftar Sejak</p>
                                <p class="font-medium">{{ $user->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Email Verified</p>
                                <p class="font-medium">
                                    @if($user->email_verified_at)
                                        <span class="text-green-600"><i class="fas fa-check-circle mr-1"></i>Ya</span>
                                    @else
                                        <span class="text-red-600"><i class="fas fa-times-circle mr-1"></i>Belum</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Last Login</p>
                                <p class="font-medium">{{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">ID User</p>
                                <p class="font-medium">#{{ $user->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warning Box untuk Admin -->
            @if($user->id === auth()->id())
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-3"></i>
                    <div class="text-sm text-yellow-800">
                        <p class="font-medium mb-1">Perhatian!</p>
                        <p class="text-xs">Anda sedang mengedit akun Anda sendiri. Perubahan role atau status dapat mempengaruhi akses Anda ke sistem.</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-secondary w-full sm:w-auto">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto">
                    <i class="fas fa-save mr-2"></i> Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
