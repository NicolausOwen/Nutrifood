<x-guest-layout>
    <!-- Background gradient for the entire page -->
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-10 px-4">
        <div class="max-w-lg mx-auto">
            <!-- Logo HiLo StrongFest -->
            <div class="flex justify-center mb-6">
                <div class="w-40 sm:w-48 md:w-56">
                    <img src="{{ asset('images/LOGO StrongFest 2025-01 (1).png') }}" alt="HiLo StrongFest Logo"
                        class="w-full h-auto logo-strongfest">

                    <!-- FIGHT SARCOPENIA Text -->
                    <h1 class="text-center text-xl sm:text-2xl md:text-3xl font-extrabold mt-2 fight-sarcopenia-text">
                        FIGHT SARCOPENIA
                    </h1>
                </div>
            </div>

            <!-- Main Card with enhanced styling -->
            <div
                class="w-full mx-auto p-5 sm:p-6 md:p-8 rounded-xl shadow-xl border-2 border-blue-900 bg-gradient-to-b from-yellow-100 to-yellow-200">
                <h2 class="text-center text-blue-900 font-bold text-xl sm:text-2xl mb-4 md:mb-6">
                    {{ __('Lupa Password') }}
                </h2>

                <div class="mb-4 text-sm md:text-base text-blue-900 font-medium">
                    {{ __('Lupa password? Tidak masalah. Cukup masukkan alamat email Anda dan kami akan mengirimkan link reset password yang memungkinkan Anda untuk memilih password baru.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-blue-900 text-sm font-bold mb-1">
                            {{ __('Email') }}
                        </label>
                        <input id="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-sm"
                            type="email" name="email" value="{{ old('email') }}" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Buttons with enhanced styling -->
                    <div class="flex flex-col sm:flex-row items-center justify-between mt-6 gap-4">
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-lg text-blue-900 font-bold text-sm transition-all duration-300 btn-back">
                            {{ __('Kembali') }}
                        </a>

                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-lg text-white font-bold text-sm transition-all duration-300 btn-reset">
                            {{ __('Kirim Link Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- HiLo x HIMSI Logo di bagian bawah -->
            <div class="flex justify-center mt-6">
                <div class="w-32 sm:w-40">
                    <img src="{{ asset('images/LOGO.png') }}" alt="HiLo x HIMSI Logo"
                        class="w-full h-auto logo-strongfest">
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
