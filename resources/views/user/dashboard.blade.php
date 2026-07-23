@extends('layouts.user')

@section('page-title', 'Dashboard User')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-xl p-6 text-white">
        <h2 class="text-2xl font-bold">Halo, {{ auth()->user()->name }} 👋</h2>
        <p class="mt-2 text-green-100">Selamat datang di Sistem MBG. Lihat informasi program terbaru di bawah.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Program Aktif</h3>
            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Program::where('status', 'active')->count() }}</p>
            <p class="text-sm text-gray-500 mt-2">Program sedang berjalan</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">📊 Informasi Akun</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama:</span>
                    <span class="font-medium">{{ auth()->user()->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Email:</span>
                    <span class="font-medium">{{ auth()->user()->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Role:</span>
                    <span class="font-medium capitalize">{{ auth()->user()->getRoleNames()->first() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status:</span>
                    <span class="font-medium capitalize text-green-600">{{ auth()->user()->status }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
