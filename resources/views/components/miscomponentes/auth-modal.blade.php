<div x-data="{ open: false, isLogin: true }" @open-auth-modal.window="open = true; isLogin = $event.detail.login"
    @keydown.escape.window="open = false" x-show="open"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-0" style="display: none;">

    <div x-show="open" x-transition.opacity @click="open = false"
        class="absolute inset-0 bg-gray-900/40 dark:bg-black/60 backdrop-blur-md transition-colors duration-300">
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-90 translate-y-4"
        class="relative z-10 w-full max-w-lg bg-lightbox-card/95 dark:bg-darkbox-card/95 backdrop-blur-2xl border border-lightbox-border dark:border-darkbox-border rounded-[2rem] shadow-2xl dark:shadow-[0_20px_60px_rgba(0,0,0,0.8)] p-8 sm:p-10 overflow-hidden transition-colors duration-300">

        <button @click="open = false"
            class="absolute top-6 right-6 text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-300 z-20">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>

        <div class="text-center mb-6">
            <div
                class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter drop-shadow-sm dark:drop-shadow-lg inline-block mb-2 transition-colors duration-300">
                <x-miscomponentes.application-logo-name />
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium transition-colors duration-300"
                x-text="isLogin ? 'Bienvenido de nuevo.' : 'Únete a la nueva generación de jugadores.'"></p>
        </div>

        <div
            class="flex bg-lightbox-soft dark:bg-darkbox-main rounded-xl p-1 mb-6 border border-lightbox-border dark:border-darkbox-border transition-colors duration-300">
            <button @click="isLogin = true"
                :class="isLogin ? 'bg-lightbox-card dark:bg-darkbox-card text-cyan-600 dark:text-cyan-400 shadow-sm' :
                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                class="flex-1 py-2 text-sm font-black uppercase tracking-widest rounded-lg transition-all duration-300">
                Acceder
            </button>
            <button @click="isLogin = false"
                :class="!isLogin ? 'bg-lightbox-card dark:bg-darkbox-card text-cyan-600 dark:text-cyan-400 shadow-sm' :
                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                class="flex-1 py-2 text-sm font-black uppercase tracking-widest rounded-lg transition-all duration-300">
                Registro
            </button>
        </div>

        <x-validation-errors class="mb-4" />

        <form x-show="isLogin" method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
            @csrf

            <div class="relative">
                <i
                    class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm transition-colors duration-300"></i>
                <x-input id="login_email"
                    class="w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-10 pr-4 py-3 text-sm font-medium focus:border-cyan-500 focus:ring-cyan-500 transition-colors duration-300 placeholder-gray-400 dark:placeholder-gray-600 shadow-inner"
                    type="email" name="email" :value="old('email')" required autofocus
                    placeholder="{{ __('Email') }}" />
            </div>

            <div class="relative">
                <i
                    class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm transition-colors duration-300"></i>
                <x-input id="login_password"
                    class="w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-10 pr-10 py-3 text-sm font-medium focus:border-cyan-500 focus:ring-cyan-500 transition-colors duration-300 placeholder-gray-400 dark:placeholder-gray-600 shadow-inner"
                    type="password" name="password" required placeholder="{{ __('Password') }}" />
            </div>

            <div class="flex items-center justify-between mt-2">
                <label for="remember_me" class="flex items-center cursor-pointer group">
                    <x-checkbox id="remember_me" name="remember"
                        class="bg-lightbox-main dark:bg-darkbox-main border-gray-300 dark:border-gray-700 text-cyan-600 dark:text-cyan-500 focus:ring-cyan-500 rounded cursor-pointer transition-colors duration-300" />
                    <span
                        class="ms-2 text-xs text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors duration-300">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs text-cyan-600 dark:text-cyan-400 font-bold hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors duration-300"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-black py-4 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] mt-2 uppercase tracking-wider text-sm flex items-center justify-center gap-2 hover:-translate-y-1">
                Acceder <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <form x-show="!isLogin" method="POST" action="{{ route('register') }}" class="flex flex-col gap-4"
            style="display: none;">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="relative">
                    <i
                        class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm transition-colors duration-300"></i>
                    <x-input id="name"
                        class="w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-10 pr-4 py-3 text-sm font-medium focus:border-cyan-500 focus:ring-cyan-500 transition-colors duration-300 placeholder-gray-400 dark:placeholder-gray-600 shadow-inner"
                        type="text" name="name" :value="old('name')" required autocomplete="name"
                        placeholder="{{ __('Name') }}" />
                </div>
                <div class="relative">
                    <i
                        class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm transition-colors duration-300"></i>
                    <x-input id="register_email"
                        class="w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-10 pr-4 py-3 text-sm font-medium focus:border-cyan-500 focus:ring-cyan-500 transition-colors duration-300 placeholder-gray-400 dark:placeholder-gray-600 shadow-inner"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="{{ __('Email') }}" />
                </div>
            </div>

            <div class="relative">
                <i
                    class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm transition-colors duration-300"></i>
                <x-input id="register_password"
                    class="w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-10 pr-10 py-3 text-sm font-medium focus:border-cyan-500 focus:ring-cyan-500 transition-colors duration-300 placeholder-gray-400 dark:placeholder-gray-600 shadow-inner"
                    type="password" name="password" required autocomplete="new-password"
                    placeholder="{{ __('Password') }}" />
            </div>

            <div class="relative">
                <i
                    class="fa-solid fa-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm transition-colors duration-300"></i>
                <x-input id="password_confirmation"
                    class="w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-10 pr-4 py-3 text-sm font-medium focus:border-cyan-500 focus:ring-cyan-500 transition-colors duration-300 placeholder-gray-400 dark:placeholder-gray-600 shadow-inner"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="{{ __('Confirm Password') }}" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-2">
                    <label for="terms" class="flex items-start cursor-pointer group">
                        <x-checkbox name="terms" id="terms"
                            class="mt-1 bg-lightbox-main dark:bg-darkbox-main border-gray-300 dark:border-gray-700 text-cyan-600 dark:text-cyan-500 focus:ring-cyan-500 rounded cursor-pointer transition-colors duration-300"
                            required />
                        <div
                            class="ms-2 text-xs text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 leading-relaxed transition-colors duration-300">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' =>
                                    '<a target="_blank" href="' .
                                    route('terms.show') .
                                    '" class="text-cyan-600 dark:text-cyan-400 font-bold hover:text-cyan-700 dark:hover:text-cyan-300 hover:underline transition-colors duration-300">' .
                                    __('Terms of Service') .
                                    '</a>',
                                'privacy_policy' =>
                                    '<a target="_blank" href="' .
                                    route('policy.show') .
                                    '" class="text-cyan-600 dark:text-cyan-400 font-bold hover:text-cyan-700 dark:hover:text-cyan-300 hover:underline transition-colors duration-300">' .
                                    __('Privacy Policy') .
                                    '</a>',
                            ]) !!}
                        </div>
                    </label>
                </div>
            @endif

            <button type="submit"
                class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-black py-4 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] mt-2 uppercase tracking-wider text-sm flex items-center justify-center gap-2 hover:-translate-y-1">
                Registrarse <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
    </div>
</div>
