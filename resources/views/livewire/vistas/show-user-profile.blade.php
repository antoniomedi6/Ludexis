<x-miscomponentes.page-layout :fullWidth="false">

    {{-- CONTROLES SUPERIORES --}}
    <x-slot:aside>
        @auth
            <div x-data="{ openOptions: false, openReport: false }" class="relative flex items-center gap-2">
                @if (Auth::id() !== $user->id)
                    <livewire:utils.follow-button :user="$user" />
                @else
                    <a href="{{ route('profile.show') }}"
                        class="px-6 py-2.5 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-xl hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500 text-gray-600 dark:text-gray-400">
                        <i class="fa-solid fa-gear mr-2" aria-hidden="true"></i> Ajustes
                    </a>
                @endif

                {{-- OPTIONS MENU --}}
                <button type="button" @click="openOptions = !openOptions"
                    class="p-2.5 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-xl hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500 text-gray-600 dark:text-gray-400"
                    aria-label="Opciones del perfil" :aria-expanded="openOptions.toString()">
                    <i class="fa-solid fa-ellipsis" aria-hidden="true"></i>
                </button>

                <div x-show="openOptions" x-cloak @click.outside="openOptions = false"
                    class="absolute right-0 top-full mt-2 w-64 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-lg overflow-hidden z-50"
                    role="menu" aria-label="Opciones del perfil">
                    <div class="p-2 space-y-1">
                        <button type="button" @click="openOptions = false; openReport = true"
                            class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            role="menuitem">
                            <i class="fa-solid fa-flag text-gray-400" aria-hidden="true"></i>
                            <span>Reportar</span>
                        </button>

                        @if (Auth::user()->role === 'admin')
                            <div
                                class="px-3 py-2 rounded-xl bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border">
                                <label for="role_select"
                                    class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">
                                    Rol de usuario
                                </label>
                                <select id="role_select" wire:model.live="selectedRole" wire:change="updateRole"
                                    class="w-full rounded-xl bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border text-sm font-bold text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    <option value="standard">Standard</option>
                                    <option value="journalist">Journalist</option>
                                    <option value="veteran">Veteran</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <div x-data="{ saved: false }"
                                    x-on:role-updated.window="saved = true; setTimeout(() => saved = false, 1600)"
                                    class="relative mt-2">
                                    <template x-if="saved">
                                        <div x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-50"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-50"
                                            class="inline-flex items-center gap-2 text-emerald-500 font-bold text-xs"
                                            role="status" aria-live="polite">
                                            <span
                                                class="bg-white dark:bg-gray-900 rounded-full shadow-lg border border-gray-100 dark:border-gray-700 p-0.5">
                                                <x-icons.saved-animated class="size-6" />
                                            </span>
                                            <span>Rol actualizado.</span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- REPORT MODAL --}}
                <div x-show="openReport" x-cloak x-on:report-sent.window="openReport = false"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true"
                    aria-label="Reportar usuario">
                    <div class="absolute inset-0 bg-black/50" @click="openReport = false" aria-hidden="true"></div>
                    <div
                        class="relative w-full max-w-lg bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-xl p-6">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div>
                                <h3 class="text-lg font-black text-gray-900 dark:text-white">Reportar usuario</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Elige un motivo para reportar a <span class="font-bold">{{ $user->name }}</span>.
                                </p>
                            </div>
                            <button type="button" @click="openReport = false"
                                class="p-2 rounded-xl border border-gray-200 dark:border-darkbox-border bg-white dark:bg-darkbox-card hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
                                aria-label="Cerrar modal">
                                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label for="report_reason"
                                    class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">
                                    Motivo
                                </label>
                                <select id="report_reason" wire:model.live="reportReason"
                                    class="w-full rounded-xl bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border text-sm font-bold text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    <option value="">Selecciona un motivo</option>
                                    <option value="Spam o publicidad">Spam o publicidad</option>
                                    <option value="Suplantación de identidad">Suplantación de identidad</option>
                                    <option value="Lenguaje ofensivo">Lenguaje ofensivo</option>
                                    <option value="Contenido inapropiado">Contenido inapropiado</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                @error('reportReason')
                                    <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end gap-2 pt-2">
                                <button type="button" @click="openReport = false"
                                    class="px-4 py-2 rounded-xl border border-gray-200 dark:border-darkbox-border bg-white dark:bg-darkbox-card text-sm font-black text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    Cancelar
                                </button>
                                <button type="button" wire:click="submitReport"
                                    class="px-4 py-2 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white text-sm font-black transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    Enviar
                                </button>
                            </div>

                            <div x-data="{ saved: false }"
                                x-on:report-sent.window="saved = true; setTimeout(() => saved = false, 1600)"
                                class="relative mt-2">
                                <template x-if="saved">
                                    <div x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-50"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-50"
                                        class="inline-flex items-center gap-2 text-emerald-500 font-bold text-xs"
                                        role="status" aria-live="polite">
                                        <span
                                            class="bg-white dark:bg-gray-900 rounded-full shadow-lg border border-gray-100 dark:border-gray-700 p-0.5">
                                            <x-icons.saved-animated class="size-6" />
                                        </span>
                                        <span>Reporte enviado.</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </x-slot:aside>

    <x-slot>
        <div class="flex flex-col gap-8">

            {{-- HEADER DEL JUGADOR --}}
            <header
                class="w-full bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-[2rem] shadow-sm overflow-hidden relative">

                {{-- Efecto de resplandor ambiental --}}
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-cyan-500/10 blur-[60px] pointer-events-none"
                    aria-hidden="true"></div>

                <div
                    class="relative z-10 p-6 sm:p-10 flex flex-col sm:flex-row items-center sm:items-center gap-6 sm:gap-8">

                    {{-- Contenedor del Avatar --}}
                    <div class="relative shrink-0 group">
                        <div class="absolute -inset-1.5 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-full opacity-30 group-hover:opacity-60 blur-md transition duration-500"
                            aria-hidden="true"></div>
                        <div class="relative">
                            <img src="{{ $user->profile_photo_url }}" alt="Avatar de {{ $user->name }}"
                                class="w-32 h-32 sm:w-36 sm:h-36 rounded-full border-4 border-white dark:border-darkbox-main object-cover shadow-xl bg-gray-100 dark:bg-darkbox-main">

                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 px-3 py-1 bg-yellow-500 text-black text-[10px] font-black uppercase tracking-widest rounded-full border-2 border-white dark:border-darkbox-main shadow-md whitespace-nowrap"
                                title="Rol Oficial">
                                <i class="fa-solid fa-crown mr-1" aria-hidden="true"></i>
                                {{ $user->role ?? 'Jugador' }}
                            </div>
                        </div>
                    </div>

                    {{-- Información Base --}}
                    <div class="flex-1 w-full text-center sm:text-left flex flex-col justify-center gap-5">
                        <div>
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-center sm:justify-start gap-3 mb-2">
                                <h1
                                    class="text-3xl sm:text-4xl font-black text-gray-900 dark:text-white tracking-tight leading-none">
                                    {{ $user->name }}
                                </h1>
                                @if ($user->is_private)
                                    <span
                                        class="w-fit mx-auto sm:mx-0 px-2.5 py-1 bg-gray-100 dark:bg-darkbox-main text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-darkbox-border rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5"
                                        title="Perfil Privado">
                                        <i class="fa-solid fa-lock" aria-hidden="true"></i> Privado
                                    </span>
                                @else
                                    <span
                                        class="w-fit mx-auto sm:mx-0 px-2.5 py-1 bg-gray-100 dark:bg-darkbox-main text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-darkbox-border rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5"
                                        title="Perfil Público">
                                        <i class="fa-solid fa-earth" aria-hidden="true"></i> Público
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                <i class="fa-solid fa-calendar-day mr-1" aria-hidden="true"></i>
                                Registrado en {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('M Y') }}
                            </p>
                        </div>

                        {{-- Progreso XP: Solo visible si no es admin general viendo --}}
                        @if ($canViewPrivateData)
                            <div
                                class="w-full max-w-md mx-auto sm:mx-0 bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border p-3.5 rounded-2xl">
                                <div class="flex justify-between items-end mb-2 px-1">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-widest text-gray-500">Progreso
                                        XP</span>
                                    <span
                                        class="text-[10px] font-black text-cyan-600 dark:text-cyan-400 tabular-nums">{{ $user->xp }}
                                        / 1,000</span>
                                </div>
                                <div class="h-2 w-full bg-gray-200 dark:bg-darkbox-card rounded-full overflow-hidden"
                                    role="progressbar" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
                                    aria-valuemax="1000">
                                    <div class="h-full bg-cyan-500 rounded-full transition-all duration-500"
                                        style="width: {{ min(($user->xp / 1000) * 100, 100) }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Top 3 Juegos --}}
                    @if ($topGames->isNotEmpty() && $canViewPrivateData)
                        <div class="flex flex-col items-center sm:items-end w-full sm:w-auto mt-4 sm:mt-0">
                            <h2 class="text-xs font-black uppercase tracking-widest text-gray-500 mb-3">Top 3 Juegos
                            </h2>
                            <div class="flex items-end justify-center gap-3">
                                @foreach ($topGames as $index => $topGame)
                                    <div class="relative group"
                                        title="{{ $topGame->name }} - {{ $topGame->pivot->rating }}/10">
                                        <img src="{{ $topGame->cover_url ?? 'https://via.placeholder.com/150' }}"
                                            alt="Portada de {{ $topGame->name }}"
                                            class="rounded-lg object-cover shadow-md border-2 {{ $loop->first ? 'w-16 h-24 border-yellow-500 z-10' : ($loop->iteration === 2 ? 'w-14 h-20 border-gray-300 opacity-80' : 'w-12 h-16 border-orange-400 opacity-60') }}">
                                        <div
                                            class="absolute -top-3 -right-3 w-6 h-6 rounded-full bg-darkbox-main border border-darkbox-border flex items-center justify-center text-[10px] font-black text-white shadow-lg">
                                            {{ $loop->iteration }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </header>

            {{-- LAYOUT PRINCIPAL --}}
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">

                {{-- Comprobación de privacidad --}}
                @if ($canViewPrivateData)

                    {{-- ASIDE: Estadísticas y Colecciones --}}
                    <aside class="xl:col-span-4 flex flex-col gap-8">

                        {{-- Estadísticas --}}
                        <div
                            class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-[2rem] p-6 sm:p-8 shadow-sm">
                            <h2
                                class="text-xs font-black uppercase tracking-widest text-gray-500 mb-6 flex items-center gap-2">
                                <i class="fa-solid fa-chart-pie text-cyan-500" aria-hidden="true"></i> Estadísticas
                                Usuario
                            </h2>

                            <div
                                class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-100 dark:border-darkbox-border">
                                <div
                                    class="bg-gray-50 dark:bg-darkbox-main p-4 rounded-2xl border border-gray-100 dark:border-darkbox-border/50 text-center">
                                    <span
                                        class="block text-2xl sm:text-3xl font-black text-gray-900 dark:text-white tabular-nums">{{ $totalHours }}</span>
                                    <span
                                        class="text-[10px] font-bold uppercase text-gray-500 tracking-widest">Horas</span>
                                </div>
                                <div
                                    class="bg-gray-50 dark:bg-darkbox-main p-4 rounded-2xl border border-gray-100 dark:border-darkbox-border/50 text-center">
                                    <span
                                        class="block text-2xl sm:text-3xl font-black text-gray-900 dark:text-white tabular-nums">{{ number_format($averageRating, 1) }}</span>
                                    <span class="text-[10px] font-bold uppercase text-gray-500 tracking-widest">Nota
                                        Media</span>
                                </div>
                            </div>

                            <div class="space-y-4 px-2">
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400">
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i> Completados
                                    </div>
                                    <span
                                        class="text-gray-900 dark:text-white tabular-nums">{{ $completedCount }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <div class="flex items-center gap-2 text-blue-600 dark:text-blue-400">
                                        <i class="fa-solid fa-gamepad" aria-hidden="true"></i> Jugando
                                    </div>
                                    <span
                                        class="text-gray-900 dark:text-white tabular-nums">{{ $playingCount }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <div class="flex items-center gap-2 text-purple-600 dark:text-purple-400">
                                        <i class="fa-solid fa-bookmark" aria-hidden="true"></i> Pendientes
                                    </div>
                                    <span
                                        class="text-gray-900 dark:text-white tabular-nums">{{ $pendingCount }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <div class="flex items-center gap-2 text-red-600 dark:text-red-400">
                                        <i class="fa-solid fa-skull" aria-hidden="true"></i> Abandonados
                                    </div>
                                    <span
                                        class="text-gray-900 dark:text-white tabular-nums">{{ $abandonedCount }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Colecciones --}}
                        <div
                            class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-[2rem] p-6 sm:p-8 shadow-sm">
                            <h2
                                class="text-xs font-black uppercase tracking-widest text-gray-500 mb-6 flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-cyan-500" aria-hidden="true"></i> Colecciones
                            </h2>
                            <nav class="space-y-3" aria-label="Listas de juegos del usuario">
                                @forelse ($customLists as $list)
                                    <a href="{{ route('userLists.show', $list->id) }}"
                                        class="flex justify-between items-center p-4 bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border/50 rounded-2xl hover:border-cyan-500/50 transition-colors group focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                        <span
                                            class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">{{ $list->name }}</span>
                                        <span
                                            class="text-xs font-black text-gray-400 tabular-nums">{{ $list->games_count ?? 0 }}</span>
                                    </a>
                                @empty
                                    <div
                                        class="text-center p-4 border border-dashed border-gray-200 dark:border-darkbox-border rounded-2xl">
                                        <p
                                            class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest">
                                            Sin colecciones</p>
                                    </div>
                                @endforelse
                            </nav>
                        </div>
                    </aside>

                    {{-- FEED PRINCIPAL --}}
                    <div x-data="{ activeTab: 'activity' }" class="xl:col-span-8 flex flex-col gap-8">

                        {{-- Navegación de Pestañas --}}
                        <div class="flex gap-2 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-xl p-1.5 shrink-0 w-fit shadow-sm"
                            role="tablist">
                            <button type="button" @click="activeTab = 'activity'"
                                :class="activeTab === 'activity' ?
                                    'bg-gray-100 dark:bg-darkbox-main text-cyan-600 dark:text-cyan-400' :
                                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                                class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none"
                                role="tab">
                                Actividad
                            </button>
                            <button type="button" @click="activeTab = 'library'"
                                :class="activeTab === 'library' ?
                                    'bg-gray-100 dark:bg-darkbox-main text-cyan-600 dark:text-cyan-400' :
                                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                                class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none"
                                role="tab">
                                Biblioteca
                            </button>
                            <button type="button" @click="activeTab = 'reviews'"
                                :class="activeTab === 'reviews' ?
                                    'bg-gray-100 dark:bg-darkbox-main text-cyan-600 dark:text-cyan-400' :
                                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                                class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none inline-flex items-center gap-2"
                                role="tab">
                                <span>Reseñas</span>
                                <span
                                    class="min-w-7 px-2 py-0.5 rounded-md bg-gray-100 dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border text-[10px] font-black tabular-nums text-gray-600 dark:text-gray-300"
                                    aria-label="Total de reseñas">
                                    {{ $reviews->count() }}
                                </span>
                            </button>
                            <button type="button" @click="activeTab = 'screenshots'"
                                :class="activeTab === 'screenshots' ?
                                    'bg-gray-100 dark:bg-darkbox-main text-cyan-600 dark:text-cyan-400' :
                                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                                class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none"
                                role="tab">
                                Capturas
                            </button>
                        </div>

                        {{-- PESTAÑA: ACTIVIDAD --}}
                        <div x-show="activeTab === 'activity'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4">
                            <div class="flex flex-col gap-6" role="feed" aria-label="Feed de actividad reciente">
                                @forelse ($recentActivity as $game)
                                    @php
                                        $status = $game->pivot->status ?? null;

                                        $statusStyle = match ($status) {
                                            'completed' => [
                                                'bg' => 'bg-emerald-50 dark:bg-emerald-900/20',
                                                'text' => 'text-emerald-600 dark:text-emerald-400',
                                                'border' => 'border-emerald-200 dark:border-emerald-800/50',
                                                'label' => 'Completado',
                                            ],
                                            'playing' => [
                                                'bg' => 'bg-blue-50 dark:bg-blue-900/20',
                                                'text' => 'text-blue-600 dark:text-blue-400',
                                                'border' => 'border-blue-200 dark:border-blue-800/50',
                                                'label' => 'Jugando',
                                            ],
                                            'abandoned' => [
                                                'bg' => 'bg-red-50 dark:bg-red-900/20',
                                                'text' => 'text-red-600 dark:text-red-400',
                                                'border' => 'border-red-200 dark:border-red-800/50',
                                                'label' => 'Abandonado',
                                            ],
                                            'pending' => [
                                                'bg' => 'bg-purple-50 dark:bg-purple-900/20',
                                                'text' => 'text-purple-600 dark:text-purple-400',
                                                'border' => 'border-purple-200 dark:border-purple-800/50',
                                                'label' => 'Pendiente',
                                            ],
                                            default => [
                                                'bg' => 'bg-gray-50 dark:bg-gray-800',
                                                'text' => 'text-gray-600 dark:text-gray-400',
                                                'border' => 'border-gray-200 dark:border-gray-700',
                                                'label' => $status ? ucfirst($status) : 'Sin estado',
                                            ],
                                        };
                                    @endphp

                                    <article
                                        class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-[2rem] p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow">
                                        <div class="flex items-center gap-2 mb-6">
                                            <span
                                                class="text-[10px] {{ $statusStyle['bg'] }} {{ $statusStyle['text'] }} border {{ $statusStyle['border'] }} px-2 py-0.5 rounded-md font-black uppercase tracking-widest">
                                                {{ $statusStyle['label'] }}
                                            </span>
                                            <time
                                                class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                                Actualizado {{ $game->pivot->updated_at?->diffForHumans() ?? '—' }}
                                            </time>
                                        </div>

                                        <div class="flex flex-col sm:flex-row gap-6">
                                            <a href="{{ route('games.show', $game->slug) }}"
                                                class="shrink-0 group focus:outline-none focus:ring-4 focus:ring-cyan-500 rounded-xl h-fit">
                                                <img src="{{ $game->cover_url ?? 'https://via.placeholder.com/300x400' }}"
                                                    class="w-full sm:w-28 h-48 sm:h-36 object-cover rounded-xl shadow-md group-hover:scale-[1.02] transition-transform duration-300 {{ $status === 'abandoned' ? 'grayscale opacity-80' : '' }}"
                                                    alt="Portada de {{ $game->name }}">
                                            </a>

                                            <div class="flex-1 flex flex-col justify-between space-y-3">
                                                <div>
                                                    <div class="flex justify-between items-start gap-4 mb-2">
                                                        <h3
                                                            class="text-xl font-black text-gray-900 dark:text-white leading-tight">
                                                            <a href="{{ route('games.show', $game->id) }}"
                                                                class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors focus:outline-none focus:underline">
                                                                {{ $game->name }}
                                                            </a>
                                                        </h3>
                                                        @if ($game->pivot->rating)
                                                            <div
                                                                class="shrink-0 bg-yellow-50 dark:bg-yellow-900/20 px-2.5 py-1 rounded-lg border border-yellow-200 dark:border-yellow-800/50 flex items-center gap-1.5">
                                                                <span
                                                                    class="font-black text-yellow-700 dark:text-yellow-500 text-sm tabular-nums">{{ $game->pivot->rating }}</span>
                                                                <i class="fa-solid fa-star text-yellow-500 text-[10px]"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    @if ($game->pivot->hours_finish + $game->pivot->hours_completed > 0)
                                                        <div class="mb-4">
                                                            <span
                                                                class="text-[10px] font-bold text-gray-500 bg-gray-100 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border px-2 py-1 rounded-md uppercase tracking-wider">
                                                                <i class="fa-solid fa-clock mr-1"
                                                                    aria-hidden="true"></i>
                                                                {{ $game->pivot->hours_finish + $game->pivot->hours_completed }}h
                                                                registradas
                                                            </span>
                                                        </div>
                                                    @endif

                                                    @if ($game->pivot->review)
                                                        <p
                                                            class="text-sm text-gray-600 dark:text-gray-400 italic line-clamp-3">
                                                            "{{ $game->pivot->review }}"
                                                        </p>
                                                    @elseif($status === 'abandoned')
                                                        <p class="text-sm text-gray-500 dark:text-gray-500 italic">No
                                                            dejó reseña al abandonar el juego.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    <div
                                        class="flex flex-col items-center justify-center p-12 text-center bg-gray-50 dark:bg-darkbox-card rounded-[2rem] border border-dashed border-gray-200 dark:border-darkbox-border">
                                        <i class="fa-solid fa-history text-4xl text-gray-400 dark:text-gray-600 mb-4"
                                            aria-hidden="true"></i>
                                        <h3 class="text-lg font-black text-gray-900 dark:text-white mb-2">Sin actividad
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm">No hay registros
                                            recientes para mostrar.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- PESTAÑA: BIBLIOTECA --}}
                        <div x-show="activeTab === 'library'" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4">
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                                @forelse ($games as $game)
                                    <x-miscomponentes.game-card :game="$game" :status="$game->pivot->status" :rating="$game->pivot->rating"
                                        :hours="$game->pivot->hours_finish + $game->pivot->hours_completed" />
                                @empty
                                    <div
                                        class="col-span-full flex flex-col items-center justify-center p-12 text-center bg-gray-50 dark:bg-darkbox-card rounded-[2rem] border border-dashed border-gray-200 dark:border-darkbox-border">
                                        <i class="fa-solid fa-ghost text-4xl text-gray-400 dark:text-gray-600 mb-4"
                                            aria-hidden="true"></i>
                                        <h3 class="text-lg font-black text-gray-900 dark:text-white mb-2">Biblioteca
                                            vacía</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm">Este usuario aún
                                            no ha añadido ningún juego.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- PESTAÑA: RESEÑAS --}}
                        <div x-show="activeTab === 'reviews'" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4">
                            <section class="flex flex-col gap-6" aria-label="Reseñas del usuario">
                                @forelse ($reviews as $review)
                                    <article
                                        class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-[2rem] p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between gap-4 mb-5">
                                            <div class="min-w-0">
                                                <h3
                                                    class="text-lg sm:text-xl font-black text-gray-900 dark:text-white leading-tight">
                                                    <a href="{{ route('games.show', $review->game?->slug) }}"
                                                        class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors focus:outline-none focus:underline">
                                                        {{ $review->game?->title ?? 'Juego' }}
                                                    </a>
                                                </h3>
                                                @php
                                                    $reviewUpdatedAt = $review->updated_at ?? null;
                                                    $reviewUpdatedAt = $reviewUpdatedAt
                                                        ? \Carbon\Carbon::parse($reviewUpdatedAt)->timezone(
                                                            config('app.timezone'),
                                                        )
                                                        : null;
                                                @endphp
                                                <time
                                                    class="mt-1 block text-[10px] font-bold text-gray-400 uppercase tracking-widest"
                                                    @if ($reviewUpdatedAt) datetime="{{ $reviewUpdatedAt->toISOString() }}" title="{{ $reviewUpdatedAt->translatedFormat('d M Y, H:i') }}" @endif>
                                                    Actualizado
                                                    {{ $reviewUpdatedAt ? $reviewUpdatedAt->diffForHumans() : '—' }}
                                                </time>
                                            </div>

                                            <div class="shrink-0 flex items-center gap-2">
                                                @auth
                                                    @if (Auth::id() === $review->user_id)
                                                        <livewire:utils.review-owner-actions :review="$review"
                                                            :key="'review-owner-actions-profile-' . $review->id" />
                                                    @endif
                                                @endauth

                                                @if ($review->rating)
                                                    <div
                                                        class="bg-yellow-50 dark:bg-yellow-900/20 px-2.5 py-1 rounded-lg border border-yellow-200 dark:border-yellow-800/50 flex items-center gap-1.5">
                                                        <span
                                                            class="font-black text-yellow-700 dark:text-yellow-500 text-sm tabular-nums">
                                                            {{ $review->rating }}
                                                        </span>
                                                        <i class="fa-solid fa-star text-yellow-500 text-[10px]"
                                                            aria-hidden="true"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex flex-col sm:flex-row gap-6">
                                            <a href="{{ route('games.show', $review->game?->slug) }}"
                                                class="shrink-0 group focus:outline-none focus:ring-4 focus:ring-cyan-500 rounded-xl h-fit">
                                                <img src="{{ $review->game?->cover_url ?? 'https://via.placeholder.com/300x400' }}"
                                                    class="w-full sm:w-28 h-48 sm:h-36 object-cover rounded-xl shadow-md group-hover:scale-[1.02] transition-transform duration-300"
                                                    alt="Portada de {{ $review->game?->title ?? 'juego' }}">
                                            </a>

                                            <div class="flex-1">
                                                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                                    {{ $review->review }}
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    <div
                                        class="flex flex-col items-center justify-center p-12 text-center bg-gray-50 dark:bg-darkbox-card rounded-[2rem] border border-dashed border-gray-200 dark:border-darkbox-border">
                                        <i class="fa-solid fa-star-half-stroke text-4xl text-gray-400 dark:text-gray-600 mb-4"
                                            aria-hidden="true"></i>
                                        <h3 class="text-lg font-black text-gray-900 dark:text-white mb-2">Sin reseñas
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm">Este usuario
                                            todavía no ha publicado reseñas.</p>
                                    </div>
                                @endforelse
                            </section>
                        </div>

                        {{-- PESTAÑA: CAPTURAS --}}
                        <div x-show="activeTab === 'screenshots'" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4">
                            <section class="flex flex-col gap-6" aria-label="Capturas del usuario">
                                @if ($screenshots->isNotEmpty())
                                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4" role="list">
                                        @foreach ($screenshots as $item)
                                            <article role="listitem"
                                                class="relative group rounded-3xl overflow-hidden bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                                                <div x-data
                                                    @click="$dispatch('open-image-detail', { imageId: {{ $item->id }} })"
                                                    @keydown.enter="$dispatch('open-image-detail', { imageId: {{ $item->id }} })"
                                                    tabindex="0" role="button"
                                                    aria-label="Ver captura de {{ $item->game?->title ?? 'juego' }}"
                                                    class="relative aspect-video w-full overflow-hidden cursor-pointer focus:outline-none focus:ring-4 focus:ring-cyan-500">
                                                    <img src="{{ Storage::url($item->image_path) }}"
                                                        alt="Captura de {{ $item->game?->title ?? 'juego' }}"
                                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                                                        loading="lazy" />

                                                    @if ($item->is_spoiler && !$canManageScreenshots)
                                                        <div
                                                            class="absolute inset-0 bg-gray-950/90 backdrop-blur-xl flex items-center justify-center">
                                                            <span
                                                                class="text-[10px] font-black uppercase tracking-widest text-white bg-cyan-600 px-3 py-1 rounded-lg">
                                                                Spoiler
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>

                                                @auth
                                                    @if (Auth::id() === $item->user_id)
                                                        <div class="absolute top-3 right-3 z-30">
                                                            <livewire:utils.image-owner-actions :image="$item"
                                                                :key="'image-owner-actions-profile-' . $item->id" />
                                                        </div>
                                                    @endif
                                                @endauth

                                                <div class="p-4 border-t border-gray-100 dark:border-darkbox-border">
                                                    <p
                                                        class="text-xs font-black text-gray-900 dark:text-white line-clamp-1">
                                                        {{ $item->game?->title ?? 'Juego' }}
                                                    </p>
                                                    <time
                                                        class="mt-1 block text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                                        {{ $item->created_at?->diffForHumans() ?? '—' }}
                                                    </time>
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>
                                @else
                                    <div
                                        class="flex flex-col items-center justify-center p-12 text-center bg-gray-50 dark:bg-darkbox-card rounded-[2rem] border border-dashed border-gray-200 dark:border-darkbox-border">
                                        <div
                                            class="w-16 h-16 bg-gray-100 dark:bg-darkbox-main rounded-2xl flex items-center justify-center mb-4">
                                            <i class="fa-solid fa-image text-2xl text-gray-400 dark:text-gray-500"
                                                aria-hidden="true"></i>
                                        </div>
                                        <h3 class="text-lg font-black text-gray-900 dark:text-white mb-2">
                                            Sin capturas
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm">
                                            El usuario no ha subido capturas de pantalla todavía.
                                        </p>
                                    </div>
                                @endif
                            </section>
                        </div>

                    </div>
                @else
                    {{-- ESTADO VACÍO PARA PERFIL PRIVADO --}}
                    <div
                        class="xl:col-span-12 flex flex-col items-center justify-center p-12 sm:p-20 text-center bg-gray-50 dark:bg-darkbox-card rounded-[2rem] border border-dashed border-gray-200 dark:border-darkbox-border mt-8">
                        <i class="fa-solid fa-lock text-5xl text-gray-400 dark:text-gray-600 mb-6"
                            aria-hidden="true"></i>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">Este perfil es privado</h3>
                        <p class="text-base text-gray-500 dark:text-gray-400 max-w-md">No puedes ver la actividad,
                            biblioteca ni estadísticas de este usuario porque ha configurado su cuenta como privada.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- MODALES --}}
        <livewire:utils.review-modal />
        <livewire:utils.image-detail-modal />
    </x-slot>
</x-miscomponentes.page-layout>
