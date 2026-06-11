    <aside class="w-72 bg-slate-900 text-white flex flex-col shadow-lg">

    {{-- Logo --}}
    <div class="p-5 ">

        <div class="flex items-center gap-3">

            <img
                src="{{ asset('logo.jpg') }}"
                alt="Logo"
                class="w-12 h-12 object-contain">

            <div>
                <h2 class="font-bold text-lg">
                    MicroLearn
                </h2>

                <p class="text-xs text-slate-400">
                    Admin Panel
                </p>
            </div>

        </div>

    </div>

    {{-- Menu --}}
    <nav class="flex-1 p-4 space-y-2">

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 bg-white transition">

            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.materi') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 bg-white transition">

            <i class="bi bi-book"></i>
            Materi
        </a>

        <a href="{{ route('admin.progress') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 bg-white transition">

            <i class="bi bi-graph-up"></i>
            Progress
        </a>

        <a href="{{ route('admin.evaluasi') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 bg-white transition">

            <i class="bi bi-clipboard-check"></i>
            Evaluasi
        </a>

        <a href="{{ route('admin.pengguna') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 bg-white transition">

            <i class="bi bi-people"></i>
            Pengguna
        </a>

    </nav>

</aside>