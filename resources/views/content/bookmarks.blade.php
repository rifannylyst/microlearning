@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 max-w-5xl">

    <!-- Header -->
    <div class="mb-10">
        <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Belajar Mandiri</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">Materi Tersimpan</h2>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">Simpan topik-topik penting pilihan Anda dan pelajari kembali kapan saja tanpa batas untuk memperdalam pemahaman.</p>
    </div>

    @if($materis->count() > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($materis as $materi)

                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 hover:border-blue-500/20 transition-all duration-300 overflow-hidden flex flex-col h-full">
                    {{-- Header card --}}
                    <div class="bg-gradient-to-tr from-blue-50 to-indigo-50/50 relative overflow-hidden h-36 flex flex-col justify-between p-4 border-b border-slate-100">
                        <!-- Grid pattern -->
                        <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:1rem_1rem] opacity-35"></div>
                        <!-- Glow abstract -->
                        <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-blue-200/50 to-indigo-200/50 rounded-full filter blur-xl opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>

                        <div class="flex justify-between items-start w-full relative z-20">
                            <span class="text-[9px] font-bold px-2 py-0.5 bg-blue-100 text-blue-700 rounded uppercase tracking-wider">
                                Tersimpan
                            </span>
                            <button
                                class="bookmark-btn"
                                data-id="{{ $materi->id }}"
                            >
                                <i class="bi {{ $materi->isBookmarked() ? 'bi-bookmark-fill' : 'bi-bookmark' }}"></i>
                            </button>
                        </div>
                        <div class="relative z-20">
                            <div class="w-8 h-8 rounded-lg bg-blue-600/10 flex items-center justify-center text-blue-600 border border-blue-200/30 group-hover:scale-105 transition-transform duration-300">
                                <i class="bi bi-journal-code text-sm"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="font-bold text-slate-800 text-base group-hover:text-blue-600 transition-colors line-clamp-1 mb-1.5">
                            {{ $materi->judul }}
                        </h3>
                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed flex-1">
                            {{ Str::limit(strip_tags($materi->deskripsi), 120) }}
                        </p>

                        <div class="flex items-center justify-between border-t border-slate-100 pt-4 mt-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded-full bg-slate-50 text-slate-600 flex items-center justify-center text-[10px] font-bold border border-slate-200">
                                    {{ substr($materi->user->name ?? 'A', 0, 1) }}
                                </div>
                                <span class="text-xs font-medium text-slate-500">{{ $materi->user->name ?? 'Admin' }}</span>
                            </div>
                            <a href="{{ route('materi.konten', $materi->id) }}" class="inline-flex items-center gap-1 px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold shadow-sm hover:shadow transition-all no-underline">
                                Belajar <i class="bi bi-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

    @else

        <!-- Empty State -->
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm max-w-xl mx-auto">
            <div class="w-20 h-20 mx-auto bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                <i class="bi bi-bookmark text-3xl text-slate-300"></i>
            </div>
            <h2 class="text-xl font-bold text-slate-800 mt-6">Belum Ada Materi Tersimpan</h2>
            <p class="text-slate-500 text-xs mt-2 max-w-sm mx-auto leading-relaxed">Simpan materi yang menarik dari katalog kelas agar dapat Anda pelajari kembali kapan saja.</p>
            <a href="{{ route('materi.index') }}" class="inline-flex items-center gap-2 mt-6 bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-xs font-semibold shadow-sm shadow-blue-500/10 transition-all duration-200">
                Jelajahi Katalog Materi
            </a>
        </div>

    @endif

</div>
<script>
document.querySelectorAll('.bookmark-btn').forEach(button => {

    button.addEventListener('click', function () {

        const materiId = this.dataset.id;
        const icon = this.querySelector('i');

        fetch(`/bookmark/${materiId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {

            if (data.status === 'added') {
                icon.classList.remove('bi-bookmark');
                icon.classList.add('bi-bookmark-fill');
                icon.classList.add('text-warning');
            } else {
                icon.classList.remove('bi-bookmark-fill');
                icon.classList.add('bi-bookmark');
                icon.classList.remove('text-warning');
            }

        });

    });

});
</script>
@endsection