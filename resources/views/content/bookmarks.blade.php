@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Materi Tersimpan
        </h1>

        <p class="text-gray-500 mt-2">
            Kumpulan materi yang telah Anda simpan untuk dipelajari nanti.
        </p>
    </div>

    @if($materis->count() > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($materis as $materi)

                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">

                    <!-- Thumbnail -->
                    @if($materi->thumbnail)
                        <img src="{{ asset('storage/'.$materi->thumbnail) }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center">
                            <i class="bi bi-book text-white text-5xl"></i>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-5">

                        <div class="flex justify-between items-start">

                            <h2 class="text-lg font-semibold text-gray-800">
                                {{ $materi->judul }}
                            </h2>

                            <i class="bi bi-bookmark-fill text-yellow-500"></i>

                        </div>

                        <p class="text-gray-500 text-sm mt-2 line-clamp-3">
                            {{ Str::limit(strip_tags($materi->deskripsi), 120) }}
                        </p>

                        <div class="mt-5 flex justify-between items-center">

                            <a href="{{ route('materi.konten', $materi->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                Buka Materi
                            </a>

                            <form action="{{ route('bookmark.toggle', $materi->id) }}"
                                method="POST">
                                @csrf

                                <button type="submit"
                                    class="text-red-500 hover:text-red-700">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow p-12 text-center">

            <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center">
                <i class="bi bi-bookmark text-4xl text-gray-400"></i>
            </div>

            <h2 class="text-xl font-semibold text-gray-700 mt-5">
                Belum Ada Materi Tersimpan
            </h2>

            <p class="text-gray-500 mt-2">
                Simpan materi yang menarik untuk dipelajari kembali nanti.
            </p>

            <a href="{{ route('materi.index') }}"
                class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">
                Jelajahi Materi
            </a>

        </div>

    @endif

</div>
@endsection