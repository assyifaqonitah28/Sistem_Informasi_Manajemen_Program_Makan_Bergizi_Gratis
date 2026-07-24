@extends('layouts.user') {{-- Gunakan 'layouts.admin' jika ingin tampilan khusus admin --}}

@section('page-title', 'Pengaturan Profil')

@section('breadcrumb')
    <span>Profil</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- 1. Card Informasi Akun (Read Only) -->
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8 border-l-4 border-blue-500">
        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-user-circle mr-2 text-blue-600"></i> Informasi Akun
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</p>
                <p class="font-medium text-gray-800 mt-1 text-lg">{{ auth()->user()->name }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat Email</p>
                <p class="font-medium text-gray-800 mt-1 text-lg">{{ auth()->user()->email }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Peran (Role)</p>
                <span class="inline-flex items-center px-3 py-1.5 mt-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-700">
                    <i class="fas fa-shield-alt mr-1.5"></i> {{ auth()->user()->getRoleNames()->first() ?? '-' }}
                </span>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akun</p>
                @php
                    $statusColors = [
                        'active' => 'bg-green-100 text-green-700',
                        'suspended' => 'bg-yellow-100 text-yellow-700',
                        'banned' => 'bg-red-100 text-red-700',
                        'pending' => 'bg-gray-100 text-gray-700'
                    ];
                    $statusIcons = [
                        'active' => 'fa-check-circle',
                        'suspended' => 'fa-pause-circle',
                        'banned' => 'fa-ban',
                        'pending' => 'fa-clock'
                    ];
                    $currentStatus = auth()->user()->status;
                @endphp
                <span class="inline-flex items-center px-3 py-1.5 mt-1 text-xs font-semibold rounded-full {{ $statusColors[$currentStatus] ?? 'bg-gray-100' }}">
                    <i class="fas {{ $statusIcons[$currentStatus] ?? 'fa-question-circle' }} mr-1.5"></i> {{ ucfirst($currentStatus) }}
                </span>
            </div>
        </div>
    </div>

    <!-- 2. Form Update Informasi Profil (Breeze Partial) -->
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center border-b border-gray-100 pb-3">
            <i class="fas fa-user-edit mr-2 text-blue-600"></i> Perbarui Informasi Profil
        </h3>
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- 3. Form Update Password (Breeze Partial) -->
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center border-b border-gray-100 pb-3">
            <i class="fas fa-lock mr-2 text-blue-600"></i> Perbarui Password
        </h3>
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- 4. Form Hapus Akun (Breeze Partial - Opsional) -->
    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8 border-l-4 border-red-500">
        <h3 class="text-lg font-bold text-red-600 mb-6 flex items-center border-b border-red-100 pb-3">
            <i class="fas fa-exclamation-triangle mr-2"></i> Hapus Akun
        </h3>
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection
