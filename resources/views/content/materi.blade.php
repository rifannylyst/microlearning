@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-blue-700">Semua Kursus</h2>
        <p class="text-gray-600">Pilih dari koleksi lengkap kursus pemrograman kami</p>
    </div>

    <!-- Filter -->
    <!--
    <div class="flex gap-3 mb-8">
        <button class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm">Semua Level</button>
        <button class="border border-blue-400 text-blue-600 px-4 py-2 rounded-full text-sm">Pemula</button>
        <button class="border border-blue-400 text-blue-600 px-4 py-2 rounded-full text-sm">Menengah</button>
        <button class="border border-blue-400 text-blue-600 px-4 py-2 rounded-full text-sm">Lanjutan</button>
    </div>
        -->

    <!-- Grid Card -->
    <div class="grid md:grid-cols-3 gap-6">

        @foreach($materis as $item)
            <div class="bg-white rounded-xl shadow border border-blue-200 overflow-hidden">

                <!-- Icon -->
                <div class="bg-blue-500 h-36 flex items-center justify-center">
                    <i class="bi bi-book text-white text-5xl"></i>
                </div>

                <!-- Content -->
                <div class="p-4">
                    <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                        Materi {{ $item->urutan }}
                    </span>

                    <h3 class="font-semibold text-lg mt-2">
                        {{ $item->judul }}
                    </h3>

                    <p class="text-sm text-gray-600 mt-1">
                        {{ $item->deskripsi }}
                    </p>

                    <!-- Footer -->
                    <div class="flex justify-between items-center mt-4 text-sm text-blue-600">
                        <div class="flex items-center gap-1">
                            <i class="bi bi-person"></i>
                            <span>{{ $item->user->name ?? 'Unknown' }}</span>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('materi.konten', $item->id) }}" class="bi bi-pencil"></a>
                                <form action ="{{ route('bookmark.toggle', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <i class="bi {{ in_array($item->id, $bookmarkedMateriIds) ? 'bi-bookmark-fill text-blue-500' : 'bi-bookmark text-gray-500' }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

    </div>

</div>
@endsection