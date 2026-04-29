<x-guest-layout>
    <div
        class="min-h-screen bg-darkbox-main flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-20 pointer-events-none">
            <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-cyan-900/40 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-900/20 blur-[120px] rounded-full">
            </div>
        </div>

        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 relative z-10">
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-darkbox-card/90 backdrop-blur-2xl border border-darkbox-border rounded-3xl p-8 md:p-12 shadow-2xl">

                <div class="hidden md:flex flex-col gap-6">
                    <x-miscomponentes.application-logo-name />
                    <h2 class="text-4xl font-black text-white leading-tight tracking-tighter">
                        Bienvenido de <span class="text-cyan-500">nuevo.</span>
                    </h2>
                    <p class="text-gray-400 text-lg leading-relaxed">
                        Inicia sesión para acceder a tu biblioteca personal, revisar tus estadísticas y continuar donde
                        lo dejaste.
                    </p>
                    <div class="space-y-3 mt-4">
                        <div class="flex items-center gap-3 text-gray-500 font-bold text-xs uppercase tracking-widest">
                            <div
                                class="size-8 rounded-full bg-cyan-900/30 flex items-center justify-center border border-cyan-800/30">
                                <i class="fa-solid fa-gamepad text-cyan-500" aria-hidden="true"></i>
                            </div>
                            Tus juegos favoritos
                        </div>
                        <div class="flex items-center gap-3 text-gray-500 font-bold text-xs uppercase tracking-widest">
                            <div
                                class="size-8 rounded-full bg-cyan-900/30 flex items-center justify-center border border-cyan-800/30">
                                <i class="fa-solid fa-star text-cyan-500" aria-hidden="true"></i>
                            </div>
                            Reseñas de la comunidad
                        </div>
                    </div>
                </div>

                <div>
                    <div class="md:hidden mb-8 text-center">
                        <x-miscomponentes.application-logo-name />
                    </div>

                    <x-validation-errors class="mb-4" />

                    @session('status')
                        <div class="mb-6 font-bold text-sm text-green-400 bg-green-900/20 border border-green-800/30 p-4 rounded-xl"
                            role="alert">
                            {{ $value }}
                        </div>
                    @endsession

                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                        @csrf

                        <div class="relative">
                            <x-label for="email" value="Email o Usuario"
                                class="text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                            <div class="relative">
                                <i class="fa-solid fa-circle-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                                    aria-hidden="true"></i>
                                <x-input id="email"
                                    class="block w-full bg-darkbox-main border-darkbox-border text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600"
                                    type="text" name="email" :value="old('email')" required autofocus
                                    autocomplete="username" placeholder="Nombre de usuario o email" />
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1 ml-1">
                                <x-label for="password" value="{{ __('Password') }}"
                                    class="text-gray-400 text-[10px] font-black uppercase tracking-widest" />
                            </div>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                                    aria-hidden="true"></i>
                                <x-input id="password"
                                    class="block w-full bg-darkbox-main border-darkbox-border text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="••••••••" />
                            </div>

                            <div class="flex items-center justify-between mt-3 px-1">
                                <label for="remember_me" class="flex items-center cursor-pointer group">
                                    <x-checkbox id="remember_me" name="remember"
                                        class="bg-darkbox-main border-darkbox-border text-cyan-500 focus:ring-cyan-500 rounded" />
                                    <span
                                        class="ms-2 text-[10px] text-gray-500 font-bold uppercase tracking-widest group-hover:text-gray-400 transition-colors select-none">
                                        {{ __('Recuérdame') }}
                                    </span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-[10px] text-cyan-500 font-black uppercase tracking-widest hover:text-cyan-400 transition-colors"
                                        href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste la contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col mt-4 gap-4">
                            <x-button
                                class="w-full justify-center bg-cyan-600 hover:bg-cyan-500 text-white font-black py-3.5 rounded-xl transition-all duration-300 shadow-[0_0_15px_rgba(6,182,212,0.2)] hover:shadow-[0_0_25px_rgba(6,182,212,0.4)] uppercase tracking-widest text-xs focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-darkbox-main">
                                <i class="fa-solid fa-right-to-bracket mr-2" aria-hidden="true"></i>
                                {{ __('Iniciar Sesión') }}
                            </x-button>

                            <div class="flex items-center gap-3 opacity-60">
                                <hr class="flex-1 border-darkbox-border">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">O</span>
                                <hr class="flex-1 border-darkbox-border">
                            </div>
                            {{-- Social Login --}}
                            <a href="{{ route('auth.steam.redirect') }}"
                                class="flex items-center justify-center gap-3 w-full px-4 py-3 bg-gray-900 border border-gray-700 hover:border-cyan-800 hover:bg-cyan-900/30 text-white rounded-xl font-bold uppercase tracking-widest transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-xs group"
                                aria-label="Iniciar sesión con Steam">
                                <i class="fa-brands fa-steam text-lg group-hover:scale-110 group-hover:text-cyan-400 transition-all duration-300"
                                    aria-hidden="true"></i>
                                <span>Entrar con Steam</span>
                            </a>
                            <a href="{{ route('auth.discord.redirect') }}"
                                class="flex items-center justify-center gap-3 w-full px-4 py-3 bg-gray-900 border border-gray-700 hover:border-cyan-800 hover:bg-cyan-900/30 text-white rounded-xl font-bold uppercase tracking-widest transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-xs group"
                                aria-label="Iniciar sesión con Discord">
                                <i class="fa-brands fa-discord text-lg group-hover:scale-110 group-hover:text-cyan-400 transition-all duration-300"
                                    aria-hidden="true"></i>
                                <span>Entrar con Discord</span>
                            </a>
                            <a href="{{ route('auth.google.redirect') }}"
                                class="flex items-center justify-center gap-3 w-full px-4 py-3 bg-gray-900 border border-gray-700 hover:border-cyan-800 hover:bg-cyan-900/30 text-white rounded-xl font-bold uppercase tracking-widest transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-xs group"
                                aria-label="Iniciar sesión con Google">
                                <i class="fa-brands fa-google text-lg group-hover:scale-110 group-hover:text-cyan-400 transition-all duration-300"
                                    aria-hidden="true"></i>
                                <span>Entrar con Google</span>
                            </a>
                        </div>

                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-darkbox-border">
                            <a href="{{ route('welcome') }}" wire:navigate
                                class="bg-red-600 p-2 rounded-lg text-[10px] text-white font-black uppercase tracking-widest hover:bg-red-400 hover:text-white transition-colors flex items-center gap-1.5 group">
                                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"
                                    aria-hidden="true"></i> {{ __('Volver') }}
                            </a>

                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">
                                ¿Nuevo aquí?
                                <a class="text-cyan-500 font-black hover:text-cyan-400 ml-1 transition-colors"
                                    href="{{ route('register') }}">
                                    {{ __('Regístrate') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
