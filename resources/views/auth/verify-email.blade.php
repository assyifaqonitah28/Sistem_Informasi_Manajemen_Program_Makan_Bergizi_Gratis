<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- Left Side: Animated Background -->
        <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden items-center justify-center p-12">
            <!-- Animated Circles -->
            <div class="absolute top-20 left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>

            <div class="relative text-white max-w-md" data-aos="fade-right">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-8 animate-float">
                    <i class="fas fa-envelope-open-text text-white text-4xl"></i>
                </div>

                <h2 class="text-5xl font-bold mb-6 animate-fade-in-up">
                    Verifikasi Email Anda
                </h2>

                <p class="text-xl text-white/90 mb-8 animate-fade-in-up" style="animation-delay: 0.2s;">
                    Langkah terakhir untuk mengamankan akun Anda dan mulai berkontribusi dalam program makan bergizi gratis.
                </p>

                <div class="space-y-4 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <span class="text-white/90">Keamanan akun terjamin</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                        <span class="text-white/90">Akses penuh ke sistem</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bell text-white"></i>
                        </div>
                        <span class="text-white/90">Notifikasi real-time</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md space-y-8" data-aos="fade-left">
                <div class="text-center">
                    <div class="lg:hidden flex justify-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-envelope-open-text text-white text-2xl"></i>
                        </div>
                    </div>

                    <h2 class="text-4xl font-bold text-gray-900 mb-2">Verifikasi Email</h2>
                    <p class="text-gray-600">
                        Kami telah mengirimkan tautan verifikasi ke email Anda
                    </p>
                </div>

                <!-- Info Card -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-600 text-xl mt-0.5"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-blue-900 mb-2">
                                Langkah Selanjutnya
                            </h3>
                            <p class="text-sm text-blue-800 leading-relaxed">
                                Terima kasih telah mendaftar! Sebelum mulai menggunakan sistem, mohon verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan.
                            </p>
                            <p class="text-sm text-blue-800 mt-3 leading-relaxed">
                                Jika Anda tidak menerima email, silakan periksa folder spam atau klik tombol di bawah untuk mengirim ulang.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-start animate-fade-in-up">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-600 text-xl mt-0.5"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                Berhasil! Tautan verifikasi baru telah dikirim ke email Anda.
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <!-- Resend Email Button -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 flex items-center justify-center group">
                            <i class="fas fa-paper-plane mr-2 group-hover:animate-bounce"></i>
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-gray-50 text-gray-500">atau</span>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-white border-2 border-gray-200 text-gray-700 py-3.5 rounded-xl font-bold text-base shadow-sm hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 flex items-center justify-center group">
                            <i class="fas fa-sign-out-alt mr-2 text-red-500 group-hover:text-red-600"></i>
                            Keluar dari Akun
                        </button>
                    </form>
                </div>

                <!-- Help Text -->
                <div class="text-center">
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-question-circle mr-1"></i>
                        Butuh bantuan? Hubungi administrator sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
