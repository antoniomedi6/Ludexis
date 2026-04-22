<x-app-layout>
    <x-miscomponentes.page-layout title1="Configuración" title2="de Cuenta"
        subtitle="Gestiona tu información, privacidad y seguridad." :fullWidth="false">
        <div class="space-y-10 sm:space-y-16 pb-12 mt-6">

            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-privacy-form')
            </div>
            <x-section-border />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>
                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>
                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif

        </div>
    </x-miscomponentes.page-layout>
</x-app-layout>
