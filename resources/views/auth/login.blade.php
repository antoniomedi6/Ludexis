<x-guest-layout>
    <div
        class="min-h-screen bg-[#0f1117] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-20 pointer-events-none">
            <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-cyan-900/40 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-900/20 blur-[120px] rounded-full">
            </div>
        </div>

        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 relative z-10">
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-[#151821]/80 backdrop-blur-2xl border border-gray-800 rounded-[2.5rem] p-8 md:p-12 shadow-2xl">

                <div class="hidden md:flex flex-col gap-6">
                    <x-miscomponentes.application-logo-name class="w-20 h-20" />
                    <h2 class="text-4xl font-black text-white leading-tight tracking-tighter">
                        Bienvenido de <span class="text-cyan-500">nuevo.</span>
                    </h2>
                    <p class="text-gray-400 text-lg leading-relaxed">
                        Inicia sesión para acceder a tu biblioteca personal, revisar tus estadísticas y continuar donde
                        lo dejaste.
                    </p>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-gray-500 font-bold text-xs uppercase tracking-widest">
                            <div
                                class="size-8 rounded-full bg-cyan-900/30 flex items-center justify-center border border-cyan-800/30">
                                <i class="fa-solid fa-gamepad text-cyan-500"></i>
                            </div>
                            Tus juegos favoritos
                        </div>
                        <div class="flex items-center gap-3 text-gray-500 font-bold text-xs uppercase tracking-widest">
                            <div
                                class="size-8 rounded-full bg-cyan-900/30 flex items-center justify-center border border-cyan-800/30">
                                <i class="fa-solid fa-star text-cyan-500"></i>
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
                        <div
                            class="mb-4 font-bold text-sm text-green-400 bg-green-900/20 border border-green-800/30 p-4 rounded-xl">
                            {{ $value }}
                        </div>
                    @endsession

                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                        @csrf

                        <div class="relative">
                            <x-label for="email" value="Email o Usuario"
                                class="text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                            <div class="relative">
                                <i
                                    class="fa-solid fa-circle-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                                <x-input id="email"
                                    class="block w-full bg-[#0f1117] border-gray-800 text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600"
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
                                <i
                                    class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                                <x-input id="password"
                                    class="block w-full bg-[#0f1117] border-gray-800 text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="••••••••" />
                            </div>
                            <div class="flex justify-between mt-3">
                                <div class="flex">
                                    <x-checkbox id="remember_me" name="remember"
                                        class="bg-[#0f1117] border-gray-700 text-cyan-500 focus:ring-cyan-500 rounded cursor-pointer" />
                                    <span
                                        class="ms-2 text-xs text-gray-500 font-bold uppercase tracking-wider cursor-pointer select-none"
                                        onclick="document.getElementById('remember_me').click()">{{ __('Remember me') }}</span>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-[10px] text-cyan-500 font-black uppercase tracking-widest hover:text-cyan-400 transition"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col mt-4">
                            <x-button
                                class="mb-3 w-full justify-center bg-cyan-600 hover:bg-cyan-500 text-white font-black py-4 rounded-xl transition shadow-[0_0_20px_rgba(6,182,212,0.3)] uppercase tracking-widest text-xs">
                                <i class="fa-solid fa-right-to-bracket mr-2"></i> {{ __('Log in') }}
                            </x-button>
                            <a href="{{ route('welcome') }}"
                                class="mb-5 inline-flex items-center justify-center bg-red-600 hover:bg-red-500 text-white font-black px-6 py-3 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(220,38,38,0.3)] hover:shadow-[0_8px_20px_rgba(220,38,38,0.4)] hover:-translate-y-0.5 uppercase tracking-widest text-xs focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-[#0f1117] disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0'">
                                <i class="fas fa-back"></i>{{ __('Volver') }}
                            </a>


                            <p class="text-center text-sm text-gray-500">
                                ¿Aún no tienes cuenta?
                                <a class="text-cyan-500 font-bold hover:text-cyan-400 transition"
                                    href="{{ route('register') }}">
                                    {{ __('Regístrate gratis') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
