@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="relative bg-gradient-to-tr from-slate-900 via-indigo-950 to-slate-950 text-white py-20 md:py-28 overflow-hidden">
    {{-- Background Ornaments --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-35"></div>
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/15 rounded-full filter blur-[100px] pointer-events-none animate-pulse"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-600/10 rounded-full filter blur-[120px] pointer-events-none"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Left: Text & Action -->
        <div class="lg:col-span-7 text-center lg:text-left">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/30 text-blue-300 text-xs font-semibold tracking-wide uppercase mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-ping"></span>
                Platform Pembelajaran Mandiri
            </span>
            <h1 class="text-3xl md:text-5xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white">
                Kuasai Pemrograman dengan <span class="bg-gradient-to-r from-blue-400 via-cyan-400 to-indigo-400 bg-clip-text text-transparent">Pembelajaran Multi-Format</span>
            </h1>
            <p class="mt-6 text-sm text-slate-200 max-w-xl mx-auto lg:mx-0 font-medium leading-relaxed">
                Belajar dengan kecepatan Anda sendiri melalui pelajaran teks, audio, dan video interaktif yang dirancang khusus untuk mempercepat pemahaman Anda pada jurusan Rekayasa Perangkat Lunak.
            </p>

            <div class="mt-8 flex flex-wrap gap-4 justify-center lg:justify-start">
                <a href="{{ route('materi.index') }}" class="group relative px-6 py-3 rounded-xl font-semibold text-white bg-blue-600 hover:bg-blue-500 transition-all duration-300 shadow-[0_0_20px_rgba(37,99,235,0.3)] hover:shadow-[0_0_30px_rgba(37,99,235,0.5)] transform hover:-translate-y-0.5 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2">
                        Mulai Belajar <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                    </span>
                </a>
                <a href="#fitur" class="px-6 py-3 rounded-xl font-semibold text-slate-300 hover:text-white bg-slate-900/60 hover:bg-slate-900 border border-slate-800 transition-all duration-300 hover:border-slate-700 no-underline">
                    Format Belajar
                </a>
            </div>
        </div>

        <!-- Right: Glassmorphic HTML Code Editor Mockup -->
        <div class="lg:col-span-5 relative hidden lg:block">
            <!-- Glow background -->
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-2xl filter blur-[50px] opacity-30 animate-pulse"></div>
            
            <!-- Editor window -->
            <div class="relative z-10 border border-slate-800 bg-slate-950 rounded-2xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.5)] font-mono text-[11px] leading-relaxed text-slate-300">
                <!-- Title Bar -->
                <div class="bg-slate-905 px-4 py-3 flex items-center justify-between border-b border-slate-800/80">
                    <div class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500/80 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-yellow-500/80 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500/80 inline-block"></span>
                    </div>
                    <div class="text-[10px] text-slate-500 font-semibold tracking-wide">dasar_pemrograman.cpp</div>
                    <div class="w-10"></div> <!-- spacer -->
                </div>
                
                <!-- Code Area -->
                <div class="p-6 overflow-x-auto space-y-1 bg-slate-950 text-left">
                    <div><span class="text-slate-700 select-none mr-4">1</span><span class="text-slate-500">// Dasar Pemrograman RPL</span></div>
                    <div><span class="text-slate-700 select-none mr-4">2</span><span class="text-pink-400">#include</span> <span class="text-emerald-400">&lt;iostream&gt;</span></div>
                    <div><span class="text-slate-700 select-none mr-4">3</span><span class="text-pink-400">using namespace</span> <span class="text-slate-300">std</span>;</div>
                    <div><span class="text-slate-700 select-none mr-4">4</span></div>
                    <div><span class="text-slate-700 select-none mr-4">5</span><span class="text-blue-400">int</span> <span class="text-yellow-300">main</span>() {</div>
                    <div><span class="text-slate-700 select-none mr-4">6</span>    <span class="text-blue-400">string</span> <span class="text-yellow-300">platform</span> = <span class="text-emerald-400">"MicroLearn"</span>;</div>
                    <div><span class="text-slate-700 select-none mr-4">7</span>    <span class="text-blue-400">string</span> <span class="text-yellow-300">format</span>[] = {<span class="text-emerald-400">"Teks"</span>, <span class="text-emerald-400">"Audio"</span>, <span class="text-emerald-400">"Video"</span>};</div>
                    <div><span class="text-slate-700 select-none mr-4">8</span>    <span class="text-blue-400">int</span> <span class="text-yellow-300">progres</span> = <span class="text-amber-400">100</span>;</div>
                    <div><span class="text-slate-700 select-none mr-4">9</span>    </div>
                    <div><span class="text-slate-700 select-none mr-4">10</span>    <span class="text-pink-400">if</span> (<span class="text-yellow-300">progres</span> == <span class="text-amber-400">100</span>) {</div>
                    <div><span class="text-slate-700 select-none mr-4">11</span>        <span class="text-slate-300">cout</span> &lt;&lt; <span class="text-emerald-400">"Selamat Belajar!"</span> &lt;&lt; <span class="text-slate-300">endl</span>;</div>
                    <div><span class="text-slate-700 select-none mr-4">12</span>    }</div>
                    <div><span class="text-slate-700 select-none mr-4">13</span>    <span class="text-pink-400">return</span> <span class="text-amber-400">0</span>;</div>
                    <div><span class="text-slate-700 select-none mr-4">14</span>}</div>
                </div>
                
                <!-- Status Bar -->
                <div class="bg-slate-900/60 px-4 py-1.5 flex items-center justify-between text-[10px] text-slate-500 border-t border-slate-900 font-sans font-medium">
                    <div class="flex items-center space-x-3">
                        <span class="flex items-center gap-1 text-blue-400"><span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span> Ready</span>
                        <span>C++</span>
                    </div>
                    <div>Ln 14, Col 1</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATISTIK --}}
