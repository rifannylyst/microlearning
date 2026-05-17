<div class="bg-gradient-to-r from-slate-800 via-slate-900 to-indigo-700 text-white shadow-lg p-5 rounded-b-3xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-xs uppercase tracking-[0.3em] text-sky-300 mb-1">Microlearning</h1>
            <p class="text-sm text-slate-200 mt-1">Pantau semua aktivitas dan konten dalam satu tempat.</p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
            <form action="#" method="GET" class="relative block w-full sm:w-80">
                <span class="sr-only">Search</span>
                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.415l4.387 4.386a1 1 0 01-1.414 1.415l-4.387-4.386zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                    </svg>
                </span>
                <input type="search" name="search" placeholder="Cari konten, kuis, atau topik..." value="{{ request('search') }}" class="w-full rounded-full border border-white/20 bg-white text-slate-900 py-2 pl-10 pr-4 text-sm shadow-sm focus:border-sky-300 focus:outline-none focus:ring-2 focus:ring-sky-300/50">
            </form>

            <div class="relative">
                <div id="userToggle" class="flex items-center gap-3 rounded-full border border-white/15 bg-white/10 px-3 py-2 backdrop-blur-sm cursor-pointer" onclick="toggleUserMenu(event)">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-sky-300 text-slate-950 font-semibold">{{ strtoupper(substr(auth()->user()?->name ?? 'G', 0, 2)) }}</div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium">{{ auth()->user()?->name ?? 'Guest' }}</p>
                        <p class="text-xs text-slate-300">Selamat datang kembali</p>
                    </div>
                </div>

                @auth
                <div id="userMenu" class="absolute right-0 mt-2 hidden w-36 rounded-2xl border border-white/10 bg-slate-950/95 p-3 shadow-xl backdrop-blur-xl">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-slate-800 px-3 py-2 text-xs font-semibold text-white hover:bg-slate-700 transition">Logout</button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
    function toggleUserMenu(event) {
        event.stopPropagation();
        const menu = document.getElementById('userMenu');
        if (!menu) return;
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function (event) {
        const menu = document.getElementById('userMenu');
        const toggle = document.getElementById('userToggle');
        if (!menu || !toggle) return;
        if (!toggle.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>