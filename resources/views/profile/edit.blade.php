<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Informasi Akun (Read Only) -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4"><i class="fas fa-user-circle mr-2 text-blue-600"></i> Informasi Akun</h3>
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

            <!-- Breeze Default Forms (Update Profile & Password) -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- ... delete user form ... -->
        </div>
    </div>
</x-app-layout>
