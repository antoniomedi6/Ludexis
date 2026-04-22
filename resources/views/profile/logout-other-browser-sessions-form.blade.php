<x-action-section>
    <x-slot name="title">
        <span class="text-gray-900 dark:text-white font-black">{{ __('Sesiones del Navegador') }}</span>
    </x-slot>

    <x-slot name="description">
        <span
            class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Gestiona y cierra tus sesiones activas en otros navegadores y dispositivos.') }}</span>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('Si es necesario, puedes cerrar la sesión de todos tus otros navegadores en todos tus dispositivos. A continuación se muestran algunas de tus sesiones recientes; sin embargo, esta lista puede no ser exhaustiva. Si crees que tu cuenta ha sido comprometida, también deberías actualizar tu contraseña.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border shrink-0">
                            @if ($session->agent->isDesktop())
                                <i class="fa-solid fa-desktop text-gray-500 dark:text-gray-400 text-lg"
                                    aria-hidden="true"></i>
                            @else
                                <i class="fa-solid fa-mobile-screen text-gray-500 dark:text-gray-400 text-lg"
                                    aria-hidden="true"></i>
                            @endif
                        </div>

                        <div class="ms-4 flex-1">
                            <div class="text-sm font-bold text-gray-900 dark:text-white">
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Desconocido') }} -
                                {{ $session->agent->browser() ? $session->agent->browser() : __('Desconocido') }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-1">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span
                                            class="text-emerald-500 font-black uppercase tracking-widest ml-1">{{ __('Este dispositivo') }}</span>
                                    @else
                                        <span class="ml-1">{{ __('Última vez activo') }}
                                            {{ $session->last_active }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-6">
            <button wire:click="confirmLogout" wire:loading.attr="disabled"
                class="inline-flex items-center justify-center px-6 py-3 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-[0_0_15px_rgba(8,145,178,0.2)] hover:shadow-[0_0_25px_rgba(8,145,178,0.4)] focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-darkbox-card disabled:opacity-50">
                <i class="fa-solid fa-right-from-bracket mr-2" aria-hidden="true"></i> {{ __('Cerrar otras sesiones') }}
            </button>

            <x-action-message class="ms-4 text-emerald-500 font-bold text-sm" on="loggedOut">
                <i class="fa-solid fa-check mr-1" aria-hidden="true"></i> {{ __('Hecho.') }}
            </x-action-message>
        </div>

        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">
                <span class="text-gray-900 dark:text-white font-black text-xl">{{ __('Cerrar otras sesiones') }}</span>
            </x-slot>

            <x-slot name="content">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    {{ __('Por favor, introduce tu contraseña para confirmar que deseas cerrar la sesión de tus otros navegadores en todos tus dispositivos.') }}
                </p>

                <div class="mt-4" x-data="{}"
                    x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                            aria-hidden="true"></i>
                        <x-input type="password"
                            class="mt-1 block w-full sm:w-3/4 bg-gray-50 dark:bg-darkbox-main border-gray-200 dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                            autocomplete="current-password" placeholder="{{ __('Tu contraseña') }}" x-ref="password"
                            wire:model="password" wire:keydown.enter="logoutOtherBrowserSessions" />
                    </div>
                    <x-input-error for="password" class="mt-2 text-red-500 text-xs font-bold" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled"
                    class="px-6 py-3 bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-300 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 disabled:opacity-50">
                    {{ __('Cancelar') }}
                </button>

                <button wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled"
                    class="ms-3 inline-flex items-center justify-center px-6 py-3 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-[0_0_15px_rgba(8,145,178,0.2)] hover:shadow-[0_0_25px_rgba(8,145,178,0.4)] focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-darkbox-card disabled:opacity-50">
                    {{ __('Cerrar Sesiones') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
