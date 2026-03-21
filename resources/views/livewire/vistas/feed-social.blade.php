<div class="bg-[#0f1117] text-white font-sans h-screen flex overflow-hidden selection:bg-cyan-500 selection:text-black">
    <div
        class="absolute top-0 left-1/4 w-[50vw] h-[50vh] bg-cyan-900/20 blur-[150px] rounded-full pointer-events-none z-0">
    </div>

    <div class="flex-1 flex flex-col h-full relative z-10">
        <header
            class="h-20 flex items-center justify-between px-8 shrink-0 z-20 bg-[#0f1117]/80 backdrop-blur-md border-b border-gray-800">
            <div class="flex-1 max-w-2xl relative group">
                @livewire('utils.search-games')
            </div>

            <div class="flex items-center gap-4 pl-4">
                <button
                    class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#1a1d27] transition relative bg-[#151821]">
                    <i class="fa-regular fa-bell"></i>
                    <span
                        class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-cyan-500 border-2 border-[#151821]"></span>
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto px-4 md:px-8 py-8 relative hide-scrollbar">
            <div class="max-w-[1400px] mx-auto grid grid-cols-1 xl:grid-cols-12 gap-10">

                <div class="xl:col-span-8 flex flex-col gap-8">

                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-2">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tighter mb-2">
                                Ludexis <span class="text-cyan-500">Feed</span>
                            </h1>
                            <p class="text-gray-400 font-medium text-sm">
                                Descubre a qué están jugando tus amigos y comparte tus momentos.
                            </p>
                        </div>

                        <div class="flex gap-2 bg-[#151821] border border-gray-800 rounded-xl p-1 shrink-0">
                            <button
                                class="px-5 py-2.5 rounded-lg bg-[#1a1d27] text-cyan-400 font-black text-xs uppercase tracking-widest shadow">
                                Global
                            </button>
                            <button
                                class="px-5 py-2.5 rounded-lg text-gray-500 hover:text-white font-black text-xs uppercase tracking-widest transition">
                                Siguiendo
                            </button>
                        </div>
                    </div>

                    <div
                        class="bg-[#151821]/80 backdrop-blur-xl border border-gray-800 rounded-[2rem] p-6 shadow-xl flex flex-col gap-4">
                        <div class="flex gap-4 items-start">
                            <div
                                class="w-12 h-12 bg-gradient-to-tr from-cyan-600 to-teal-600 rounded-2xl flex justify-center items-center font-black shadow-lg border border-gray-700 text-white shrink-0">
                                A
                            </div>
                            <textarea placeholder="Comparte una captura, una opinión o un nuevo descubrimiento..."
                                class="w-full bg-transparent text-white placeholder-gray-500 text-lg resize-none focus:outline-none h-14 hide-scrollbar pt-2"></textarea>
                        </div>
                        <div class="w-full h-px bg-gray-800/80"></div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2">
                                <button
                                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-gray-400 hover:text-cyan-400 hover:bg-cyan-900/20 font-bold text-xs uppercase tracking-widest transition">
                                    <i class="fa-solid fa-gamepad"></i> Vincular Juego
                                </button>
                                <button
                                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-gray-400 hover:text-purple-400 hover:bg-purple-900/20 font-bold text-xs uppercase tracking-widest transition">
                                    <i class="fa-regular fa-image"></i> Media
                                </button>
                            </div>
                            <button
                                class="bg-cyan-600 hover:bg-cyan-500 text-white font-black px-8 py-3 rounded-xl transition shadow-[0_0_15px_rgba(6,182,212,0.3)] uppercase tracking-widest text-xs">
                                Publicar
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col gap-8">

                        <article
                            class="bg-[#151821]/80 backdrop-blur-xl border border-gray-800 rounded-[2rem] overflow-hidden shadow-xl hover:border-gray-700 transition-colors flex flex-col">
                            <div class="p-6 flex items-start gap-4">
                                <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co2lbd.jpg"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-[#1a1d27] shadow-lg shrink-0" />
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3
                                            class="text-base font-bold text-white hover:text-cyan-400 cursor-pointer transition">
                                            Sara_Gamer</h3>
                                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Hace
                                            1h</span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-3">
                                        <span
                                            class="text-[10px] bg-purple-900/30 text-purple-400 border border-purple-500/30 px-2 py-0.5 rounded-md font-bold uppercase tracking-widest">
                                            Captura
                                        </span>
                                        <span class="text-xs text-gray-400 font-medium flex items-center gap-1">
                                            jugando a <strong
                                                class="text-white cursor-pointer hover:text-cyan-400">Cyberpunk
                                                2077</strong>
                                        </span>
                                    </div>
                                    <p class="text-gray-300 text-sm leading-relaxed mb-4">
                                        Night City de noche sigue siendo insuperable. El modo foto de este juego es una
                                        trampa mortal para mi tiempo libre. 📸✨
                                    </p>
                                    <div class="grid grid-cols-2 gap-2 rounded-xl overflow-hidden mb-4">
                                        <img src="https://images.igdb.com/igdb/image/upload/t_1080p/sc6qon.jpg"
                                            class="w-full h-48 object-cover hover:scale-105 transition duration-500 cursor-pointer" />
                                        <img src="https://images.igdb.com/igdb/image/upload/t_1080p/sc8c26.jpg"
                                            class="w-full h-48 object-cover hover:scale-105 transition duration-500 cursor-pointer" />
                                    </div>
                                    <div class="flex items-center gap-6 pt-4 border-t border-gray-800/50">
                                        <button
                                            class="flex items-center gap-2 text-gray-500 hover:text-red-400 transition font-black text-xs uppercase tracking-widest">
                                            <i class="fa-solid fa-heart"></i> 256
                                        </button>
                                        <button
                                            class="flex items-center gap-2 text-gray-500 hover:text-cyan-400 transition font-black text-xs uppercase tracking-widest">
                                            <i class="fa-solid fa-comment"></i> 45
                                        </button>
                                        <button
                                            class="flex items-center gap-2 text-gray-500 hover:text-white transition font-black text-xs uppercase tracking-widest ml-auto">
                                            <i class="fa-solid fa-share-nodes"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article
                            class="bg-[#151821]/80 backdrop-blur-xl border border-gray-800 rounded-[2rem] overflow-hidden shadow-xl hover:border-gray-700 transition-colors">
                            <div class="p-6 flex items-start gap-4">
                                <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co1r7f.jpg"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-[#1a1d27] shadow-lg shrink-0" />
                                <div class="flex-1 flex flex-col">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3
                                            class="text-base font-bold text-white hover:text-cyan-400 cursor-pointer transition">
                                            Alex99</h3>
                                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Hace
                                            3h</span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-4">
                                        <span
                                            class="text-[10px] bg-cyan-900/30 text-cyan-400 border border-cyan-500/30 px-2 py-0.5 rounded-md font-bold uppercase tracking-widest">
                                            Reseña
                                        </span>
                                    </div>

                                    <div
                                        class="bg-[#0f1117] border border-gray-800 rounded-3xl p-5 mb-4 flex flex-col sm:flex-row gap-5 hover:border-gray-700 transition cursor-pointer">
                                        <img src="https://images.igdb.com/igdb/image/upload/t_1080p/co1q1f.jpg"
                                            class="w-full sm:w-24 h-48 sm:h-36 object-cover rounded-xl shadow-lg shrink-0" />
                                        <div class="flex flex-col justify-center">
                                            <div class="flex justify-between items-start mb-2">
                                                <h4 class="text-xl font-black text-white leading-tight">Red Dead
                                                    Redemption 2</h4>
                                                <div
                                                    class="flex text-yellow-400 text-xs bg-[#151821] px-2 py-1 rounded border border-gray-800 shrink-0">
                                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                        class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-400 italic line-clamp-3">
                                                "Nunca había sentido un mundo tan vivo y unos personajes tan bien
                                                escritos. La historia de Arthur Morgan es algo que todos deberían
                                                experimentar. Insuperable en todos los aspectos técnicos y narrativos."
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-6 pt-2">
                                        <button
                                            class="flex items-center gap-2 text-red-500 transition font-black text-xs uppercase tracking-widest">
                                            <i class="fa-solid fa-heart"></i> 142
                                        </button>
                                        <button
                                            class="flex items-center gap-2 text-gray-500 hover:text-cyan-400 transition font-black text-xs uppercase tracking-widest">
                                            <i class="fa-solid fa-comment"></i> 12
                                        </button>
                                        <button
                                            class="flex items-center gap-2 text-gray-500 hover:text-white transition font-black text-xs uppercase tracking-widest ml-auto">
                                            <i class="fa-solid fa-share-nodes"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>

                <div class="xl:col-span-4 flex flex-col gap-8">

                    <div
                        class="bg-[#151821]/80 backdrop-blur-2xl border border-gray-800 rounded-[2.5rem] p-8 shadow-2xl">
                        <h2
                            class="text-sm font-black text-white uppercase tracking-widest mb-6 flex items-center gap-3">
                            <i class="fa-solid fa-fire text-orange-500"></i> Tendencias
                        </h2>
                        <div class="flex flex-col gap-4">
                            <div
                                class="flex items-center gap-4 cursor-pointer group bg-[#0f1117] p-3 rounded-2xl border border-gray-800/50">
                                <span
                                    class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-b from-yellow-400 to-yellow-600 w-6 text-center">1</span>
                                <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co889o.jpg"
                                    class="w-10 h-14 object-cover rounded shadow border border-gray-700" />
                                <div class="flex-1 overflow-hidden">
                                    <h4
                                        class="text-sm font-bold text-white group-hover:text-cyan-400 transition truncate">
                                        Hollow Knight: Silksong</h4>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">12.5K
                                        Menciones</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-4 cursor-pointer group p-3 rounded-2xl hover:bg-[#0f1117] transition">
                                <span class="text-lg font-black text-gray-500 w-6 text-center">2</span>
                                <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co670h.jpg"
                                    class="w-10 h-14 object-cover rounded shadow border border-gray-700" />
                                <div class="flex-1 overflow-hidden">
                                    <h4
                                        class="text-sm font-bold text-gray-300 group-hover:text-cyan-400 transition truncate">
                                        GTA VI</h4>
                                    <p class="text-[10px] text-gray-600 font-bold uppercase tracking-wider">8.2K
                                        Menciones</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-[#151821]/80 backdrop-blur-2xl border border-gray-800 rounded-[2.5rem] p-8 shadow-2xl sticky top-4">
                        <h2
                            class="text-sm font-black text-white uppercase tracking-widest mb-6 flex items-center gap-3">
                            <i class="fa-solid fa-user-plus text-cyan-500"></i> A quién seguir
                        </h2>
                        <div class="flex flex-col gap-6">
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-3 cursor-pointer">
                                    <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co1tmu.jpg"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-transparent group-hover:border-cyan-500 transition-colors" />
                                    <div>
                                        <h4 class="text-sm font-bold text-white group-hover:text-cyan-400 transition">
                                            RPG_Master</h4>
                                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Afín a
                                            tus gustos</p>
                                    </div>
                                </div>
                                <button
                                    class="w-8 h-8 rounded-full bg-[#1a1d27] border border-gray-700 text-gray-400 hover:text-cyan-400 hover:border-cyan-500 transition flex items-center justify-center">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-3 cursor-pointer">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center font-black text-white border-2 border-transparent group-hover:border-cyan-500 transition-colors">
                                        D
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-white group-hover:text-cyan-400 transition">
                                            DoomSlayer99</h4>
                                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Juega a
                                            Shooters</p>
                                    </div>
                                </div>
                                <button
                                    class="w-8 h-8 rounded-full bg-[#1a1d27] border border-gray-700 text-gray-400 hover:text-cyan-400 hover:border-cyan-500 transition flex items-center justify-center">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>
