<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem MBG - Makan Bergizi Gratis</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        @keyframes slide-in-left {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 2s ease-in-out infinite;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-out;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.8s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out;
        }

        /* Gradient Background */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Hover Effects */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Glass Morphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 overflow-x-hidden">
    <!-- Navbar -->
    <nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md shadow-sm z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3" data-aos="fade-right">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-utensils text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="font-bold text-2xl gradient-text">Sistem MBG</span>
                        <p class="text-xs text-gray-500">Makan Bergizi Gratis</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4" data-aos="fade-left">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary px-6 py-2.5 rounded-lg shadow-lg hover:shadow-xl transition-all">
                                <i class="fas fa-chart-line mr-2"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors px-4 py-2">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary px-6 py-2.5 rounded-lg shadow-lg hover:shadow-xl transition-all">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center gradient-bg overflow-hidden pt-20">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <!-- Left Content -->
                <div class="lg:w-1/2 text-white" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6 animate-fade-in-up">
                        <span class="text-sm font-medium">🎯 Program Nasional 2026</span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight mb-6 animate-fade-in-up" style="animation-delay: 0.2s;">
                        Wujudkan Indonesia Sehat dengan
                        <span class="text-yellow-300">Makan Bergizi Gratis</span>
                    </h1>

                    <p class="text-xl text-white/90 mb-8 animate-fade-in-up" style="animation-delay: 0.4s;">
                        Sistem informasi terpadu untuk memantau distribusi, mengelola penerima manfaat, dan memastikan setiap porsi makanan tepat sasaran dengan transparansi penuh.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up" style="animation-delay: 0.6s;">
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-rocket mr-2"></i> Mulai Sekarang
                        </a>
                        <a href="#features" class="glass text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/20 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-info-circle mr-2"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12 animate-fade-in-up" style="animation-delay: 0.8s;">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">10K+</div>
                            <div class="text-sm text-white/80">Penerima Manfaat</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">50+</div>
                            <div class="text-sm text-white/80">Wilayah</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">99%</div>
                            <div class="text-sm text-white/80">Tepat Sasaran</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Animated Card -->
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white/20 rounded-3xl blur-3xl"></div>
                        <div class="relative bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 shadow-2xl animate-float">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-white text-lg">Distribusi Hari Ini</p>
                                        <p class="text-white/70 text-sm">Real-time tracking</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-bold text-white">1,250</p>
                                    <p class="text-white/70 text-sm">Porsi</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="bg-white/10 rounded-xl p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-white/90 text-sm">Program Gizi Anak</span>
                                        <span class="text-green-400 text-xs font-bold">85%</span>
                                    </div>
                                    <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-green-400 to-green-600 rounded-full" style="width: 85%"></div>
                                    </div>
                                </div>

                                <div class="bg-white/10 rounded-xl p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-white/90 text-sm">Program Lansia</span>
                                        <span class="text-blue-400 text-xs font-bold">72%</span>
                                    </div>
                                    <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-full" style="width: 72%"></div>
                                    </div>
                                </div>

                                <div class="bg-white/10 rounded-xl p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-white/90 text-sm">Program Ibu Hamil</span>
                                        <span class="text-purple-400 text-xs font-bold">91%</span>
                                    </div>
                                    <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-purple-400 to-purple-600 rounded-full" style="width: 91%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-white/20">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                        <span class="text-white/90 text-sm">Live Update</span>
                                    </div>
                                    <span class="text-white/70 text-xs">Baru saja</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#features" class="text-white/70 hover:text-white transition-colors">
                <i class="fas fa-chevron-down text-3xl"></i>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                    ✨ Fitur Unggulan
                </span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Dibangun untuk <span class="gradient-text">Transparansi</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Sistem yang komprehensif untuk mengelola program makan bergizi gratis dari hulu ke hilir
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Manajemen Penerima</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Data penerima manfaat terverifikasi berdasarkan wilayah dan NIK dengan sistem validasi otomatis.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-truck text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Tracking Distribusi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau jadwal dan status penyaluran makanan secara real-time dengan notifikasi otomatis.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-chart-pie text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Laporan Transparan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dokumentasi foto dan laporan pertanggungjawaban yang jelas dengan sistem verifikasi berlapis.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Cakupan Wilayah</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Manajemen hierarki wilayah dari provinsi hingga desa untuk distribusi yang terorganisir.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Keamanan Data</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem autentikasi berlapis dengan role-based access control untuk melindungi data sensitif.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Responsif & Mobile</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Akses sistem dari perangkat apapun dengan tampilan yang optimal dan user-friendly.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                Siap Bergabung dalam Program Ini?
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Daftarkan diri Anda sekarang dan jadilah bagian dari perubahan untuk Indonesia yang lebih sehat
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg shadow-2xl hover:scale-105 transition-all duration-300">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="glass text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/20 transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Akun
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-utensils text-white"></i>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Sistem Informasi MBG</p>
                        <p class="text-gray-400 text-sm">Makan Bergizi Gratis</p>
                    </div>
                </div>

                <div class="flex space-x-6 mb-4 md:mb-0">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>

                <p class="text-gray-400 text-sm">
                    © 2026 Dibuat dengan <i class="fas fa-heart text-red-500"></i> untuk Indonesia Sehat
                </p>
            </div>
        </div>
    </footer>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });
    </script>
</body>
</html>
