<aside class="w-64 bg-slate-900 text-slate-400 flex flex-col border-r border-slate-950 shadow-xl min-h-screen">

    {{-- Logo --}}
    <div class="px-6 border-b border-slate-800/60 flex items-center h-[76px]">
        <div class="flex items-center gap-3">
            <img
                src="{{ asset('logo.jpg') }}"
                alt="Logo"
                class="w-10 h-10 rounded-xl object-cover border border-slate-850">
            <div class="flex flex-col justify-center">
                <h2 class="font-extrabold text-white text-base tracking-tight leading-none mb-1">
                    MicroLearn
                </h2>
                <p class="text-[10px] text-blue-400 font-semibold uppercase tracking-wider m-0 leading-none">
                    Admin Area
                </p>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 p-4 space-y-1.5 mt-4">
        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10 font-semibold' : 'hover:bg-slate-800/60 hover:text-white text-slate-400' }}">
            <i class="bi bi-speedometer2 text-base"></i>
            <span>Dashboard</span>
        </a>

        {{-- Materi --}}
        <a href="{{ route('admin.materi') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('admin.materi') || request()->routeIs('admin.materi.*') || request()->routeIs('admin.quiz.*') || request()->routeIs('admin.pertanyaan.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10 font-semibold' : 'hover:bg-slate-800/60 hover:text-white text-slate-400' }}">
            <i class="bi bi-book text-base"></i>
            <span>Materi</span>
        </a>

        {{-- Progress --}}
        <a href="{{ route('admin.progress') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('admin.progress') || request()->routeIs('admin.progress.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10 font-semibold' : 'hover:bg-slate-800/60 hover:text-white text-slate-400' }}">
            <i class="bi bi-graph-up text-base"></i>
            <span>Progress</span>
        </a>

        {{-- Evaluasi --}}
        <a href="{{ route('admin.evaluasi') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('admin.evaluasi') || request()->routeIs('admin.evaluasi.*') || request()->routeIs('siswa.evaluasi.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10 font-semibold' : 'hover:bg-slate-800/60 hover:text-white text-slate-400' }}">
            <i class="bi bi-clipboard-check text-base"></i>
            <span>Evaluasi</span>
        </a>

        {{-- Pengguna --}}
        <a href="{{ route('admin.pengguna') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('admin.pengguna') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10 font-semibold' : 'hover:bg-slate-800/60 hover:text-white text-slate-400' }}">
            <i class="bi bi-people text-base"></i>
            <span>Pengguna</span>
        </a>
    </nav>

    {{-- Sidebar Footer/Back link --}}
    <div class="p-4 border-t border-slate-800/60">
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-slate-800/60 hover:text-white text-xs font-semibold text-slate-500 transition-all duration-200 no-underline">
            <i class="bi bi-arrow-left-circle text-base"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

</aside>