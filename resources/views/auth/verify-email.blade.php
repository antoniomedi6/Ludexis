<x-guest-layout>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 dark:bg-[#0f1117] transition-colors duration-300">
        <div
            class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 shadow-xl overflow-hidden rounded-[2rem] transition-colors duration-300 text-center">

            <div
                class="w-20 h-20 mx-auto bg-cyan-50 dark:bg-cyan-900/30 rounded-full flex items-center justify-center mb-6 border border-cyan-100 dark:border-cyan-800/50">
                <i class="fa-solid fa-envelope-open-text text-3xl text-cyan-600 dark:text-cyan-500"></i>
            </div>

            <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight mb-4">
                Verifica tu correo
            </h2>

            <div class="mb-6 text-sm text-gray-600 dark:text-gray-400 font-medium">
                {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div
                    class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800/50 text-sm font-bold text-green-600 dark:text-green-400 transition-colors duration-300">
                    {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                </div>
            @endif

            <div class="mt-8 flex flex-col gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-black py-3.5 rounded-xl text-xs uppercase tracking-widest transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.3)] hover:shadow-[0_8px_20px_rgba(6,182,212,0.4)] hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i> {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <div
                    class="flex items-center justify-center mt-4 pt-4 border-t border-gray-100 dark:border-gray-800 transition-colors duration-300">
                    {{--                     <a href="{{ route('profile.show') }}"
                        class="text-xs font-bold text-gray-500 hover:text-cyan-600 dark:hover:text-cyan-400 uppercase tracking-wider transition-colors duration-300">
                        {{ __('Edit Profile') }}
                    </a> --}}

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-xs bg-red-700 hover:bg-red-900 p-3 rounded-lg font-bold text-gray-300 hover:text-red-600 dark:hover:text-white uppercase tracking-wider transition-colors duration-300">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
