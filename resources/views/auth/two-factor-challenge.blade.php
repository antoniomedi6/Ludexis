<x-guest-layout>
    <div
        class="min-h-screen bg-darkbox-main flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-20 pointer-events-none"
            aria-hidden="true">
            <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-cyan-900/40 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-900/20 blur-[120px] rounded-full">
            </div>
        </div>

        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 relative z-10">
            <div
                class="bg-darkbox-card/90 backdrop-blur-2xl border border-darkbox-border rounded-3xl p-8 md:p-12 shadow-2xl">

                <div class="flex flex-col items-center justify-center pb-8 mb-8 border-b border-darkbox-border">
                    <a href="{{ route('welcome') }}" wire:navigate
                        class="inline-flex flex-col items-center gap-2 rounded-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 focus-visible:ring-offset-2 focus-visible:ring-offset-darkbox-card transition-opacity hover:opacity-95"
                        aria-label="{{ config('app.name', 'Ludexis') }}, ir al inicio">
                        <x-miscomponentes.application-logo-name class="h-24 w-auto sm:h-28 md:h-32" />
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

                    <div class="hidden md:flex flex-col gap-6">
                        <div
                            class="size-16 rounded-2xl bg-cyan-900/40 border border-cyan-700/40 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-shield text-3xl text-cyan-400" aria-hidden="true"></i>
                        </div>
                        <h2 class="text-4xl font-black text-white leading-tight tracking-tighter">
                            Verificación en <span class="text-cyan-500">dos pasos.</span>
                        </h2>
                        <p class="text-gray-400 text-lg leading-relaxed">
                            Tu cuenta tiene la autenticación en dos pasos activada. Completa el acceso con el código de
                            tu
                            aplicación o, si lo necesitas, con un código de recuperación.
                        </p>
                        <div class="space-y-3 mt-2">
                            <div
                                class="flex items-center gap-3 text-gray-500 font-bold text-xs uppercase tracking-widest">
                                <div
                                    class="size-8 rounded-full bg-cyan-900/30 flex items-center justify-center border border-cyan-800/30">
                                    <i class="fa-solid fa-mobile-screen-button text-cyan-500" aria-hidden="true"></i>
                                </div>
                                App de autenticación (Google Authenticator, Authy…)
                            </div>
                            <div
                                class="flex items-center gap-3 text-gray-500 font-bold text-xs uppercase tracking-widest">
                                <div
                                    class="size-8 rounded-full bg-cyan-900/30 flex items-center justify-center border border-cyan-800/30">
                                    <i class="fa-solid fa-key text-cyan-500" aria-hidden="true"></i>
                                </div>
                                Códigos de recuperación
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="md:hidden mb-6 flex justify-center">
                            <div class="size-14 rounded-2xl bg-cyan-900/40 border border-cyan-700/40 flex items-center justify-center"
                                aria-hidden="true">
                                <i class="fa-solid fa-shield text-2xl text-cyan-400"></i>
                            </div>
                        </div>

                        <x-validation-errors class="mb-4" />

                        <div x-data="{ recovery: false }">
                            <div class="mb-6 space-y-3" role="region" aria-live="polite">
                                <p class="text-sm text-gray-400 leading-relaxed" x-show="!recovery">
                                    Introduce el código de seis dígitos que muestra tu aplicación de autenticación.
                                </p>
                                <p class="text-sm text-gray-400 leading-relaxed" x-cloak x-show="recovery">
                                    Introduce uno de tus <span class="text-cyan-400 font-bold">códigos de
                                        recuperación</span>
                                    de emergencia.
                                </p>
                            </div>

                            <form method="POST" action="{{ route('two-factor.login') }}" class="flex flex-col gap-5">
                                @csrf

                                <div class="relative" x-show="!recovery">
                                    <x-label for="code" value="Código de verificación"
                                        class="text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                                    <div class="relative">
                                        <i class="fa-solid fa-hashtag absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                                            aria-hidden="true"></i>
                                        <x-input id="code"
                                            class="block w-full bg-darkbox-main border-darkbox-border text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600 font-mono tracking-widest"
                                            type="text" inputmode="numeric" pattern="[0-9]*" name="code" autofocus
                                            x-ref="code" autocomplete="one-time-code" placeholder="000000"
                                            aria-describedby="two-factor-code-hint" />
                                    </div>
                                    <p id="two-factor-code-hint" class="sr-only">Código numérico de un solo uso de seis
                                        dígitos.</p>
                                </div>

                                <div class="relative" x-cloak x-show="recovery">
                                    <x-label for="recovery_code" value="Código de recuperación"
                                        class="text-gray-400 mb-1 ml-1 text-[10px] font-black uppercase tracking-widest" />
                                    <div class="relative">
                                        <i class="fa-solid fa-life-ring absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                                            aria-hidden="true"></i>
                                        <x-input id="recovery_code"
                                            class="block w-full bg-darkbox-main border-darkbox-border text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-600 font-mono"
                                            type="text" name="recovery_code" x-ref="recovery_code"
                                            autocomplete="one-time-code" placeholder="xxxxxxxx"
                                            aria-describedby="two-factor-recovery-hint" />
                                    </div>
                                    <p id="two-factor-recovery-hint" class="sr-only">Introduce un código de recuperación
                                        completo.</p>
                                </div>

                                <div class="flex flex-col gap-4 mt-2">
                                    <x-button type="submit"
                                        class="w-full justify-center bg-cyan-600 hover:bg-cyan-500 text-white font-black py-3.5 rounded-xl transition-all duration-300 shadow-[0_0_15px_rgba(6,182,212,0.2)] hover:shadow-[0_0_25px_rgba(6,182,212,0.4)] uppercase tracking-widest text-xs focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-darkbox-main">
                                        <i class="fa-solid fa-unlock-keyhole mr-2" aria-hidden="true"></i>
                                        Continuar
                                    </x-button>

                                    <div class="flex justify-center">
                                        <button type="button"
                                            class="text-[10px] text-cyan-500 font-black uppercase tracking-widest hover:text-cyan-400 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 rounded-lg py-2 px-2"
                                            x-show="!recovery"
                                            x-on:click="
                                            recovery = true;
                                            $nextTick(() => { $refs.recovery_code.focus() })
                                        ">
                                            Usar código de recuperación
                                        </button>

                                        <button type="button"
                                            class="text-[10px] text-cyan-500 font-black uppercase tracking-widest hover:text-cyan-400 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 rounded-lg py-2 px-2"
                                            x-cloak x-show="recovery"
                                            x-on:click="
                                            recovery = false;
                                            $nextTick(() => { $refs.code.focus() })
                                        ">
                                            Usar código de autenticación
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="flex items-center justify-between mt-8 pt-6 border-t border-darkbox-border">
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center gap-2 text-[10px] text-gray-500 font-black uppercase tracking-widest hover:text-cyan-400 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 rounded-lg">
                                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                                Volver al inicio de sesión
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
