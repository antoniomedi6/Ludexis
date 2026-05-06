<x-miscomponentes.page-layout title1="Panel de" title2="Moderación">
    <x-slot name="subtitle">
        Gestiona los reportes enviados por la comunidad y aplica acciones de moderación.
    </x-slot>

    <x-slot>
        <div class="flex flex-col gap-8">

            {{-- RESUMEN --}}
            <section class="grid grid-cols-2 md:grid-cols-4 gap-4" aria-label="Resumen de reportes">
                <div
                    class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-3xl p-6 flex flex-col justify-center items-center text-center shadow-sm relative overflow-hidden">
                    <i class="fa-solid fa-flag absolute -bottom-4 -right-4 text-6xl text-red-50 dark:text-red-900/20"
                        aria-hidden="true"></i>
                    <span
                        class="text-4xl font-black text-red-600 dark:text-red-400 mb-1 relative z-10 tabular-nums">{{ $pendingCount }}</span>
                    <span
                        class="text-xs font-black uppercase tracking-widest text-gray-500 relative z-10">Pendientes</span>
                </div>

                <div
                    class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-3xl p-6 flex flex-col justify-center items-center text-center shadow-sm relative overflow-hidden">
                    <i class="fa-solid fa-circle-check absolute -bottom-4 -right-4 text-6xl text-emerald-50 dark:text-emerald-900/20"
                        aria-hidden="true"></i>
                    <span
                        class="text-4xl font-black text-emerald-600 dark:text-emerald-400 mb-1 relative z-10 tabular-nums">{{ $resolvedCount }}</span>
                    <span
                        class="text-xs font-black uppercase tracking-widest text-gray-500 relative z-10">Resueltos</span>
                </div>

                <div
                    class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-3xl p-6 flex flex-col justify-center items-center text-center shadow-sm relative overflow-hidden">
                    <i class="fa-solid fa-user absolute -bottom-4 -right-4 text-6xl text-gray-100 dark:text-gray-800/30"
                        aria-hidden="true"></i>
                    <span
                        class="text-4xl font-black text-gray-900 dark:text-white mb-1 relative z-10 tabular-nums">{{ $userReports }}</span>
                    <span
                        class="text-xs font-black uppercase tracking-widest text-gray-500 relative z-10">Perfiles</span>
                </div>

                <div
                    class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-3xl p-6 flex flex-col justify-center items-center text-center shadow-sm relative overflow-hidden">
                    <i class="fa-solid fa-image absolute -bottom-4 -right-4 text-6xl text-gray-100 dark:text-gray-800/30"
                        aria-hidden="true"></i>
                    <span
                        class="text-4xl font-black text-gray-900 dark:text-white mb-1 relative z-10 tabular-nums">{{ $imageReports + $reviewReports }}</span>
                    <span
                        class="text-xs font-black uppercase tracking-widest text-gray-500 relative z-10">Contenido</span>
                </div>
            </section>

            {{-- FILTERS --}}
            <section
                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-3xl p-4 shadow-sm"
                aria-label="Filtros de reportes">

                <div class="flex gap-2 bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-xl p-1.5 w-fit"
                    role="tablist" aria-label="Filtrar por estado">
                    <button type="button" wire:click="setStatus('Pending')" role="tab"
                        aria-selected="{{ $statusFilter === 'Pending' ? 'true' : 'false' }}"
                        class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none focus:ring-2 focus:ring-cyan-500 {{ $statusFilter === 'Pending' ? 'bg-white dark:bg-darkbox-card text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-500 hover:text-gray-900 dark:hover:text-white' }}">
                        Pendientes
                    </button>
                    <button type="button" wire:click="setStatus('Resolved')" role="tab"
                        aria-selected="{{ $statusFilter === 'Resolved' ? 'true' : 'false' }}"
                        class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none focus:ring-2 focus:ring-cyan-500 {{ $statusFilter === 'Resolved' ? 'bg-white dark:bg-darkbox-card text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-500 hover:text-gray-900 dark:hover:text-white' }}">
                        Resueltos
                    </button>
                </div>

                <div class="flex flex-wrap items-center gap-2" aria-label="Filtrar por tipo">
                    <span class="text-xs font-black uppercase tracking-widest text-gray-500 mr-2">Tipo</span>
                    @foreach (['all' => 'Todos', 'User' => 'Perfiles', 'Image' => 'Capturas', 'GameUser' => 'Reseñas'] as $value => $label)
                        <button type="button" wire:click="setType('{{ $value }}')"
                            aria-pressed="{{ $typeFilter === $value ? 'true' : 'false' }}"
                            class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500 border {{ $typeFilter === $value ? 'bg-cyan-600 text-white border-cyan-600' : 'bg-white dark:bg-darkbox-card text-gray-600 dark:text-gray-400 border-gray-200 dark:border-darkbox-border hover:border-cyan-500/50' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- LISTADO --}}
            <section class="flex flex-col gap-6" aria-label="Listado de reportes">
                @forelse ($reports as $report)
                    @php
                        $target = $report->reportable;
                        $type = $report->reportable_type;
                        $isUser = $type === \App\Models\User::class;
                        $isImage = $type === \App\Models\Image::class;
                        $isReview = $type === \App\Models\GameUser::class;
                    @endphp

                    <article
                        class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-3xl p-6 sm:p-8 shadow-sm">

                        {{-- HEADER --}}
                        <div
                            class="flex flex-wrap items-center justify-between gap-3 mb-6 pb-6 border-b border-gray-100 dark:border-darkbox-border">
                            <div class="flex flex-wrap items-center gap-2">
                                <span
                                    class="text-xs px-2.5 py-1 rounded-md font-black uppercase tracking-widest border
                                    {{ $report->status === 'Pending'
                                        ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border-red-200 dark:border-red-800/50'
                                        : 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800/50' }}">
                                    {{ $report->status === 'Pending' ? 'Pendiente' : 'Resuelto' }}
                                </span>

                                <span
                                    class="text-xs px-2.5 py-1 rounded-md font-black uppercase tracking-widest bg-cyan-50 dark:bg-cyan-900/20 text-cyan-600 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50">
                                    @if ($isUser)
                                        <i class="fa-solid fa-user mr-1" aria-hidden="true"></i> Perfil
                                    @elseif ($isImage)
                                        <i class="fa-solid fa-image mr-1" aria-hidden="true"></i> Captura
                                    @elseif ($isReview)
                                        <i class="fa-solid fa-pen-to-square mr-1" aria-hidden="true"></i> Reseña
                                    @else
                                        <i class="fa-solid fa-question mr-1" aria-hidden="true"></i> Otro
                                    @endif
                                </span>

                                <time class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    {{ \Carbon\Carbon::parse($report->created_at)->diffForHumans() }}
                                </time>
                            </div>

                            <span class="text-xs font-black text-gray-400 tabular-nums">#{{ $report->id }}</span>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                            {{-- REPORTER --}}
                            <div class="lg:col-span-3 flex flex-col gap-3">
                                <span class="text-xs font-black uppercase tracking-widest text-gray-500">Reportado
                                    por</span>
                                @if ($report->user)
                                    <a href="{{ route('profile', $report->user->id) }}"
                                        class="flex items-center gap-3 bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-2xl p-3 hover:border-cyan-500/50 transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                        <img src="{{ $report->user->profile_photo_url }}"
                                            alt="Avatar de {{ $report->user->name }}"
                                            class="w-10 h-10 rounded-full object-cover shrink-0">
                                        <div class="min-w-0">
                                            <p class="text-sm font-black text-gray-900 dark:text-white truncate">
                                                {{ $report->user->name }}
                                            </p>
                                            <p
                                                class="text-xs font-bold uppercase tracking-widest text-cyan-600 dark:text-cyan-400">
                                                {{ $report->user->roleLabel() }}
                                            </p>
                                        </div>
                                    </a>
                                @else
                                    <span class="text-sm font-bold text-gray-400">Usuario eliminado</span>
                                @endif

                                <div
                                    class="bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-2xl p-3">
                                    <p class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Motivo
                                    </p>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $report->reason }}
                                    </p>
                                </div>
                            </div>

                            {{-- TARGET --}}
                            <div class="lg:col-span-6 flex flex-col gap-3">
                                <span class="text-xs font-black uppercase tracking-widest text-gray-500">Contenido
                                    reportado</span>

                                @if (!$target)
                                    <div
                                        class="flex items-center gap-3 bg-gray-50 dark:bg-darkbox-main border border-dashed border-gray-200 dark:border-darkbox-border rounded-2xl p-4">
                                        <i class="fa-solid fa-triangle-exclamation text-gray-400 text-xl"
                                            aria-hidden="true"></i>
                                        <p class="text-sm font-bold text-gray-500">El elemento reportado ya no existe.
                                        </p>
                                    </div>
                                @elseif ($isUser)
                                    <div
                                        class="bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-2xl p-4 flex items-center gap-4">
                                        <img src="{{ $target->profile_photo_url }}"
                                            alt="Avatar de {{ $target->name }}"
                                            class="w-14 h-14 rounded-full object-cover shrink-0">
                                        <div class="min-w-0 flex-1">
                                            <p class="text-base font-black text-gray-900 dark:text-white truncate">
                                                {{ $target->name }}
                                            </p>
                                            <p
                                                class="text-xs font-bold uppercase tracking-widest text-gray-500 truncate">
                                                {{ $target->email }}
                                            </p>
                                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                                <span
                                                    class="text-xs font-black uppercase tracking-widest text-cyan-600 dark:text-cyan-400">
                                                    <i class="fa-solid fa-crown mr-1" aria-hidden="true"></i>
                                                    {{ $target->roleLabel() }}
                                                </span>
                                                @if ($target->banned_at)
                                                    <span
                                                        class="text-xs px-2 py-0.5 rounded-md font-black uppercase tracking-widest bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/50">
                                                        <i class="fa-solid fa-ban mr-1" aria-hidden="true"></i> Baneado
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($isImage)
                                    <div
                                        class="bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-2xl p-4 flex flex-col sm:flex-row gap-4">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($target->image_path) }}"
                                            alt="Captura reportada"
                                            class="w-full sm:w-40 h-32 object-cover rounded-xl shadow-md shrink-0 {{ $target->is_spoiler ? 'blur-sm hover:blur-none transition-all' : '' }}">
                                        <div class="flex-1 min-w-0">
                                            @if ($target->game)
                                                <p class="text-base font-black text-gray-900 dark:text-white truncate">
                                                    {{ $target->game->title ?? ($target->game->name ?? 'Juego') }}
                                                </p>
                                            @endif
                                            @if ($target->user)
                                                <a href="{{ route('profile', $target->user->id) }}"
                                                    class="inline-flex items-center gap-2 mt-2 text-xs font-bold text-gray-500 hover:text-cyan-600 dark:hover:text-cyan-400 focus:outline-none focus:underline">
                                                    <i class="fa-solid fa-user" aria-hidden="true"></i>
                                                    Subida por {{ $target->user->name }}
                                                </a>
                                            @endif
                                            @if ($target->is_spoiler)
                                                <span
                                                    class="block mt-3 text-xs px-2 py-0.5 w-fit rounded-md font-black uppercase tracking-widest bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50">
                                                    <i class="fa-solid fa-eye-slash mr-1" aria-hidden="true"></i>
                                                    Spoiler
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @elseif ($isReview)
                                    <div
                                        class="bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-2xl p-4 flex flex-col gap-3">
                                        <div class="flex items-center gap-3">
                                            @if ($target->game)
                                                <img src="{{ $target->game->cover_url ?? 'https://via.placeholder.com/80' }}"
                                                    alt="Portada"
                                                    class="w-12 h-16 rounded-lg object-cover shadow-sm shrink-0">
                                                <div class="min-w-0 flex-1">
                                                    <p
                                                        class="text-base font-black text-gray-900 dark:text-white truncate">
                                                        {{ $target->game->title ?? ($target->game->name ?? 'Juego') }}
                                                    </p>
                                                    @if ($target->user)
                                                        <a href="{{ route('profile', $target->user->id) }}"
                                                            class="inline-flex items-center gap-2 text-xs font-bold text-gray-500 hover:text-cyan-600 dark:hover:text-cyan-400 focus:outline-none focus:underline">
                                                            <i class="fa-solid fa-user" aria-hidden="true"></i>
                                                            {{ $target->user->name }}
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                            @if ($target->rating)
                                                <div
                                                    class="shrink-0 flex items-center gap-1.5 bg-gray-50 dark:bg-darkbox-main px-2.5 py-1 rounded-lg border border-gray-200 dark:border-darkbox-border"
                                                    aria-label="Nota: {{ $target->rating }}">
                                                    <span
                                                        class="text-sm font-black text-cyan-700 dark:text-cyan-400 tabular-nums"
                                                        aria-hidden="true">{{ $target->rating }}</span>
                                                    <i class="fa-solid fa-star text-xs text-cyan-500"
                                                        aria-hidden="true"></i>
                                                </div>
                                            @endif
                                        </div>

                                        @if ($target->review)
                                            <blockquote
                                                class="text-sm text-gray-700 dark:text-gray-300 italic border-l-4 border-cyan-500 pl-4 line-clamp-4">
                                                "{{ $target->review }}"
                                            </blockquote>
                                        @else
                                            <p class="text-sm font-bold text-gray-400 italic">
                                                La reseña ya está vacía.
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            {{-- ACTIONS --}}
                            <div class="lg:col-span-3 flex flex-col gap-2" aria-label="Acciones de moderación">
                                <span
                                    class="text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Acciones</span>

                                @if ($target && $isUser && $report->status === 'Pending')
                                    @if ($target->banned_at)
                                        <button type="button" wire:click="unbanUser({{ $report->id }})"
                                            wire:confirm="¿Seguro que quieres desbanear a este usuario?"
                                            class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                            <i class="fa-solid fa-unlock" aria-hidden="true"></i>
                                            Desbanear
                                        </button>
                                    @else
                                        <button type="button" wire:click="banUser({{ $report->id }})"
                                            wire:confirm="¿Seguro que quieres banear a este usuario? Esta acción es grave."
                                            class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                                            <i class="fa-solid fa-ban" aria-hidden="true"></i>
                                            Banear usuario
                                        </button>
                                    @endif

                                    <a href="{{ route('profile', $target->id) }}"
                                        class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-darkbox-main text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                        <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                        Ver perfil
                                    </a>
                                @endif

                                @if ($target && $isImage && $report->status === 'Pending')
                                    <button type="button" wire:click="deleteImage({{ $report->id }})"
                                        wire:confirm="¿Eliminar la captura reportada? Esta acción es irreversible."
                                        class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                                        <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                        Eliminar imagen
                                    </button>

                                    @if ($target->user)
                                        <a href="{{ route('profile', $target->user->id) }}"
                                            class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-darkbox-main text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                            <i class="fa-solid fa-user" aria-hidden="true"></i>
                                            Ver usuario
                                        </a>
                                    @endif
                                @endif

                                @if ($target && $isReview && $report->status === 'Pending')
                                    <button type="button" wire:click="deleteReview({{ $report->id }})"
                                        wire:confirm="¿Eliminar el contenido de esta reseña?"
                                        class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                                        <i class="fa-solid fa-eraser" aria-hidden="true"></i>
                                        Eliminar reseña
                                    </button>

                                    @if ($target->user)
                                        <a href="{{ route('profile', $target->user->id) }}"
                                            class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-darkbox-main text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                            <i class="fa-solid fa-user" aria-hidden="true"></i>
                                            Ver autor
                                        </a>
                                    @endif
                                @endif

                                @if ($report->status === 'Pending')
                                    <button type="button" wire:click="markResolved({{ $report->id }})"
                                        class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-darkbox-card text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                        <i class="fa-solid fa-check" aria-hidden="true"></i>
                                        Descartar
                                    </button>
                                @else
                                    <button type="button" wire:click="reopen({{ $report->id }})"
                                        class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-darkbox-main text-xs font-black uppercase tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                        <i class="fa-solid fa-rotate-left" aria-hidden="true"></i>
                                        Reabrir
                                    </button>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div
                        class="flex flex-col items-center justify-center p-12 text-center bg-gray-50 dark:bg-darkbox-card rounded-3xl border border-dashed border-gray-200 dark:border-darkbox-border">
                        <div
                            class="w-16 h-16 bg-gray-100 dark:bg-darkbox-main rounded-2xl flex items-center justify-center mb-4">
                            <i class="fa-solid fa-inbox text-2xl text-gray-400 dark:text-gray-500"
                                aria-hidden="true"></i>
                        </div>
                        <h3 class="text-lg font-black text-gray-900 dark:text-white mb-2">Sin reportes</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm">
                            No hay reportes que coincidan con los filtros seleccionados.
                        </p>
                    </div>
                @endforelse
            </section>
        </div>
    </x-slot>
</x-miscomponentes.page-layout>
