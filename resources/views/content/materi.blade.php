@extends('layouts.app')

@section('content')
<div class="container py-8 max-w-5xl mx-auto px-6">

    <!-- Header -->
    <div class="mb-10">
        <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Katalog Kelas</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">Semua Kursus Pemrograman</h2>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">Akses katalog materi pemrograman berkualitas tinggi untuk mengasah keterampilan coding Anda secara bertahap dan terukur.</p>
    </div>

    <!-- Grid Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($materis as $item)
            <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 hover:border-blue-500/20 transition-all duration-300 overflow-hidden flex flex-col h-full">
                {{-- Header card --}}
                <div class="bg-gradient-to-tr from-blue-50 to-indigo-50/50 relative overflow-hidden h-40 flex flex-col justify-between p-4 border-b border-slate-100">
                    <!-- Glow bubble backdrop -->
                    <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-blue-200/50 to-indigo-200/50 rounded-full filter blur-xl opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>
                    <!-- Grid pattern -->
                    <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:1rem_1rem] opacity-35"></div>
                    
                    <div class="absolute top-0 right-0 p-3 opacity-[0.08] text-7xl font-black text-slate-400 pointer-events-none select-none">
                        {{ $loop->iteration }}
                    </div>
                    <div class="flex justify-between items-start w-full relative z-20">
                        <span class="text-[9px] font-bold px-2 py-0.5 bg-blue-100 text-blue-700 rounded uppercase tracking-wider">
                            Materi {{ $item->urutan }}
                        </span>
                        <button
                                class="bookmark-btn"
                                data-id="{{ $item->id }}"
                            >
                                <i class="bi {{ $item->isBookmarked() ? 'bi-bookmark-fill' : 'bi-bookmark' }}"></i>
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
                        {{ $item->judul }}
                    </h3>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed flex-1">
                        {{ $item->deskripsi }}
                    </p>

                    <!-- Media format tags indicating Microlearning multi-format content -->
                    <div class="flex items-center gap-1.5 mt-4 flex-wrap">
                        <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-slate-600 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded">
                            <i class="bi bi-file-text text-blue-500 text-xs"></i> Teks
                        </span>
                        <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-slate-600 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded">
                            <i class="bi bi-headphones text-violet-500 text-xs"></i> Audio
                        </span>
                        <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-slate-600 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded">
                            <i class="bi bi-play-btn text-amber-500 text-xs"></i> Video
                        </span>
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-100 pt-4 mt-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-6.5 h-6.5 rounded-full bg-slate-50 text-slate-600 flex items-center justify-center text-[10px] font-bold border border-slate-200">
                                {{ substr($item->user->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="text-xs font-medium text-slate-500">{{ $item->user->name ?? 'Admin' }}</span>
                        </div>
                        <a href="{{ route('materi.konten', $item->id) }}" class="inline-flex items-center gap-1 px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold shadow-sm hover:shadow transition-all">
                            Belajar <i class="bi bi-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

    </div>

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