@extends('layouts.admin')

@section('page-title', 'Dashboard User')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-xl p-6 text-white shadow-sm">
        <h2 class="text-2xl font-bold">Halo, {{ auth()->user()->name }} 👋</h2>
        <p class="mt-2 text-green-100">Selamat datang di Sistem MBG. Berikut informasi terbaru untuk Anda.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Program Aktif</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['active_programs'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xl">
                    <i class="fas fa-clipboard-list"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Distribusi</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_distributions'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Laporan Saya</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['my_reports'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xl">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Laporan Pending</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['pending_reports'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-xl">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Akun -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-user-circle mr-2 text-green-600"></i> Informasi Akun
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-medium text-gray-800">{{ auth()->user()->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium text-gray-800">{{ auth()->user()->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Role</p>
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700">
                    {{ auth()->user()->getRoleNames()->first() ?? '-' }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status Akun</p>
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                    {{ ucfirst(auth()->user()->status) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Program Aktif -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-clipboard-list mr-2 text-green-600"></i> Program Aktif
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($activePrograms as $program)
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                <h4 class="font-medium text-gray-800 mb-2">{{ $program->name }}</h4>
                <p class="text-sm text-gray-500 mb-3">{{ Str::limit($program->description, 80) }}</p>
                <div class="text-xs text-gray-400">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    {{ $program->start_date->format('d M Y') }} - {{ $program->end_date->format('d M Y') }}
                </div>
            </div>
            @empty
            <p class="text-gray-500 col-span-3">Tidak ada program aktif saat ini.</p>
            @endforelse
        </div>
    </div>

    <!-- Distribusi Terbaru -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-truck mr-2 text-blue-600"></i> Distribusi Terbaru
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Penerima</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($recentDistributions as $dist)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $dist->program->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $dist->beneficiary->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $dist->distribution_date->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = ['scheduled' => 'bg-blue-100 text-blue-700', 'distributed' => 'bg-green-100 text-green-700', 'failed' => 'bg-red-100 text-red-700', 'cancelled' => 'bg-gray-100 text-gray-700'];
                                $statusLabels = ['scheduled' => 'Terjadwal', 'distributed' => 'Terdistribusi', 'failed' => 'Gagal', 'cancelled' => 'Dibatalkan'];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$dist->status] }}">
                                {{ $statusLabels[$dist->status] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data distribusi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
