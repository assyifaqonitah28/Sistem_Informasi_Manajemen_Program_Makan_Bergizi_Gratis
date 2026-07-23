<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem MBG') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 256px;
            height: 100vh;
            overflow-y: auto;
            z-index: 40;
            transition: transform 0.3s ease-in-out;
        }
        .main-content {
            margin-left: 256px;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Overlay - HANYA untuk mobile */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .overlay.active {
                display: block;
            }
        }

        /* Custom Form Styling */
        .form-input,
        .form-select,
        .form-textarea {
            @apply w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition;
            font-size: 0.875rem;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
        }

        .btn {
            @apply px-4 py-2.5 rounded-lg font-medium transition inline-flex items-center justify-center;
            font-size: 0.875rem;
        }

        .btn-primary {
            @apply bg-blue-600 hover:bg-blue-700 text-white shadow-sm;
        }

        .btn-secondary {
            @apply bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300;
        }

        .btn-danger {
            @apply bg-red-600 hover:bg-red-700 text-white shadow-sm;
        }

        .btn-success {
            @apply bg-green-600 hover:bg-green-700 text-white shadow-sm;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Overlay untuk mobile -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar bg-white shadow-lg border-r border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-utensils mr-2 text-blue-600"></i> Sistem MBG
                </h1>
                <p class="text-sm text-gray-500 mt-1">Panel Administrator</p>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
                    <i class="fas fa-chart-line mr-3 w-5 text-center"></i> Dashboard
                </a>

                <a href="{{ route('admin.programs.index') }}"
                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition {{ request()->routeIs('admin.programs.*') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
                    <i class="fas fa-clipboard-list mr-3 w-5 text-center"></i> Program
                </a>

                <a href="{{ route('admin.beneficiaries.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition {{ request()->routeIs('admin.beneficiaries.*') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
                    <i class="fas fa-users mr-3 w-5 text-center"></i> Penerima Manfaat
                </a>

                <a href="{{ route('admin.regions.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition {{ request()->routeIs('admin.regions.*') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
                    <i class="fas fa-map-marked-alt mr-3 w-5 text-center"></i> Wilayah
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 rounded-lg cursor-not-allowed opacity-60">
                    <i class="fas fa-truck mr-3 w-5 text-center"></i> Distribusi
                    <span class="ml-auto text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded">Segera</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
                    <i class="fas fa-user-cog mr-3 w-5 text-center"></i> Pengguna
                </a>
            </nav>

            <!-- User Info di Sidebar Bottom -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 bg-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-1 min-w-0">
                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold mr-3 flex-shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-600 transition ml-2" title="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content flex-1">
            <!-- Top Navbar -->
            <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Mobile Menu Button -->
                        <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-600 hover:text-gray-800 focus:outline-none p-2">
                            <i class="fas fa-bars text-xl"></i>
                        </button>

                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                            <nav class="text-sm text-gray-500 mt-1 hidden sm:block">
                                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Admin</a>
                                @hasSection('breadcrumb')
                                    <span class="mx-2">/</span>
                                    @yield('breadcrumb')
                                @endif
                            </nav>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600 hidden md:block">
                            {{ auth()->user()->name }}
                        </span>
                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-4 md:p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-start">
                        <i class="fas fa-check-circle mr-2 mt-0.5 text-green-600"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg flex items-start">
                        <i class="fas fa-exclamation-circle mr-2 mt-0.5 text-red-600"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Close sidebar when clicking on a link (mobile only)
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });
        });

        // Close sidebar when resizing to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                const sidebar = document.querySelector('.sidebar');
                const overlay = document.getElementById('overlay');
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>
