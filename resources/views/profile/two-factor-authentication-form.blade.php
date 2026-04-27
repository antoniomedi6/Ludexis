<x-action-section>
    <x-slot name="title">
        <span class="text-gray-900 dark:text-white font-black">{{ __('Autenticación de Dos Factores (2FA)') }}</span>
    </x-slot>

    <x-slot name="description">
        <span
            class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Añade seguridad adicional a tu cuenta usando autenticación de dos factores.') }}</span>
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-black text-gray-900 dark:text-white">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    <span class="text-yellow-600 dark:text-yellow-500"><i class="fa-solid fa-triangle-exclamation mr-2"
                            aria-hidden="true"></i>{{ __('Termina de activar la autenticación de dos factores.') }}</span>
                @else
                    <span class="text-emerald-600 dark:text-emerald-500"><i class="fa-solid fa-shield-check mr-2"
                            aria-hidden="true"></i>{{ __('Has activado la autenticación de dos factores.') }}</span>
                @endif
            @else
                <span class="text-gray-900 dark:text-white"><i class="fa-solid fa-shield mr-2 text-gray-400"
                        aria-hidden="true"></i>{{ __('No has activado la autenticación de dos factores.') }}</span>
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p>
                {{ __('Cuando la autenticación de dos factores está activada, se te pedirá un token seguro y aleatorio durante el inicio de sesión. Puedes obtener este token desde la aplicación Google Authenticator o Authy de tu teléfono.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-bold">
                        @if ($showingConfirmation)
                            {{ __('Para terminar de activar la autenticación de dos factores, escanea el siguiente código QR usando la aplicación de autenticación de tu teléfono o introduce la clave de configuración y proporciona el código OTP generado.') }}
                        @else
                            {{ __('La autenticación de dos factores está activada. Escanea el siguiente código QR usando la aplicación de autenticación de tu teléfono o introduce la clave de configuración.') }}
                        @endif
                    </p>
                </div>

                {{-- Contenedor del QR (Fondo blanco forzado para asegurar legibilidad) --}}
                <div class="mt-4 p-4 inline-block bg-white rounded-xl shadow-sm border border-gray-200">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-bold flex items-center gap-2">
                        <i class="fa-solid fa-key" aria-hidden="true"></i> {{ __('Clave de configuración') }}: <span
                            class="font-mono bg-gray-100 dark:bg-darkbox-main px-2 py-1 rounded text-gray-900 dark:text-white">{{ decrypt($this->user->two_factor_secret) }}</span>
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-6">
                        <label for="code"
                            class="block text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">{{ __('Código') }}</label>

                        <div class="relative w-full sm:w-1/2">
                            <i class="fa-solid fa-hashtag absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                                aria-hidden="true"></i>
                            <x-input id="code" type="text" name="code"
                                class="block w-full bg-gray-50 dark:bg-darkbox-main border-gray-200 dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600 font-mono tracking-widest"
                                inputmode="numeric" autofocus autocomplete="one-time-code" wire:model="code"
                                wire:keydown.enter="confirmTwoFactorAuthentication" placeholder="123456" />
                        </div>

                        <x-input-error for="code" class="mt-2 text-red-500 text-xs font-bold" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-6 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-bold">
                        <i class="fa-solid fa-circle-info text-cyan-500 mr-1" aria-hidden="true"></i>
                        {{ __('Guarda estos códigos de recuperación en un gestor de contraseñas seguro. Se pueden usar para recuperar el acceso a tu cuenta si pierdes tu dispositivo de autenticación de dos factores.') }}
                    </p>
                </div>

                <div
                    class="grid gap-2 max-w-xl mt-4 p-6 font-mono text-sm bg-gray-900 text-cyan-400 rounded-xl border border-gray-800 shadow-inner">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-angle-right text-gray-600 text-xs" aria-hidden="true"></i>
                            {{ $code }}
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-8 flex items-center gap-3">
            @if (!$this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <button type="button" wire:loading.attr="disabled"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 disabled:opacity-50 shadow-sm">
                        {{ __('Activar') }}
                    </button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <button type="button" wire:loading.attr="disabled"
                            class="px-6 py-3 bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-300 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 disabled:opacity-50">
                            <i class="fa-solid fa-rotate-right mr-1" aria-hidden="true"></i>
                            {{ __('Regenerar Códigos') }}
                        </button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <button type="button" wire:loading.attr="disabled"
                            class="inline-flex items-center justify-center px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 disabled:opacity-50 shadow-sm">
                            {{ __('Confirmar') }}
                        </button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <button type="button" wire:loading.attr="disabled"
                            class="px-6 py-3 bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-300 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 disabled:opacity-50">
                            <i class="fa-solid fa-eye mr-1" aria-hidden="true"></i> {{ __('Mostrar Códigos') }}
                        </button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <button type="button" wire:loading.attr="disabled"
                            class="px-6 py-3 bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-300 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 disabled:opacity-50">
                            {{ __('Cancelar') }}
                        </button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <button type="button" wire:loading.attr="disabled"
                            class="inline-flex items-center justify-center px-6 py-3 bg-red-600 hover:bg-red-500 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 disabled:opacity-50">
                            {{ __('Desactivar') }}
                        </button>
                    </x-confirms-password>
                @endif
            @endif
        </div>
    </x-slot>
</x-action-section>
