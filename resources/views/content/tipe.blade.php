@extends('layouts.app')

@section('content')

<div class="bg-slate-50 min-h-screen py-8 px-6">
    <div class="max-w-5xl mx-auto">
        <!-- HEADER -->
        <div class="mb-8">
            <a href="{{ route('materi.konten', $materi->id) }}"
               class="inline-flex items-center text-xs font-bold text-blue-600 hover:text-blue-700 mb-4 transition-colors no-underline">
                <i class="bi bi-arrow-left text-[11px] mr-1.5"></i>
                Kembali
            </a>
            <div>
                <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full capitalize">
                    {{ $tipe }}
                </span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">{{ $materi->judul }}</h2>
        </div>
        <!-- LIST KONTEN -->
        @if($kontens->count())
            @if($kontens->count() == 1)
                <div class="max-w-2xl mx-auto w-full">
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @endif
                @foreach($kontens as $konten)
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 hover:shadow-lg transition duration-300">
                        <!-- HEADER -->
                        <div class="flex justify-between items-center mb-5">
                            <span class="bg-blue-50 text-blue-600 border border-blue-100/50 text-[10px] font-bold px-2.5 py-0.5 rounded-md uppercase tracking-wider capitalize">
                                {{ $konten->tipe }}
                            </span>
                            <span class="text-xs font-semibold text-slate-500">
                                Urutan {{ $konten->urutan }}
                            </span>
                        </div>
                        <!-- CONTENT PREVIEW -->
                        <div class="mb-5">
                            {{-- VIDEO --}}
                            @if($konten->tipe == 'video')
                                @if($konten->link)
                                    @php
                                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $konten->link, $matches);
                                        $youtubeId = $matches[1] ?? null;
                                    @endphp
                                    @if($youtubeId)
                                        <iframe class="w-full h-52 rounded-xl border border-slate-100 shadow-sm" src="https://www.youtube.com/embed/{{ $youtubeId }}" allowfullscreen>
                                        </iframe>
                                    @else
                                        <a href="{{ $konten->link }}" target="_blank" class="text-blue-600 hover:underline text-xs font-semibold"> Buka Video
                                        </a>
                                    @endif
                                @elseif($konten->isi)
                                    <video controls class="w-full rounded-xl border border-slate-100 shadow-sm">
                                        <source src="{{ asset('storage/'.$konten->isi) }}">
                                    </video>
                                @endif
                            {{-- AUDIO --}}
                            @elseif($konten->tipe == 'audio')
                                @if($konten->isi)
                                    <div class="bg-emerald-50/50 p-4 rounded-xl border border-emerald-100/30">
                                        <audio controls class="w-full">
                                            <source src="{{ asset('storage/'.$konten->isi) }}">
                                        </audio>
                                    </div>
                                @elseif($konten->link)
                                    <a href="{{ $konten->link }}" target="_blank" class="text-blue-600 hover:underline text-xs font-semibold"> Buka Audio
                                    </a>
                                @endif
                            {{-- MATERI --}}
                            @elseif($konten->tipe == 'materi')
                                @if($konten->isi)
                                    <iframe src="{{ asset('storage/'.$konten->isi) }}" class="w-full h-64 rounded-xl border border-slate-100 shadow-sm">
                                    </iframe>
                                @elseif($konten->link)
                                    <a href="{{ $konten->link }}" target="_blank" class="text-blue-600 hover:underline text-xs font-semibold">Buka Materi
                                    </a>
                                @endif
                            @endif
                        </div>
                        <!-- DESKRIPSI -->
                        @if($konten->deskripsi)
                            <h4 class="font-bold text-slate-800 text-sm mb-2">
                                {{ $konten->deskripsi }}
                            </h4>
                        @endif

                        <!-- DURASI -->
                        @if($konten->durasi)
                            <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium mb-5">
                                <i class="bi bi-clock text-[13px] text-blue-500"></i>
                                <span>{{ $konten->durasi }} menit</span>
                            </div>
                        @endif
                        <!-- BUTTON -->
                        <a href="{{ route('materi.konten.detail', [$materi->id, $konten->tipe, $konten->id]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-sm hover:shadow transition-all no-underline">
                            Buka Konten <i class="bi bi-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <!-- EMPTY STATE -->
            <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-20 h-20 mx-auto bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100 mb-6">
                    <i class="bi bi-folder-x text-3xl text-slate-300"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800 mb-2">
                    Konten Tidak Tersedia
                </h2>
                <p class="text-slate-500 text-xs mb-8 max-w-xs mx-auto leading-relaxed">
                    Belum ada konten {{ strtolower($tipe) }} untuk materi ini.
                </p>
                <a href="{{ route('materi.konten', $materi->id) }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-xs font-semibold shadow-sm shadow-blue-500/10 transition-all duration-200 no-underline">
                    <i class="bi bi-arrow-left"></i> Kembali ke Menu Belajar
                </a>
            </div>
        @endif
    </div>
</div>
@endsection