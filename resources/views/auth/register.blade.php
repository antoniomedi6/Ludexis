<x-guest-layout>
    <div
        class="min-h-screen bg-lightbox-main dark:bg-darkbox-main flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden transition-colors duration-300">

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-30 dark:opacity-20 pointer-events-none">
            <div
                class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-cyan-300/50 dark:bg-cyan-900/40 blur-[120px] rounded-full">
            </div>
            <div
                class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-300/40 dark:bg-indigo-900/20 blur-[120px] rounded-full">
            </div>
        </div>

        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 relative z-10">
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-lightbox-card/95 dark:bg-darkbox-card/90 backdrop-blur-2xl border border-lightbox-border dark:border-darkbox-border rounded-3xl p-8 md:p-12 shadow-2xl transition-colors duration-300">

                <div class="hidden md:flex flex-col gap-6">
                    <x-miscomponentes.application-logo-name />
                    <h2
                        class="text-4xl font-black text-lightbox-text dark:text-white leading-tight tracking-tighter">
                        Únete a la nueva generación de <span class="text-cyan-600 dark:text-cyan-500">jugadores.</span>
                    </h2>
                    <p class="text-lightbox-muted dark:text-gray-400 text-lg leading-relaxed">
                        Crea tu perfil para llevar un seguimiento de tus juegos, escribir reseñas y descubrir tu próxima
                        aventura.
                    </p>
                </div>

                <div>
                    <div class="md:hidden mb-8 text-center">
                        <x-miscomponentes.application-logo-name />
                    </div>

                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
                        @csrf

                        <div class="relative">
                            <x-label for="name" value="{{ __('Username') }}"
                                class="text-lightbox-muted dark:text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                            <div class="relative">
                                <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-500 text-sm"
                                    aria-hidden="true"></i>
                                <x-input id="name"
                                    class="block w-full bg-lightbox-main dark:bg-darkbox-main border-lightbox-border dark:border-darkbox-border text-lightbox-text dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                                    type="text" name="name" :value="old('name')" required autofocus
                                    autocomplete="name" placeholder="Tu nombre de usuario" />
                            </div>
                        </div>

                        <div class="relative">
                            <x-label for="email" value="{{ __('Email') }}"
                                class="text-lightbox-muted dark:text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                            <div class="relative">
                                <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-500 text-sm"
                                    aria-hidden="true"></i>
                                <x-input id="email"
                                    class="block w-full bg-lightbox-main dark:bg-darkbox-main border-lightbox-border dark:border-darkbox-border text-lightbox-text dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                                    type="email" name="email" :value="old('email')" required autocomplete="username"
                                    placeholder="tu@email.com" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="relative">
                                <x-label for="password" value="{{ __('Password') }}"
                                    class="text-lightbox-muted dark:text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                                <div class="relative">
                                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-500 text-sm"
                                        aria-hidden="true"></i>
                                    <x-input id="password"
                                        class="block w-full bg-lightbox-main dark:bg-darkbox-main border-lightbox-border dark:border-darkbox-border text-lightbox-text dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                                        type="password" name="password" required autocomplete="new-password"
                                        placeholder="••••••••" />
                                </div>
                            </div>
                            <div class="relative">
                                <x-label for="password_confirmation" value="{{ __('Confirm') }}"
                                    class="text-lightbox-muted dark:text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                                <div class="relative">
                                    <i class="fa-solid fa-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-500 text-sm"
                                        aria-hidden="true"></i>
                                    <x-input id="password_confirmation"
                                        class="block w-full bg-lightbox-main dark:bg-darkbox-main border-lightbox-border dark:border-darkbox-border text-lightbox-text dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                                        type="password" name="password_confirmation" required
                                        autocomplete="new-password" placeholder="••••••••" />
                                </div>
                            </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-2 px-1">
                                <x-label for="terms">
                                    <div class="flex items-center group cursor-pointer">
                                        <x-checkbox name="terms" id="terms" required
                                            class="bg-lightbox-main dark:bg-darkbox-main border-lightbox-border dark:border-darkbox-border text-cyan-500 focus:ring-cyan-500 rounded" />
                                        <div
                                            class="ms-2 text-[10px] text-gray-600 dark:text-gray-500 uppercase tracking-widest group-hover:text-gray-800 dark:group-hover:text-gray-400 transition-colors">
                                            {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="text-cyan-600 dark:text-cyan-500 hover:text-cyan-500 dark:hover:text-cyan-400 font-black transition">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="text-cyan-600 dark:text-cyan-500 hover:text-cyan-500 dark:hover:text-cyan-400 font-black transition">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                        @endif

                        <div class="flex flex-col mt-4 gap-4">
                            <x-button
                                class="w-full justify-center bg-cyan-600 hover:bg-cyan-500 text-white font-black py-3.5 rounded-xl transition-all duration-300 shadow-[0_0_15px_rgba(6,182,212,0.2)] hover:shadow-[0_0_25px_rgba(6,182,212,0.4)] uppercase tracking-widest text-xs focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-lightbox-card dark:focus:ring-offset-darkbox-main">
                                <i class="fa-solid fa-user-plus mr-2" aria-hidden="true"></i>{{ __('Crear Cuenta') }}
                            </x-button>

                            <div class="flex items-center gap-3 opacity-60">
                                <hr class="flex-1 border-lightbox-border dark:border-darkbox-border">
                                <span
                                    class="text-[10px] font-black text-gray-500 dark:text-gray-500 uppercase tracking-widest">O</span>
                                <hr class="flex-1 border-lightbox-border dark:border-darkbox-border">
                            </div>

                            {{-- Social Register --}}
                            <a href="{{ route('auth.steam.redirect') }}"
                                class="flex items-center justify-center gap-3 w-full px-4 py-3 bg-white dark:bg-gray-900 border border-lightbox-border dark:border-gray-700 text-lightbox-text dark:text-white hover:border-cyan-500 dark:hover:border-cyan-800 hover:bg-lightbox-soft dark:hover:bg-cyan-900/30 rounded-xl font-bold uppercase tracking-widest transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-xs group shadow-sm dark:shadow-none"
                                aria-label="Registrarse con Steam">
                                <i class="fa-brands fa-steam text-lg group-hover:scale-110 group-hover:text-cyan-400 transition-all duration-300"
                                    aria-hidden="true"></i>
                                <span>Crear con Steam</span>
                            </a>
                            <a href="{{ route('auth.discord.redirect') }}"
                                class="flex items-center justify-center gap-3 w-full px-4 py-3 bg-white dark:bg-gray-900 border border-lightbox-border dark:border-gray-700 text-lightbox-text dark:text-white hover:border-cyan-500 dark:hover:border-cyan-800 hover:bg-lightbox-soft dark:hover:bg-cyan-900/30 rounded-xl font-bold uppercase tracking-widest transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-xs group shadow-sm dark:shadow-none"
                                aria-label="Registrarse con Discord">
                                <i class="fa-brands fa-discord text-lg group-hover:scale-110 group-hover:text-cyan-400 transition-all duration-300"
                                    aria-hidden="true"></i>
                                <span>Crear con Discord</span>
                            </a>
                            <a href="{{ route('auth.google.redirect') }}"
                                class="flex items-center justify-center gap-3 w-full px-4 py-3 bg-white dark:bg-gray-900 border border-lightbox-border dark:border-gray-700 text-lightbox-text dark:text-white hover:border-cyan-500 dark:hover:border-cyan-800 hover:bg-lightbox-soft dark:hover:bg-cyan-900/30 rounded-xl font-bold uppercase tracking-widest transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 text-xs group shadow-sm dark:shadow-none"
                                aria-label="Registrarse con Google">
                                <i class="fa-brands fa-google text-lg group-hover:scale-110 group-hover:text-cyan-400 transition-all duration-300"
                                    aria-hidden="true"></i>
                                <span>Crear con Google</span>
                            </a>
                        </div>

                        <div
                            class="flex items-center justify-between mt-4 pt-4 border-t border-lightbox-border dark:border-darkbox-border">
                            <a href="{{ route('welcome') }}" wire:navigate
                                class="bg-red-600 p-2 rounded-lg text-[10px] text-white font-black uppercase tracking-widest hover:bg-red-400 hover:text-white transition-colors flex items-center gap-1.5 group">
                                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"
                                    aria-hidden="true"></i> {{ __('Volver') }}
                            </a>

                            <p
                                class="text-[10px] text-lightbox-muted dark:text-gray-500 font-bold uppercase tracking-widest">
                                ¿Ya tienes cuenta?
                                <a class="text-cyan-600 dark:text-cyan-500 font-black hover:text-cyan-500 dark:hover:text-cyan-400 ml-1 transition-colors"
                                    href="{{ route('login') }}">
                                    {{ __('Inicia sesión') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
