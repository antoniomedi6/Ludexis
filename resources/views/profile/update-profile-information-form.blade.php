<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <span class="text-gray-900 dark:text-white font-black">{{ __('Información del Perfil') }}</span>
    </x-slot>

    <x-slot name="description">
        <span
            class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Actualiza la información del perfil y la dirección de correo electrónico de tu cuenta.') }}</span>
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

                <label for="photo"
                    class="block text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4">
                    {{ __('Foto') }}
                </label>

                <div class="flex items-center gap-6">
                    <div x-show="! photoPreview" class="shrink-0 relative">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                            class="rounded-[1.5rem] size-24 object-cover border-2 border-white dark:border-darkbox-card shadow-md bg-gray-100 dark:bg-darkbox-main">
                    </div>

                    <div x-show="photoPreview" style="display: none;" class="shrink-0 relative">
                        <span
                            class="block rounded-[1.5rem] size-24 bg-cover bg-no-repeat bg-center border-2 border-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <div class="flex flex-col gap-2">
                        <button type="button" x-on:click.prevent="$refs.photo.click()"
                            class="bg-gray-100 dark:bg-darkbox-card hover:bg-gray-200 dark:hover:bg-darkbox-main text-gray-900 dark:text-white font-bold py-2.5 px-4 rounded-xl text-xs uppercase tracking-widest transition-colors border border-gray-200 dark:border-darkbox-border focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <i class="fa-solid fa-camera mr-2" aria-hidden="true"></i>
                            {{ __('Seleccionar Nueva Foto') }}
                        </button>

                        @if ($this->user->profile_photo_path)
                            <button type="button" wire:click="deleteProfilePhoto"
                                class="text-red-500 hover:text-red-400 text-xs font-bold uppercase tracking-widest transition-colors text-left px-2 focus:outline-none focus:underline">
                                {{ __('Eliminar Foto') }}
                            </button>
                        @endif
                    </div>
                </div>

                <x-input-error for="photo" class="mt-2 text-red-500 text-xs font-bold" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4 mb-2">
            <label for="name"
                class="block text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">
                {{ __('Nombre') }}
            </label>
            <div class="relative">
                <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                    aria-hidden="true"></i>
                <x-input id="name" type="text"
                    class="block w-full bg-gray-50 dark:bg-darkbox-main border-gray-200 dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                    wire:model="state.name" required autocomplete="name" />
            </div>
            <x-input-error for="name" class="mt-2 text-red-500 text-xs font-bold" />
        </div>

        <div class="col-span-6 sm:col-span-4"
            @if (!$this->user->hasOfficialEmail()) x-data x-init="$wire.set('state.email', '')" @endif>
            <label for="email"
                class="block text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">
                {{ __('Correo Electrónico') }}
            </label>
            <div class="relative">
                <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                    aria-hidden="true"></i>
                <x-input id="email" type="email"
                    class="block w-full bg-gray-50 dark:bg-darkbox-main border-gray-200 dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                    wire:model="state.email" required
                    autocomplete="{{ $this->user->hasOfficialEmail() ? 'username' : 'off' }}" autocapitalize="none"
                    autocorrect="off" spellcheck="false" />
            </div>
            <x-input-error for="email" class="mt-2 text-red-500 text-xs font-bold" />

            @if (
                $this->user->hasOfficialEmail() &&
                    Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-4">
                    {{ __('Tu dirección de correo electrónico no está verificada.') }}

                    <button type="button"
                        class="text-[10px] font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-widest hover:text-cyan-500 dark:hover:text-cyan-300 ml-1 underline focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-black text-[10px] uppercase tracking-widest text-emerald-500">
                        {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-4 text-emerald-500 font-bold text-sm" on="saved">
            <div class="flex items-center">
                <i class="fa-solid fa-check mr-1" aria-hidden="true"></i> {{ __('Guardado.') }}
            </div>
        </x-action-message>

        <button wire:loading.attr="disabled" wire:target="photo" type="submit"
            class="inline-flex items-center justify-center px-6 py-3 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-[0_0_15px_rgba(8,145,178,0.2)] hover:shadow-[0_0_25px_rgba(8,145,178,0.4)] focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-darkbox-card disabled:opacity-50">
            <i class="fa-solid fa-floppy-disk mr-2" aria-hidden="true"></i> {{ __('Guardar') }}
        </button>
    </x-slot>
</x-form-section>
