<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-cyan-600 hover:bg-cyan-500 text-white font-black px-6 py-3 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.3)] hover:shadow-[0_8px_20px_rgba(6,182,212,0.4)] hover:-translate-y-0.5 uppercase tracking-widest text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-[#0f1117] disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0']) }}>
    {{ $slot }}
</button>