<div class="relative z-10 max-w-5xl mx-auto px-6 -mt-10">
    <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-slate-100 p-5 md:p-6 grid grid-cols-3 gap-4 text-center">
        <div class="p-2">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-1.5 sm:gap-3">
                <span class="text-xl sm:text-3xl font-extrabold text-blue-600">6+</span>
                <div class="hidden sm:flex w-9 h-9 rounded-xl bg-blue-50 items-center justify-center text-blue-600"><i class="bi bi-book"></i></div>
            </div>
            <p class="text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Kursus Pemrograman</p>
        </div>
        <div class="p-2 border-x border-slate-100">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-1.5 sm:gap-3">
                <span class="text-xl sm:text-3xl font-extrabold text-indigo-600">20+</span>
                <div class="hidden sm:flex w-9 h-9 rounded-xl bg-indigo-50 items-center justify-center text-indigo-600"><i class="bi bi-clock-history"></i></div>
            </div>
            <p class="text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Jam Konten</p>
        </div>
        <div class="p-2">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-1.5 sm:gap-3">
                <span class="text-xl sm:text-3xl font-extrabold text-violet-600">3</span>
                <div class="hidden sm:flex w-9 h-9 rounded-xl bg-violet-50 items-center justify-center text-violet-600"><i class="bi bi-play-circle"></i></div>
            </div>
            <p class="text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Format Pembelajaran</p>
        </div>
    </div>
</div>

