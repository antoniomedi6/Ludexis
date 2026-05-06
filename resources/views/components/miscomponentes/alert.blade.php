<div x-data="{
    show: false,
    message: '',
    type: 'success',
    showToast(event) {
        this.message = event.detail.message;
        this.type = event.detail.type || 'success';
        this.show = true;
        setTimeout(() => { this.show = false }, 4000);
    }
}" @notify.window="showToast($event)"
    class="fixed top-5 right-5 z-[100] flex flex-col gap-2 w-full max-w-xs" x-cloak>

    <template x-if="show">
        <div x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:translate-x-4"
            x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="relative p-4 rounded-2xl shadow-2xl border backdrop-blur-xl flex items-center gap-3 transition-colors duration-300"
            :class="{
                'bg-lightbox-card/90 dark:bg-darkbox-card/90 border-cyan-500/50 text-gray-900 dark:text-white': type === 'success',
                'bg-lightbox-card/90 dark:bg-darkbox-card/90 border-red-500/50 text-gray-900 dark:text-white': type === 'error'
            }">

            <div class="flex-shrink-0">
                <template x-if="type === 'success'">
                    <div class="bg-cyan-500/20 p-2 rounded-xl">
                        <x-icons.saved-animated class="size-5 text-cyan-500" />
                    </div>
                </template>
                <template x-if="type === 'error'">
                    <div class="bg-red-500/20 p-2 rounded-xl">
                        <i class="fa-solid fa-circle-exclamation text-red-500 text-lg"></i>
                    </div>
                </template>
            </div>

            <div class="flex-1 text-sm font-black tracking-tight uppercase" x-text="message"></div>

            <button @click="show = false"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="absolute bottom-0 left-0 h-1 bg-cyan-500/30 rounded-full transition-all duration-[4000ms] ease-linear w-full"
                :class="show ? 'w-full' : 'w-0'"></div>
        </div>
    </template>
</div>
