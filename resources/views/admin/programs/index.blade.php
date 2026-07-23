@extends('layouts.admin')

@section('page-title', 'Manajemen Program')

@section('breadcrumb')
    <span>Program</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Program</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola program makan bergizi gratis</p>
        </div>
        <a href="{{ route('admin.programs.create') }}"
           class="btn btn-primary flex items-center justify-center">
            <i class="fas fa-plus mr-2"></i> Tambah Program
        </a>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <form method="GET" action="{{ route('admin.programs.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama program..."
                       class="form-input">
            </div>

            <div class="sm:w-48">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>

                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-2"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Program</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($programs as $program)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($program->image)
                                        <img src="{{ asset('storage/' . $program->image) }}"
                                             class="w-12 h-12 rounded-lg object-cover mr-4 flex-shrink-0">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-200 mr-4 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-clipboard-list text-gray-400 text-xl"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-medium text-gray-800 truncate">{{ $program->name }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ Str::limit($program->description, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-400 text-xs"></i>
                                        {{ $program->start_date->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-400 mt-1 ml-5">
                                        s/d {{ $program->end_date->format('d M Y') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusConfig = [
                                        'draft' => ['color' => 'bg-gray-100 text-gray-700', 'label' => 'Draft', 'icon' => 'fa-file'],
                                        'active' => ['color' => 'bg-green-100 text-green-700', 'label' => 'Aktif', 'icon' => 'fa-check-circle'],
                                        'completed' => ['color' => 'bg-blue-100 text-blue-700', 'label' => 'Selesai', 'icon' => 'fa-check-double'],
                                        'cancelled' => ['color' => 'bg-red-100 text-red-700', 'label' => 'Dibatalkan', 'icon' => 'fa-times-circle'],
                                    ];
                                    $config = $statusConfig[$program->status] ?? $statusConfig['draft'];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full {{ $config['color'] }}">
                                    <i class="fas {{ $config['icon'] }} mr-1.5"></i>
                                    {{ $config['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.programs.edit', $program) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium transition"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.programs.destroy', $program) }}"
                                          class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus program ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="text-gray-400 mb-3">
                                    <i class="fas fa-inbox text-5xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada data program.</p>
                                <p class="text-sm text-gray-400 mt-1">Mulai dengan menambahkan program pertama Anda.</p>
                                <a href="{{ route('admin.programs.create') }}" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    <i class="fas fa-plus mr-2"></i> Tambah program pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($programs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $programs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
