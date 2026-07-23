<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem MBG') }} - User</title>

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
            .overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 30;
            }
            .overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar bg-white shadow-lg border-r border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-utensils mr-2 text-green-600"></i> Sistem MBG
                </h1>
                <p class="text-sm text-gray-500 mt-1">Panel Pengguna</p>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('user.dashboard') }}"
                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition {{ request()->routeIs('user.dashboard') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                    <i class="fas fa-chart-line mr-3 w-5"></i> Dashboard
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 rounded-lg cursor-not-allowed opacity-60">
                    <i class="fas fa-clipboard-list mr-3 w-5"></i> Program Tersedia
                    <span class="ml-auto text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded">Segera</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 rounded-lg cursor-not-allowed opacity-60">
                    <i class="fas fa-history mr-3 w-5"></i> Riwayat Penerimaan
                    <span class="ml-auto text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded">Segera</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-400 rounded-lg cursor-not-allowed opacity-60">
                    <i class="fas fa-file-alt mr-3 w-5"></i> Laporan Saya
                    <span class="ml-auto text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded">Segera</span>
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 bg-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center font-semibold mr-3">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-medium ml-2">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content flex-1">
            <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-600 hover:text-gray-800 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600 hidden md:block">{{ auth()->user()->name }}</span>
                        <div class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center font-semibold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </nav>

            <main class="p-4 md:p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-start">
                        <i class="fas fa-check-circle mr-2 mt-0.5"></i>
                        <span>{{ session('success') }}</span>
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

        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });
        });
    </script>
</body>
</html>
