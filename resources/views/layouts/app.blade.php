<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLearn</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 relative flex justify-between items-center">
            <img src="{{ asset('logo.jpg') }}" alt="Logo" class="w-10 h-10 mr-3">
            <a href="{{ route('home') }}"
            style="text-decoration: none; text-color: blue; text-font-weight: bold; font-size: 2rem;">
                MicroLearn
            </a>
            <ul class="flex space-x-6 ml-auto mr-4">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
                <li><a href="{{ route('materi.index') }}" class="hover:text-blue-600">Materi Pembelajaran</a></li>
                <li><a href="{{ route('progress') }}" class="hover:text-blue-600">Progress Pembelajaran</a></li>
            </ul>
            <div class="relative">
                <button onclick="toggleProfile()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                    <span class="font-medium"> {{ auth()->user()->name }} </span>
                    <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></svg>
                </button>

                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20">
                    <div class="px-4 py-2 border-b">
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="py-2">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Profil</a>
                        <a href="{{ route('bookmarks') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Materi Tersimpan</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="bg-gradient-to-r from-blue-400 to-blue-600 text-white mt-10">
        <div class="text-center text-sm py-4 border-t border-blue-700">
            © 2026 MicroLearn. Hak cipta dilindungi.
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
</script>
</body>
</html>