{{-- FITUR --}}
<section id="fitur" class="py-20 bg-white text-center">
    <div class="max-w-3xl mx-auto text-center mb-12 px-6">
        <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Metode Pembelajaran</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">Belajar dengan Cara Anda</h2>
        <p class="text-slate-500 mt-2 text-sm max-w-lg mx-auto">Pilih format materi yang paling cocok dengan gaya belajar Anda untuk hasil yang maksimal.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto px-6">
        {{-- Card 1: Text --}}
        <div class="group bg-white p-6 rounded-2xl border border-slate-100 hover:border-cyan-500/20 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-cyan-50 text-cyan-600 group-hover:scale-110 transition-transform duration-300">
                <i class="bi bi-file-earmark-text text-2xl"></i>
            </div>
            <span class="text-[10px] font-semibold text-cyan-600 bg-cyan-50/50 px-2 py-0.5 rounded-full mt-4 uppercase">Membaca</span>
            <h3 class="font-bold text-slate-800 mt-2 text-base">Pelajaran Teks</h3>
            <p class="text-xs text-gray-500 mt-1 leading-relaxed max-w-[200px]">Belajar secara mendalam dengan membaca materi yang ringkas dan informatif.</p>
        </div>

        {{-- Card 2: Audio --}}
        <div class="group bg-white p-6 rounded-2xl border border-slate-100 hover:border-violet-500/20 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-violet-50 text-violet-600 group-hover:scale-110 transition-transform duration-300">
                <i class="bi bi-volume-up text-2xl"></i>
            </div>
            <span class="text-[10px] font-semibold text-violet-600 bg-violet-50/50 px-2 py-0.5 rounded-full mt-4 uppercase">Mendengarkan</span>
            <h3 class="font-bold text-slate-800 mt-2 text-base">Format Audio</h3>
            <p class="text-xs text-gray-500 mt-1 leading-relaxed max-w-[200px]">Belajar sambil beraktivitas dengan materi berformat audio podcast terarah.</p>
        </div>

        {{-- Card 3: Video --}}
        <div class="group bg-white p-6 rounded-2xl border border-slate-100 hover:border-amber-500/20 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-amber-50 text-amber-600 group-hover:scale-110 transition-transform duration-300">
                <i class="bi bi-play-btn text-2xl"></i>
            </div>
            <span class="text-[10px] font-semibold text-amber-600 bg-amber-50/50 px-2 py-0.5 rounded-full mt-4 uppercase">Menonton</span>
            <h3 class="font-bold text-slate-800 mt-2 text-base">Tutorial Video</h3>
            <p class="text-xs text-gray-500 mt-1 leading-relaxed max-w-[200px]">Pahami visualisasi kode dan simulasi proyek dengan video tutorial berkualitas.</p>
        </div>
    </div>
</section>

{{-- KURSUS --}}
<section class="py-20 bg-slate-50 border-y border-slate-100/80">
    <div class="max-w-5xl mx-auto px-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-10 gap-3">
            <div>
                <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Daftar Materi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">Kursus Unggulan</h2>
                <p class="text-slate-500 text-xs mt-1">Pelajari topik pemrograman terpopuler dan terupdate dari ahlinya.</p>
            </div>
            <a href="{{ route('materi.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors no-underline">
                Lihat Semua Materi <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($materi as $course)
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
                        Materi {{ $course->urutan }}
                    </span>
                    <form action="{{ route('bookmark.toggle', $course->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="w-7 h-7 rounded-lg flex items-center justify-center transition-all bg-white/85 backdrop-blur-sm text-slate-600 hover:text-yellow-500 hover:bg-white border border-slate-200/60 shadow-sm focus:outline-none" title="Simpan Materi">
                            @if(auth()->user()->bookmarks()->where('materi_id', $course->id)->exists())
                                <i class="bi bi-bookmark-fill text-yellow-500 text-xs"></i>
                            @else
                                <i class="bi bi-bookmark text-slate-400 text-xs"></i>
                            @endif
                        </button>
                    </form>
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
                    {{ $course->judul }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed flex-1">
                    {{ $course->deskripsi }}
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
                            {{ substr($course->user->name, 0, 1) }}
                        </div>
                        <span class="text-xs font-medium text-slate-500">{{ $course->user->name }}</span>
                    </div>
                    <a href="{{ route('materi.konten', $course->id) }}" class="inline-flex items-center gap-1 px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold shadow-sm hover:shadow transition-all">
                        Belajar <i class="bi bi-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</section>

{{-- ALUR BELAJAR --}}
<section class="py-20 bg-slate-900 text-white relative overflow-hidden border-t border-slate-950">
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:5rem_5rem] opacity-20"></div>
    <div class="max-w-3xl mx-auto text-center mb-16 px-6 relative z-10">
        <span class="text-blue-400 font-bold text-xs uppercase tracking-wider bg-blue-500/10 border border-blue-500/30 px-3 py-1.5 rounded-full">Langkah Belajar</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-4">Alur Belajar di MicroLearn</h2>
        <p class="text-slate-300 mt-2 text-xs sm:text-sm max-w-lg mx-auto">Ikuti langkah sederhana ini untuk memaksimalkan pemahaman Anda terhadap pemrograman komputer.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-5xl mx-auto px-6 relative z-10">
        {{-- Step 1 --}}
        <div class="group relative bg-white/[0.02] border border-white/5 p-6 rounded-2xl hover:bg-white/[0.04] hover:border-blue-500/30 transition-all duration-300 flex flex-col hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(37,99,235,0.04)]">
            <!-- Connector Line (Desktop) -->
            <div class="hidden md:block absolute top-10.5 -right-3.5 w-7 h-px border-t border-dashed border-white/10 z-0"></div>
            
            <div class="flex items-center justify-between mb-5 relative z-10">
                <span class="text-3xl font-black text-white/35 group-hover:text-blue-400/80 transition-colors duration-300 select-none leading-none">01</span>
                <div class="w-9 h-9 rounded-xl bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 group-hover:scale-105 transition-all duration-300">
                    <i class="bi bi-search text-sm"></i>
                </div>
            </div>
            <h4 class="font-bold text-sm text-white relative z-10">Pilih Kursus</h4>
            <p class="text-xs text-slate-400 mt-2 leading-relaxed flex-1 relative z-10 group-hover:text-slate-300 transition-colors">
                Cari dan tentukan materi pemrograman dari katalog kelas unggulan kami sesuai minat Anda.
            </p>
        </div>

        {{-- Step 2 --}}
        <div class="group relative bg-white/[0.02] border border-white/5 p-6 rounded-2xl hover:bg-white/[0.04] hover:border-indigo-500/30 transition-all duration-300 flex flex-col hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(79,70,229,0.04)]">
            <!-- Connector Line (Desktop) -->
            <div class="hidden md:block absolute top-10.5 -right-3.5 w-7 h-px border-t border-dashed border-white/10 z-0"></div>
            
            <div class="flex items-center justify-between mb-5 relative z-10">
                <span class="text-3xl font-black text-white/35 group-hover:text-indigo-400/80 transition-colors duration-300 select-none leading-none">02</span>
                <div class="w-9 h-9 rounded-xl bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 group-hover:scale-105 transition-all duration-300">
                    <i class="bi bi-journal-richtext text-sm"></i>
                </div>
            </div>
            <h4 class="font-bold text-sm text-white relative z-10">Pelajari Konten</h4>
            <p class="text-xs text-slate-300 mt-2 leading-relaxed flex-1 relative z-10 group-hover:text-slate-200 transition-colors">
                Pahami materi dengan opsi multi-format: membaca teks ringkas, mendengar audio, atau menonton video.
            </p>
        </div>

        {{-- Step 3 --}}
        <div class="group relative bg-white/[0.02] border border-white/5 p-6 rounded-2xl hover:bg-white/[0.04] hover:border-violet-500/30 transition-all duration-300 flex flex-col hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(124,58,237,0.04)]">
            <!-- Connector Line (Desktop) -->
            <div class="hidden md:block absolute top-10.5 -right-3.5 w-7 h-px border-t border-dashed border-white/10 z-0"></div>
            
            <div class="flex items-center justify-between mb-5 relative z-10">
                <span class="text-3xl font-black text-white/35 group-hover:text-violet-400/80 transition-colors duration-300 select-none leading-none">03</span>
                <div class="w-9 h-9 rounded-xl bg-violet-500/10 text-violet-400 border border-violet-500/20 flex items-center justify-center group-hover:bg-violet-600 group-hover:text-white group-hover:border-violet-600 group-hover:scale-105 transition-all duration-300">
                    <i class="bi bi-check2-circle text-sm"></i>
                </div>
            </div>
            <h4 class="font-bold text-sm text-white relative z-10">Kerjakan Kuis</h4>
            <p class="text-xs text-slate-300 mt-2 leading-relaxed flex-1 relative z-10 group-hover:text-slate-200 transition-colors">
                Uji pemahaman Anda dengan menyelesaikan soal evaluasi kuis secara langsung setelah materi selesai.
            </p>
        </div>

        {{-- Step 4 --}}
        <div class="group relative bg-white/[0.02] border border-white/5 p-6 rounded-2xl hover:bg-white/[0.04] hover:border-emerald-500/30 transition-all duration-300 flex flex-col hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(16,185,129,0.04)]">
            <div class="flex items-center justify-between mb-5 relative z-10">
                <span class="text-3xl font-black text-white/35 group-hover:text-emerald-400/80 transition-colors duration-300 select-none leading-none">04</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 group-hover:scale-105 transition-all duration-300">
                    <i class="bi bi-graph-up text-sm"></i>
                </div>
            </div>
            <h4 class="font-bold text-sm text-white relative z-10">Pantau Progres</h4>
            <p class="text-xs text-slate-300 mt-2 leading-relaxed flex-1 relative z-10 group-hover:text-slate-200 transition-colors">
                Lihat perkembangan belajar, nilai kuis yang dicapai, serta statistik penyelesaian di panel progres.
            </p>
        </div>
    </div>
