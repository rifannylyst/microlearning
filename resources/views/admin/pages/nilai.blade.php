@extends('admin.layouts.app')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Rekap Nilai Siswa</h2>
            <p class="text-xs text-slate-500 mt-1">Kelola dan pantau seluruh hasil pengerjaan Kuis & Evaluasi Akhir siswa.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.nilai.export', ['format' => 'xls']) }}" class="flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-semibold transition shadow-sm">
                <i class="bi bi-file-earmark-excel text-sm"></i>
                Export Excel (.xls)
            </a>
            <a href="{{ route('admin.nilai.export', ['format' => 'csv']) }}" class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold transition shadow-sm">
                <i class="bi bi-filetype-csv text-sm"></i>
                Export CSV (.csv)
            </a>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-xs font-bold uppercase">
                        <th class="py-4 px-6">Nama Siswa</th>
                        <th class="py-4 px-6">Email</th>
                        {{-- Judul Kuis secara dinamis --}}
                        @foreach($quizzes as $quiz)
                            <th class="py-4 px-6 text-center whitespace-nowrap bg-blue-50/50 text-blue-800 border-l border-slate-200">
                                <span class="block text-[9px] opacity-70 font-bold uppercase tracking-wider">KUIS</span>
                                {{ $quiz->judul }}
                            </th>
                        @endforeach
                        {{-- Judul Evaluasi secara dinamis --}}
                        @foreach($evaluasis as $evaluasi)
                            <th class="py-4 px-6 text-center whitespace-nowrap bg-violet-50/50 text-violet-800 border-l border-slate-200">
                                <span class="block text-[9px] opacity-70 font-bold uppercase tracking-wider">EVALUASI</span>
                                {{ $evaluasi->judul }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-50/30 transition duration-150">
                            <td class="py-4 px-6 font-semibold text-slate-800">{{ $student->name }}</td>
                            <td class="py-4 px-6 text-slate-500 text-xs">{{ $student->email }}</td>
                            
                            {{-- Nilai Kuis --}}
                            @foreach($quizzes as $quiz)
                                @php
                                    $hasil = $hasilQuizzes->get($student->id)?->firstWhere('quiz_id', $quiz->id);
                                @endphp
                                <td class="py-4 px-6 text-center bg-blue-50/10 border-l border-slate-100">
                                    @if($hasil)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $hasil->status == 'lulus' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-rose-50 text-rose-700 border border-rose-100' }}">
                                            {{ $hasil->score }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 text-xs italic">Belum</span>
                                    @endif
                                </td>
                            @endforeach
                            
                            {{-- Nilai Evaluasi --}}
                            @foreach($evaluasis as $evaluasi)
                                @php
                                    $hasil = $hasilEvaluasis->get($student->id)?->firstWhere('evaluasi_id', $evaluasi->id);
                                @endphp
                                <td class="py-4 px-6 text-center bg-violet-50/10 border-l border-slate-100">
                                    @if($hasil)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-violet-50 text-violet-700 border border-violet-100">
                                            {{ $hasil->nilai }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 text-xs italic">Belum</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 2 + count($quizzes) + count($evaluasis) }}" class="py-8 text-center text-slate-400 text-sm">
                                Belum ada data siswa yang mendaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection