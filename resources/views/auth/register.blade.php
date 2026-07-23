<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- Left Side: Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md space-y-8" data-aos="fade-right">
                <div class="text-center lg:text-left">
                    <div class="lg:hidden flex justify-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-600 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-user-plus text-white text-2xl"></i>
                        </div>
                    </div>

                    <h2 class="text-4xl font-bold text-gray-900 mb-2">Buat Akun Baru</h2>
                    <p class="text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6 bg-white p-8 rounded-2xl shadow-xl">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-user mr-2 text-green-600"></i>Nama Lengkap
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               class="form-input block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                               placeholder="Masukkan nama lengkap" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-envelope mr-2 text-green-600"></i>Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                               class="form-input block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                               placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-green-600"></i>Password
                        </label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="form-input block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                               placeholder="Minimal 8 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-green-600"></i>Konfirmasi Password
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="form-input block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                               placeholder="Ulangi password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-blue-600 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                    </button>
                </form>

                <!-- Info Box -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                    <p class="text-xs text-green-800 font-semibold mb-2">
                        <i class="fas fa-shield-alt mr-1"></i> Keamanan Terjamin:
                    </p>
                    <ul class="text-xs text-green-700 space-y-1 list-disc list-inside">
                        <li>Password terenkripsi dengan aman</li>
                        <li>Verifikasi email wajib dilakukan</li>
                        <li>Data pribadi dilindungi</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Side: Animated Background -->
        <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden items-center justify-center p-12">
            <!-- Animated Circles -->
            <div class="absolute top-20 right-20 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 left-20 w-96 h-96 bg-green-500/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>

            <div class="relative text-white max-w-md" data-aos="fade-left">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-8 animate-float">
                    <i class="fas fa-heart text-white text-4xl"></i>
                </div>

                <h2 class="text-5xl font-bold mb-6 animate-fade-in-up">
                    Bergabunglah dengan Kami!
                </h2>

                <p class="text-xl text-white/90 mb-8 animate-fade-in-up" style="animation-delay: 0.2s;">
                    Jadilah bagian dari gerakan untuk mewujudkan Indonesia sehat melalui program makan bergizi gratis.
                </p>

                <div class="space-y-4 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <span class="text-white/90">Akses sistem manajemen lengkap</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <span class="text-white/90">Kontribusi untuk masyarakat</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <span class="text-white/90">Laporan real-time & transparan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