</section>

{{-- TENTANG SMK TI PEMBANGUNAN CIMAHI --}}
<section class="py-20 bg-slate-50 border-t border-slate-100">
    <div class="max-w-5xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <!-- Left: Info -->
            <div class="lg:col-span-7">
                <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Tentang Sekolah</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4 leading-tight">SMK TI Pembangunan Cimahi</h2>
                <p class="text-slate-400 text-xs italic mt-1">"Your Success Begins Here" • Jurusan Rekayasa Perangkat Lunak</p>
                <p class="text-slate-600 text-xs sm:text-sm mt-4 leading-relaxed text-justify">
                    Platform pembelajaran mandiri <strong class="font-semibold text-slate-900">MicroLearn</strong> ini dirancang secara khusus untuk mempermudah siswa jurusan Rekayasa Perangkat Lunak (RPL) di SMK TI Pembangunan Cimahi dalam memahami materi mata pelajaran <strong class="font-semibold text-slate-900">Dasar Pemrograman</strong>. Melalui materi ringkas (microlearning) berformat teks, audio, dan video tutorial, siswa dapat menguasai logika coding fundamental secara efektif.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    <div class="flex items-start gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                            <i class="bi bi-geo-alt text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-800">Alamat Sekolah</h5>
                            <p class="text-[10px] text-slate-500 mt-0.5 leading-normal">
                                Jl. H. Bakar No. 18 B, Cimahi / Jl. Mahar Martanegara No. 48, Kota Cimahi.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                            <i class="bi bi-envelope text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-800">Hubungi Kami</h5>
                            <p class="text-[10px] text-slate-500 mt-0.5 leading-normal">
                                Telp: 085293939191<br>
                                Email: smktip_cimahi@yahoo.co.id
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Fokus Dasar Pemrograman RPL -->
            <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <h4 class="font-bold text-slate-800 text-sm mb-4">Dasar Pemrograman (RPL)</h4>
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between p-3.5 bg-slate-50/50 hover:bg-slate-50 rounded-xl border border-slate-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100/50 shrink-0">
                                <i class="bi bi-diagram-3 text-sm"></i>
                            </div>
                            <div>
                                <h5 class="text-xs font-semibold text-slate-800">Algoritma & Struktur Data</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5">Pemecahan masalah & logika pemrograman</p>
                            </div>
                        </div>
                        <span class="text-[9px] font-bold bg-blue-100 text-blue-700 px-2 py-0.5 rounded shrink-0">Dasar</span>
                    </div>

                    <div class="flex items-center justify-between p-3.5 bg-slate-50/50 hover:bg-slate-50 rounded-xl border border-slate-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100/50 shrink-0">
                                <i class="bi bi-signpost-split text-sm"></i>
                            </div>
                            <div>
                                <h5 class="text-xs font-semibold text-slate-800">Struktur Percabangan</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5">Pengambilan keputusan (If-Else & Switch)</p>
                            </div>
                        </div>
                        <span class="text-[9px] font-bold bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded shrink-0">Kontrol</span>
                    </div>

                    <div class="flex items-center justify-between p-3.5 bg-slate-50/50 hover:bg-slate-50 rounded-xl border border-slate-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center border border-violet-100/50 shrink-0">
                                <i class="bi bi-arrow-repeat text-sm"></i>
                            </div>
                            <div>
                                <h5 class="text-xs font-semibold text-slate-800">Struktur Perulangan</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5">Iterasi data (For, While & Do-While)</p>
                            </div>
                        </div>
                        <span class="text-[9px] font-bold bg-violet-100 text-violet-700 px-2 py-0.5 rounded shrink-0">Loop</span>
                    </div>

                    <div class="flex items-center justify-between p-3.5 bg-slate-50/50 hover:bg-slate-50 rounded-xl border border-slate-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100/50 shrink-0">
                                <i class="bi bi-braces text-sm"></i>
                            </div>
                            <div>
                                <h5 class="text-xs font-semibold text-slate-800">Fungsi & Array</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5">Modularisasi kode dan penyimpanan array</p>
                            </div>
                        </div>
                        <span class="text-[9px] font-bold bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded shrink-0">Lanjutan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
