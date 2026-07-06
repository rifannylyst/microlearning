@php
    $pageTitle = 'Dashboard Admin';
    $pageDesc = 'Ringkasan metrik pembelajaran, statistik performa siswa, dan akses cepat manajemen konten secara real-time.';
    
    if (request()->routeIs('admin.materi') || request()->routeIs('admin.materi.*') || request()->routeIs('admin.quiz.*') || request()->routeIs('admin.pertanyaan.*')) {
        $pageTitle = 'Manajemen Materi';
        $pageDesc = 'Kelola topik utama, susun alur pembelajaran microlearning, dan integrasikan modul multimedia secara terstruktur.';
    } elseif (request()->routeIs('admin.progress') || request()->routeIs('admin.progress.*')) {
        $pageTitle = 'Progress Siswa';
        $pageDesc = 'Pantau statistik ketuntasan materi, riwayat belajar, dan tingkat pemahaman kuis siswa secara menyeluruh.';
    } elseif (request()->routeIs('admin.evaluasi') || request()->routeIs('admin.evaluasi.*')) {
        $pageTitle = 'Evaluasi & Nilai';
        $pageDesc = 'Susun bank soal evaluasi akhir, konfigurasi kuis interaktif, dan rekap penilaian hasil ujian siswa.';
    } elseif (request()->routeIs('admin.pengguna')) {
        $pageTitle = 'Manajemen Pengguna';
        $pageDesc = 'Administrasi data akun siswa dan staf pengajar, konfigurasi hak akses, dan monitoring status aktif.';
    }
@endphp

<header class="bg-white border-b border-slate-100 px-6 sticky top-0 z-40 shadow-sm flex items-center h-[76px]">

    <div class="flex justify-between items-center w-full">

        <div class="flex flex-col justify-center">
            <h1 class="text-xl font-extrabold text-slate-800 m-0 leading-none mb-1">
                {{ $pageTitle }}
            </h1>
            <p class="text-xs text-slate-400 m-0 leading-none">
                {{ $pageDesc }}
            </p>
        </div>

        {{-- User --}}
        <div class="relative">

            <button
                onclick="toggleUserMenu()"
                class="flex items-center gap-2.5 bg-slate-50 hover:bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200/50 transition-all duration-200 focus:outline-none">

                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-sm shadow-blue-500/10">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <span class="font-semibold text-xs text-slate-700 hidden sm:inline">
                    {{ auth()->user()->name }}
                </span>

                <i class="bi bi-chevron-down text-slate-400 text-xs"></i>

            </button>

            <div
                id="userMenu"
                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-1.5 z-50 transform origin-top-right transition-all">

                <form
                    action="{{ route('logout') }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="w-full flex items-center text-left px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors">

                        <i class="bi bi-box-arrow-right mr-2 text-sm text-red-400"></i>
                        Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</header>

<script>
function toggleUserMenu() {
    document
        .getElementById('userMenu')
        .classList
        .toggle('hidden');
}

document.addEventListener('click', function(e){

    let menu = document.getElementById('userMenu');

    if(!e.target.closest('.relative')){
        menu.classList.add('hidden');
    }

});
</script>