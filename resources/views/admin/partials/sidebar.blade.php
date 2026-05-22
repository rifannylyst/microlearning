<div class="w-64 bg-gradient-to-b from-slate-900 via-slate-950 to-slate-800 text-white flex flex-col shadow-xl">
    <div class="p-5 border-b border-slate-700">
        <div class="flex items-center gap-3 mb-3">
            <div class="mx-auto"><img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid"></div>
            <div>
                <p class="text-sm text-sky-300 uppercase tracking-[0.2em]">Micro Learning</p>
                <p class="text-base font-semibold">Admin Panel</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white shadow-inner' : 'text-white hover:bg-slate-700 hover:text-white' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.materi') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('mapel') ? 'bg-slate-700 text-white shadow-inner' : 'text-white hover:bg-slate-700 hover:text-white' }}">
            Daftar Materi
        </a>
        <a href="{{ route('admin.progress') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('pengguna') ? 'bg-slate-700 text-white shadow-inner' : 'text-white hover:bg-slate-700 hover:text-white' }}">
            Data Progres
        </a>
        <a href="{{ route('admin.pengguna') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('pengguna') ? 'bg-slate-700 text-white shadow-inner' : 'text-white hover:bg-slate-700 hover:text-white' }}">
            Data Pengguna
        </a>
    </nav>

</div>