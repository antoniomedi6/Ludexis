<x-guest-layout>
    <div
        class="min-h-screen bg-[#0f1117] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-20 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-cyan-900/40 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-900/20 blur-[120px] rounded-full">
            </div>
        </div>

        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 relative z-10">
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-[#151821]/80 backdrop-blur-2xl border border-gray-800 rounded-[2.5rem] p-8 md:p-12 shadow-2xl">

                <div class="hidden md:flex flex-col gap-6">
                    <x-miscomponentes.application-logo-name class="w-20 h-20" />
                    <h2 class="text-4xl font-black text-white leading-tight tracking-tighter">
                        Únete a la nueva generación de <span class="text-cyan-500">jugadores.</span>
                    </h2>
                    <p class="text-gray-400 text-lg leading-relaxed">
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
                                class="text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                            <div class="relative">
                                <i
                                    class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                                <x-input id="name"
                                    class="block w-full bg-[#0f1117] border-gray-800 text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600"
                                    type="text" name="name" :value="old('name')" required autofocus
                                    autocomplete="name" placeholder="Tu nombre de usuario" />
                            </div>
                        </div>

                        <div class="relative">
                            <x-label for="email" value="{{ __('Email') }}"
                                class="text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                            <div class="relative">
                                <i
                                    class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                                <x-input id="email"
                                    class="block w-full bg-[#0f1117] border-gray-800 text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600"
                                    type="email" name="email" :value="old('email')" required autocomplete="username"
                                    placeholder="tu@email.com" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="relative">
                                <x-label for="password" value="{{ __('Password') }}"
                                    class="text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                                <div class="relative">
                                    <i
                                        class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                                    <x-input id="password"
                                        class="block w-full bg-[#0f1117] border-gray-800 text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600"
                                        type="password" name="password" required autocomplete="new-password"
                                        placeholder="••••••••" />
                                </div>
                            </div>
                            <div class="relative">
                                <x-label for="password_confirmation" value="{{ __('Confirm') }}"
                                    class="text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                                <div class="relative">
                                    <i
                                        class="fa-solid fa-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                                    <x-input id="password_confirmation"
                                        class="block w-full bg-[#0f1117] border-gray-800 text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600"
                                        type="password" name="password_confirmation" required
                                        autocomplete="new-password" placeholder="••••••••" />
                                </div>
                            </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-2">
                                <x-label for="terms">
                                    <div class="flex items-center">
                                        <x-checkbox name="terms" id="terms" required
                                            class="bg-[#0f1117] border-gray-700 text-cyan-500 focus:ring-cyan-500" />
                                        <div class="ms-2 text-xs text-gray-500">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="text-cyan-500 hover:text-cyan-400 font-bold transition">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="text-cyan-500 hover:text-cyan-400 font-bold transition">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                        @endif

                        <div class="flex flex-col mt-4">
                            <x-button
                                class="w-full justify-center bg-cyan-600 hover:bg-cyan-500 text-white font-black py-4 rounded-xl transition shadow-[0_0_20px_rgba(6,182,212,0.3)] uppercase tracking-widest text-xs mb-3">
                                <i class="fa-solid fa-user-plus mr-2"></i>{{ __('Crear Cuenta') }}
                            </x-button>
                            <a href="{{ route('welcome') }}"
                                class="mb-5 inline-flex items-center justify-center bg-red-600 hover:bg-red-500 text-white font-black px-6 py-3 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(220,38,38,0.3)] hover:shadow-[0_8px_20px_rgba(220,38,38,0.4)] hover:-translate-y-0.5 uppercase tracking-widest text-xs focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-[#0f1117] disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0'">
                                <i class="fas fa-arrow-left-from-bracket mr-2"></i>{{ __('Volver') }}
                            </a>

                            <p class="text-center text-sm text-gray-500">
                                ¿Ya tienes cuenta?
                                <a class="text-cyan-500 font-bold hover:text-cyan-400 transition"
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
