<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <span class="text-white font-black text-xl tracking-tighter">{{ __('Profile Information') }}</span>
    </x-slot>

    <x-slot name="description">
        <span
            class="text-gray-400 text-sm">{{ __('Update your account\'s profile information and email address.') }}</span>
    </x-slot>

    <x-slot name="form">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4 mb-4">
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <label for="photo" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-4">
                    {{ __('Photo') }}
                </label>

                <div class="flex items-center gap-6">
                    <div x-show="! photoPreview" class="shrink-0 relative">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                            class="rounded-[1.5rem] size-24 object-cover border-2 border-gray-800 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                    </div>

                    <div x-show="photoPreview" style="display: none;" class="shrink-0 relative">
                        <span
                            class="block rounded-[1.5rem] size-24 bg-cover bg-no-repeat bg-center border-2 border-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <div class="flex flex-col gap-2">
                        <button type="button" x-on:click.prevent="$refs.photo.click()"
                            class="bg-[#1a1d27] hover:bg-gray-800 text-white font-bold py-2.5 px-4 rounded-xl text-xs uppercase tracking-widest transition-colors border border-gray-700">
                            <i class="fa-solid fa-camera mr-2"></i> {{ __('Select A New Photo') }}
                        </button>

                        @if ($this->user->profile_photo_path)
                            <button type="button" wire:click="deleteProfilePhoto"
                                class="text-red-500 hover:text-red-400 text-xs font-bold uppercase tracking-widest transition-colors text-left px-2">
                                {{ __('Remove Photo') }}
                            </button>
                        @endif
                    </div>
                </div>

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4 mb-2">
            <label for="name" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">
                {{ __('Name') }}
            </label>
            <input id="name" type="text"
                class="w-full bg-[#0f1117] border border-gray-800 text-white rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors shadow-inner block"
                wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <label for="email" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">
                {{ __('Email') }}
            </label>
            <input id="email" type="email"
                class="w-full bg-[#0f1117] border border-gray-800 text-white rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors shadow-inner block"
                wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm text-gray-400 mt-4">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="text-[10px] font-bold text-cyan-400 uppercase tracking-widest hover:text-cyan-300 ml-2 underline"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-black text-[10px] uppercase tracking-widest text-green-500">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-cyan-500 font-bold text-sm" on="saved">
            <i class="fa-solid fa-check mr-1"></i> {{ __('Saved.') }}
        </x-action-message>

        <button wire:loading.attr="disabled" wire:target="photo" type="submit"
            class="bg-cyan-600 hover:bg-cyan-500 text-white font-black px-8 py-3 rounded-xl transition shadow-[0_0_20px_rgba(6,182,212,0.3)] uppercase tracking-widest text-xs flex items-center gap-2 disabled:opacity-50">
            <i class="fa-solid fa-floppy-disk text-lg"></i> {{ __('Save') }}
        </button>
    </x-slot>
</x-form-section>
