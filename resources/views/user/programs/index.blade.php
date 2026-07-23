@extends('layouts.user')

@section('page-title', 'Program Tersedia')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Program Aktif</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar program makan bergizi gratis yang sedang berjalan.</p>
        </div>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-xl shadow-sm p-4">
        <form method="GET" action="{{ route('user.programs.index') }}" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama program..." class="form-input flex-1">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search mr-2"></i> Cari</button>
        </form>
    </div>

    <!-- Grid Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($programs as $program)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
            @if($program->image)
                <img src="{{ asset('storage/' . $program->image) }}" class="w-full h-40 object-cover">
            @else
                <div class="w-full h-40 bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center text-white text-4xl">
                    <i class="fas fa-utensils"></i>
                </div>
            @endif
            <div class="p-5">
                <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $program->name }}</h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $program->description }}</p>

                <div class="flex items-center text-xs text-gray-500 mb-4">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    {{ $program->start_date->format('d M Y') }} - {{ $program->end_date->format('d M Y') }}
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                        <i class="fas fa-check-circle mr-1"></i> Aktif
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 bg-white rounded-xl">
            <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Tidak ada program aktif saat ini.</p>
        </div>
        @endforelse
    </div>

    @if($programs->hasPages())
        <div class="bg-white rounded-xl shadow-sm p-4">{{ $programs->links() }}</div>
    @endif
</div>
@endsection
