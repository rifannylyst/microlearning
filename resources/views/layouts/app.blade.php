<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLearn</title>

    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-white/95 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100/80 shadow-sm transition-all">
        <div class="container mx-auto px-6 py-2.5 flex items-center">
            <!-- Left: Brand Logo -->
            <div class="flex-1 flex justify-start items-center">
                <div class="flex items-center space-x-2.5">
                    <img src="{{ asset('logo.jpg') }}" alt="Logo" class="w-9 h-9 rounded-xl shadow-sm object-cover border border-gray-200">
                    <a href="{{ route('home') }}" class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent hover:opacity-90 transition-opacity no-underline">
                        MicroLearn
                    </a>
                </div>
            </div>

            <!-- Center: Pill Navigation Menu -->
            <div class="hidden md:flex justify-center items-center">
                <ul class="flex space-x-1 bg-slate-100/80 p-1 rounded-xl border border-slate-200/30 font-semibold text-xs text-slate-500 mb-0">
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 no-underline {{ request()->routeIs('home') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-white/50' }}">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('materi.index') }}" class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 no-underline {{ request()->routeIs('materi.index') || request()->routeIs('materi.show') || request()->routeIs('materi.konten') || request()->routeIs('materi.konten.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-white/50' }}">
                            Materi Pembelajaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('progress') }}" class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 no-underline {{ request()->routeIs('progress') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-white/50' }}">
                            Progress Pembelajaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('evaluasi') }}" class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 no-underline {{ request()->routeIs('evaluasi') || request()->routeIs('siswa.evaluasi.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-white/50' }}">
                            Evaluasi Pembelajaran
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Right: Profile Dropdown -->
            <div class="flex-1 flex justify-end items-center">

                {{-- NOTIFICATION --}}
    <div class="relative">

        <button
            onclick="toggleNotification()"
            class="relative w-10 h-10 rounded-xl hover:bg-slate-100 transition flex items-center justify-center">

            <i class="bi bi-bell text-lg text-slate-600"></i>

            @if($unreadNotifications > 0)

                <span
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] rounded-full min-w-[18px] h-[18px] flex items-center justify-center">

                    {{ $unreadNotifications }}

                </span>

            @endif

        </button>

        {{-- Dropdown Notification --}}
                    <div id="notificationDropdown"
                        class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-200 z-50">
                        <div class="px-4 py-3 border-b">
                            <h6 class="font-semibold text-sm">
                                Notifikasi
                            </h6>
                        </div>
                        <div class="max-h-80 overflow-y-auto">
                            @forelse($notifications as $notification)
                                <a
                                    href="{{ route('notifications.read',$notification->id) }}"
                                    class="block px-4 py-3 hover:bg-slate-50 border-b border-slate-100 no-underline">
                                    <div class="font-medium text-sm">
                                        {{ $notification->judul }}
                                    </div>
                                    <div class="text-xs text-slate-500 mt-1">
                                        {{ $notification->pesan }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-1">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-6 text-slate-400 text-sm">
                                    Tidak ada notifikasi
                                </div>
                            @endforelse
                        </div>
                        <div class="border-t p-2">
                            <a
                                href="{{ route('notifications') }}"
                                class="block text-center text-blue-600 text-sm hover:underline">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <button onclick="toggleProfile()" class="flex items-center space-x-2 bg-slate-50 hover:bg-slate-100 text-slate-700 px-3.5 py-1.5 rounded-xl border border-slate-200/50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        <span class="font-semibold text-xs"> {{ auth()->user()->name }} </span>
                        <svg class="w-3.5 h-3.5 text-slate-400 inline-block transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></svg>
                    </button>

                    <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-1.5 z-50 transform origin-top-right transition-all">
                        <div class="px-4 py-2.5 border-b border-slate-50">
                            <p class="font-semibold text-xs text-slate-800">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-slate-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-xs text-slate-700 hover:bg-slate-50 transition-colors no-underline">
                                <i class="bi bi-person mr-2 text-sm text-slate-400"></i> Profil Saya
                            </a>
                            
                            <a href="{{ route('bookmarks') }}" class="flex items-center px-4 py-2 text-xs text-slate-700 hover:bg-slate-50 transition-colors no-underline">
                                <i class="bi bi-bookmark mr-2 text-sm text-slate-400"></i> Materi Tersimpan
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-xs text-slate-700 hover:bg-slate-50 transition-colors no-underline">
                                <i class="bi bi-speedometer2 mr-2 text-sm text-slate-400"></i> Dashboard Admin
                            </a>
                            @endif
                            <div class="border-t border-slate-50 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center text-left px-4 py-2 text-xs text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="bi bi-box-arrow-right mr-2 text-sm text-red-400"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-950 text-slate-400 border-t border-slate-900 pt-16 pb-8">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: Brand & Logo -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2.5">
                        <img src="{{ asset('logo.jpg') }}" alt="Logo" class="w-8 h-8 rounded-xl shadow-sm object-cover border border-slate-800">
                        <span class="text-lg font-extrabold tracking-tight text-white">MicroLearn</span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Platform pembelajaran mandiri berbasis microlearning resmi untuk mendukung akselerasi belajar pemrograman terarah dan interaktif.
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        <a href="https://www.youtube.com/@SMKTIPembangunanCimahi" target="_blank" class="w-7 h-7 rounded-lg bg-slate-900 hover:bg-red-600/10 text-slate-500 hover:text-red-500 flex items-center justify-center border border-slate-800 transition-all no-underline" title="YouTube">
                            <i class="bi bi-youtube text-sm"></i>
                        </a>
                        <a href="https://www.instagram.com/smktipembangunan/" target="_blank" class="w-7 h-7 rounded-lg bg-slate-900 hover:bg-pink-600/10 text-slate-500 hover:text-pink-500 flex items-center justify-center border border-slate-800 transition-all no-underline" title="Instagram">
                            <i class="bi bi-instagram text-sm"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=6285293939191" target="_blank" class="w-7 h-7 rounded-lg bg-slate-900 hover:bg-emerald-600/10 text-slate-500 hover:text-emerald-500 flex items-center justify-center border border-slate-800 transition-all no-underline" title="WhatsApp">
                            <i class="bi bi-whatsapp text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div>
                    <h5 class="text-xs font-bold text-slate-200 uppercase tracking-wider mb-4">Navigasi</h5>
                    <ul class="space-y-2.5 text-xs list-none p-0">
                        <li><a href="{{ route('home') }}" class="text-slate-500 hover:text-blue-400 no-underline transition-colors">Beranda</a></li>
                        <li><a href="{{ route('materi.index') }}" class="text-slate-500 hover:text-blue-400 no-underline transition-colors">Katalog Materi</a></li>
                        <li><a href="{{ route('progress') }}" class="text-slate-500 hover:text-blue-400 no-underline transition-colors">Progres Saya</a></li>
                        <li><a href="{{ route('evaluasi') }}" class="text-slate-500 hover:text-blue-400 no-underline transition-colors">Evaluasi Belajar</a></li>
                    </ul>
                </div>

                <!-- Col 3: SMK TI Info -->
                <div>
                    <h5 class="text-xs font-bold text-slate-200 uppercase tracking-wider mb-4">Institusi</h5>
                    <p class="text-xs text-slate-500 leading-relaxed mb-1">
                        SMK TI Pembangunan Cimahi
                    </p>
                    <p class="text-[10px] text-slate-600 leading-normal">
                        Mewujudkan generasi terampil di bidang rekayasa perangkat lunak, sistem jaringan, dan elektronika industri.
                    </p>
                </div>

                <!-- Col 4: Contacts -->
                <div>
                    <h5 class="text-xs font-bold text-slate-200 uppercase tracking-wider mb-4">Kontak Resmi</h5>
                    <ul class="space-y-2 text-xs text-slate-500 list-none p-0">
                        <li class="flex items-start gap-2">
                            <i class="bi bi-geo-alt text-slate-600 shrink-0"></i>
                            <span class="text-[10px] leading-normal">Jl. H. Bakar No. 18 B, Cimahi, Jawa Barat</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="bi bi-envelope text-slate-600 shrink-0"></i>
                            <span class="text-[10px]">smktip_cimahi@yahoo.co.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Divider & Copyright -->
            <div class="border-t border-slate-900 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[10px] text-slate-600 mb-0">
                    &copy; 2026 MicroLearn. Hak cipta dilindungi.
                </p>
                <div class="flex space-x-6 text-[10px] text-slate-600">
                    <span class="hover:text-slate-500">Syarat & Ketentuan</span>
                    <span class="hover:text-slate-500">Kebijakan Privasi</span>
                </div>
            </div>
        </div>
    </footer>

<script>
    function toggleProfile() {
        document
            .getElementById('profileDropdown')
            .classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('profileDropdown');

        if (!e.target.closest('.relative')) {
            dropdown.classList.add('hidden');
        }
    });

    function toggleNotification() {

        document
            .getElementById('notificationDropdown')
            .classList
            .toggle('hidden');
    }
</script>
</body>
</html>