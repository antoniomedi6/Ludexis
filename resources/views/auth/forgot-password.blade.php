<x-guest-layout>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-lightbox-main dark:bg-darkbox-main transition-colors duration-300">
        <div
            class="w-full sm:max-w-md mt-6 px-8 py-10 bg-lightbox-card dark:bg-darkbox-card border border-lightbox-border dark:border-darkbox-border shadow-xl overflow-hidden rounded-[2rem] transition-colors duration-300">

            <div
                class="w-20 h-20 mx-auto bg-cyan-50 dark:bg-cyan-900/30 rounded-full flex items-center justify-center mb-6 border border-cyan-100 dark:border-cyan-800/50">
                <i class="fa-solid fa-key text-3xl text-cyan-600 dark:text-cyan-500"></i>
            </div>

            <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight mb-4 text-center">
                Recuperar contraseña
            </h2>

            <div class="mb-6 text-sm text-gray-600 dark:text-gray-400 font-medium text-center">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @if (session('status'))
                <div
                    class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800/50 text-sm font-bold text-green-600 dark:text-green-400 transition-colors duration-300 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
                @csrf

                <div>
                    <label for="email"
                        class="block text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-2">
                        {{ __('Email') }}
                    </label>
                    <input id="email"
                        class="w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors duration-300 shadow-inner block"
                        type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" />
                    <x-input-error for="email" class="mt-2" />
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-black py-3.5 rounded-xl text-xs uppercase tracking-widest transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.3)] hover:shadow-[0_8px_20px_rgba(6,182,212,0.4)] hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i> {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}"
                        class="text-xs font-bold text-gray-500 hover:text-cyan-600 dark:hover:text-cyan-400 uppercase tracking-wider transition-colors duration-300">
                        Volver al login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
