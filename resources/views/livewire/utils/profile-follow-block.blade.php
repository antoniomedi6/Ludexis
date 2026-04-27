<div>
    {{-- FOLLOW COUNTERS --}}
    <div
        class="flex flex-wrap items-center justify-center gap-x-5 gap-y-1 text-sm font-bold text-gray-600 dark:text-gray-300 w-full">
        <button
            type="button"
            wire:click="openFollowList('followers')"
            class="tabular-nums hover:text-cyan-600 dark:hover:text-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded transition-colors"
            aria-haspopup="dialog"
            aria-expanded="{{ $showModal ? 'true' : 'false' }}"
        >
            <span class="text-gray-900 dark:text-white">{{ $followersCount }}</span>
            <span class="text-gray-500 dark:text-gray-400 font-black uppercase text-xs tracking-widest">
                &nbsp;seguidores
            </span>
        </button>

        <span class="text-gray-300 dark:text-darkbox-border" aria-hidden="true">|</span>

        <button
            type="button"
            wire:click="openFollowList('followings')"
            class="tabular-nums hover:text-cyan-600 dark:hover:text-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded transition-colors"
            aria-haspopup="dialog"
            aria-expanded="{{ $showModal ? 'true' : 'false' }}"
        >
            <span class="text-gray-900 dark:text-white">{{ $followingsCount }}</span>
            <span class="text-gray-500 dark:text-gray-400 font-black uppercase text-xs tracking-widest">
                &nbsp;seguidos
            </span>
        </button>
    </div>

    {{-- FOLLOW LISTS MODAL --}}
    @if ($showModal)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            role="dialog"
            aria-modal="true"
            aria-labelledby="follow-list-title"
            x-data="{ activeTab: @js($modalDefaultTab) }"
            x-on:keydown.escape.window="$wire.$set('showModal', false)"
        >
            <button
                type="button"
                class="absolute inset-0 bg-black/50"
                wire:click="$set('showModal', false)"
                aria-label="Cerrar"
            ></button>

            <div
                class="relative w-full max-w-md max-h-screen overflow-y-auto bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-xl p-4 sm:p-6"
            >
                <div class="flex items-start justify-between gap-3 mb-4">
                    <h2 id="follow-list-title" class="text-lg font-black text-gray-900 dark:text-white">Seguimiento</h2>
                    <button
                        type="button"
                        wire:click="$set('showModal', false)"
                        class="p-2 rounded-xl border border-gray-200 dark:border-darkbox-border bg-white dark:bg-darkbox-card hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
                        aria-label="Cerrar"
                    >
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </div>

                {{-- TABS --}}
                <div
                    class="flex rounded-xl border border-gray-200 dark:border-darkbox-border p-0.5 mb-4"
                    role="tablist"
                    aria-label="Tipo de lista"
                >
                    <button
                        type="button"
                        @click="activeTab = 'followers'"
                        role="tab"
                        id="tab-followers"
                        :aria-selected="activeTab === 'followers' ? 'true' : 'false'"
                        :class="activeTab === 'followers' ? 'bg-cyan-600 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-darkbox-main'"
                        class="flex-1 rounded-lg text-xs font-black uppercase tracking-widest py-2.5 transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
                    >
                        Seguidores
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'followings'"
                        role="tab"
                        id="tab-followings"
                        :aria-selected="activeTab === 'followings' ? 'true' : 'false'"
                        :class="activeTab === 'followings' ? 'bg-cyan-600 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-darkbox-main'"
                        class="flex-1 rounded-lg text-xs font-black uppercase tracking-widest py-2.5 transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
                    >
                        Siguiendo
                    </button>
                </div>

                {{-- FOLLOWERS --}}
                <div
                    x-show="activeTab === 'followers'"
                    x-cloak
                    x-transition
                    id="panel-followers"
                    role="tabpanel"
                    aria-labelledby="tab-followers"
                    wire:key="panel-followers-{{ $userId }}"
                >
                    <ul class="space-y-2 list-none p-0 m-0">
                        @forelse ($followersList as $follower)
                            <li
                                class="flex items-center justify-between gap-2 p-2 rounded-xl border border-transparent hover:border-gray-200 dark:hover:border-darkbox-border hover:bg-gray-50 dark:hover:bg-darkbox-main"
                                wire:key="fl-{{ $follower->id }}"
                            >
                                <a
                                    href="{{ route('profile', ['userId' => $follower->id]) }}"
                                    class="flex min-w-0 flex-1 items-center gap-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded-xl"
                                    wire:navigate
                                >
                                    <img
                                        src="{{ $follower->profile_photo_url }}"
                                        alt="Avatar de {{ $follower->name }}"
                                        class="h-10 w-10 shrink-0 rounded-full object-cover border border-gray-200 dark:border-darkbox-border bg-gray-100 dark:bg-darkbox-main"
                                    />
                                    <span class="truncate font-bold text-sm text-gray-900 dark:text-white">{{ $follower->name }}</span>
                                </a>
                                <div class="shrink-0">
                                    @livewire('utils.follow-button', [
                                        'user' => $follower,
                                        'compact' => true,
                                    ], key('fb-follower-' . $follower->id))
                                </div>
                            </li>
                        @empty
                            <li class="text-sm text-center text-gray-500 dark:text-gray-400 py-6">No hay seguidores aún.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- FOLLOWINGS --}}
                <div
                    x-show="activeTab === 'followings'"
                    x-cloak
                    x-transition
                    id="panel-followings"
                    role="tabpanel"
                    aria-labelledby="tab-followings"
                    wire:key="panel-followings-{{ $userId }}"
                >
                    <ul class="space-y-2 list-none p-0 m-0">
                        @forelse ($followingsList as $followedUser)
                            <li
                                class="flex items-center justify-between gap-2 p-2 rounded-xl border border-transparent hover:border-gray-200 dark:hover:border-darkbox-border hover:bg-gray-50 dark:hover:bg-darkbox-main"
                                wire:key="fw-{{ $followedUser->id }}"
                            >
                                <a
                                    href="{{ route('profile', ['userId' => $followedUser->id]) }}"
                                    class="flex min-w-0 flex-1 items-center gap-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded-xl"
                                    wire:navigate
                                >
                                    <img
                                        src="{{ $followedUser->profile_photo_url }}"
                                        alt="Avatar de {{ $followedUser->name }}"
                                        class="h-10 w-10 shrink-0 rounded-full object-cover border border-gray-200 dark:border-darkbox-border bg-gray-100 dark:bg-darkbox-main"
                                    />
                                    <span class="truncate font-bold text-sm text-gray-900 dark:text-white">{{ $followedUser->name }}</span>
                                </a>
                                <div class="shrink-0">
                                    @livewire('utils.follow-button', [
                                        'user' => $followedUser,
                                        'compact' => true,
                                    ], key('fb-following-' . $followedUser->id))
                                </div>
                            </li>
                        @empty
                            <li class="text-sm text-center text-gray-500 dark:text-gray-400 py-6">No sigue a nadie aún.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

