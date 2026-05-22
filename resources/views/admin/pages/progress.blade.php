@extends('admin.layouts.app')

@section('title', 'Data Progres')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Data Progres</h1>
        <!-- Content for progress data -->
        <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Siswa</th>
                <th class="border p-2">Materi</th>
                <th class="border p-2">Materi</th>
                <th class="border p-2">Video</th>
                <th class="border p-2">Audio</th>
                <th class="border p-2">Quiz</th>
                <th class="border p-2">Average gScore</th>
                <th class="border p-2">Progress Quiz</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                @foreach ($user->hasil_quiz as $hasil)
                    <tr>
                        <td class="border p-2">
                            {{ $user->name }}
                        </td>

                        <td class="border p-2">
                            {{ $hasil->quiz->materi->judul ?? '-' }}
                        </td>

                        <td class="border p-2">
                            @php
                                $materiId = $hasil->quiz->materi_id ?? null;

                                $totalMateri = \App\Models\KontenMateri::where('materi_id', $materiId)
                                    ->where('tipe', 'materi')
                                    ->count();

                                $doneMateri = $user->progressKonten
                                    ->where('kontenMateri.materi_id', $materiId)
                                    ->where('is_completed', true)
                                    ->filter(function ($p) {
                                        return optional($p->kontenMateri)->tipe === 'materi';
                                    })
                                    ->count();

                                $progressMateri = $totalMateri > 0
                                    ? round(($doneMateri / $totalMateri) * 100)
                                    : 0;
                            @endphp

                            {{ $progressMateri }}%
                        </td>

                        <td class="border p-2">
                            @php
                                $totalVideo = \App\Models\KontenMateri::where('materi_id', $materiId)
                                    ->where('tipe', 'video')
                                    ->count();

                               $doneVideo = $user->progressKonten
                                    ->where('is_completed', true)
                                    ->filter(function ($p) use ($materiId) {
                                        return optional($p->kontenMateri)->tipe === 'video'
                                            && optional($p->kontenMateri)->materi_id == $materiId;
                                    })
                                    ->count();

                                $progressVideo = $totalVideo > 0
                                    ? round(($doneVideo / $totalVideo) * 100)
                                    : 0;
                            @endphp

                            {{ $progressVideo }}%
                        </td>

                        <td class="border p-2">
                            @php
                                $totalAudio = \App\Models\KontenMateri::where('materi_id', $materiId)
                                    ->where('tipe', 'audio')
                                    ->count();

                               $doneAudio = $user->progressKonten
                                ->where('is_completed', true)
                                ->filter(function ($p) use ($materiId) {
                                    return optional($p->kontenMateri)->tipe === 'audio'
                                        && optional($p->kontenMateri)->materi_id == $materiId;
                                })
                                ->count();

                                $progressAudio = $totalAudio > 0
                                    ? round(($doneAudio / $totalAudio) * 100)
                                    : 0;
                            @endphp

                            {{ $progressAudio }}%
                        </td>

                        @php
                            $materiId = $hasil->quiz->materi_id ?? null;

                            // total quiz dalam materi
                            $totalQuiz = \App\Models\Quiz::where('materi_id', $materiId)->count();

                            // quiz yang sudah dikerjakan user
                            $doneQuiz = $user->hasil_quiz
                                ->where('quiz.materi_id', $materiId)
                                ->count();

                            $progressQuiz = $totalQuiz > 0 
                                ? round(($doneQuiz / $totalQuiz) * 100)
                                : 0;

                            // rata-rata score
                            $totalScore = 0;

                            $quizzes = \App\Models\Quiz::where('materi_id', $materiId)->get();

                            foreach ($quizzes as $quiz) {
                                $hasil = $user->hasil_quiz
                                    ->where('quiz_id', $quiz->id)
                                    ->first();

                                $totalScore += $hasil->score ?? 0;
                            }

                            $avgScore = $quizzes->count() > 0
                                ? $totalScore / $quizzes->count()
                                : 0;
                        @endphp
                        <td class="border p-2">
                            {{ $doneQuiz }}/{{ $totalQuiz }}
                        </td>

                        <td class="border p-2">
                            {{ number_format($avgScore ?? 0, 1) }}
                        </td>

                        <td class="border p-2">
                            <div class="w-full bg-gray-200 rounded">
                                <div class="bg-blue-500 text-white text-xs p-1 rounded"
                                    style="width: {{ $progressQuiz }}%">
                                    {{ $progressQuiz }}%
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    </div>
@endsection