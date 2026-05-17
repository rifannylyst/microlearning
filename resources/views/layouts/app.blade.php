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
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-blue-600 font-bold text-xl">MicroLearn</h1>
            <ul class="flex space-x-6">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
                <li><a href="{{ route('materi.index') }}" class="hover:text-blue-600">Kursus</a></li>
                <li><a href="{{ route('progress') }}" class="hover:text-blue-600">Pembelajaran Saya</a></li>
                <li><a href="#" class="hover:text-blue-600">Tentang</a></li>
            </ul>
        </div>
    </nav>

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="bg-indigo-900 text-white mt-10">
        <div class="container mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <h2 class="font-bold text-lg">MicroLearn</h2>
                <p class="text-sm mt-2">Microlearning untuk masa depan programmer.</p>
            </div>

            <div>
                <h3 class="font-semibold">Kursus</h3>
                <ul class="text-sm mt-2 space-y-1">
                    <li>Dasar Pemrograman</li>
                    <li>JavaScript</li>
                    <li>Python</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold">Belajar</h3>
                <ul class="text-sm mt-2 space-y-1">
                    <li>Artikel</li>
                    <li>Video</li>
                    <li>Kuis</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold">Perusahaan</h3>
                <ul class="text-sm mt-2 space-y-1">
                    <li>Tentang</li>
                    <li>Kontak</li>
                    <li>Blog</li>
                </ul>
            </div>
        </div>

        <div class="text-center text-sm py-4 border-t border-indigo-700">
            © 2026 MicroLearn. Hak cipta dilindungi.
        </div>
    </footer>

</body>
</html>