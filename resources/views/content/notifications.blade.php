@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 mb-6">
        <div class="px-6 py-5 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    <i class="bi bi-bell-fill text-blue-500 mr-2"></i>
                    Notifikasi
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Seluruh aktivitas pembelajaran Anda akan ditampilkan di halaman ini.
                </p>
            </div>
            @if($notifications->where('is_read', false)->count())
                <form action="{{ route('notifications.readAll') }}" method="POST">
                    @csrf
                    <button
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- List Notification -->

    <div class="space-y-4">
        @forelse($notifications as $notification)
            <a
                href="{{ route('notifications.read',$notification->id) }}"
                class="block bg-white border rounded-2xl shadow-sm hover:shadow-md transition
                {{ $notification->is_read ? 'border-slate-200' : 'border-blue-300 bg-blue-50/40' }}">
                <div class="p-5 flex">
                    <!-- Icon -->
                    <div class="mr-4 mt-1">
                        @switch($notification->tipe)
                            @case('materi')
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="bi bi-book text-blue-600 text-xl"></i>
                                </div>
                                @break
                            @case('quiz')
                                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <i class="bi bi-patch-question text-yellow-600 text-xl"></i>
                                </div>
                                @break
                            @case('evaluasi')
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="bi bi-award text-green-600 text-xl"></i>
                                </div>
                                @break
                            @case('progress')
                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="bi bi-graph-up-arrow text-purple-600 text-xl"></i>
                                </div>
                                @break
                            @case('selesai')
                                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <i class="bi bi-check-circle-fill text-emerald-600 text-xl"></i>
                                </div>
                                @break
                            @default
                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center">
                                    <i class="bi bi-bell text-slate-600 text-xl"></i>
                                </div>
                        @endswitch
                    </div>
                    <!-- Content -->
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h3 class="font-semibold text-slate-800">
                                {{ $notification->judul }}
                            </h3>
                            @if(!$notification->is_read)
                                <span
                                    class="bg-blue-600 text-white text-[10px] px-2 py-1 rounded-full">
                                    Baru
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-slate-600 mt-1">
                            {{ $notification->pesan }}
                        </p>
                        <div class="mt-3 text-xs text-slate-400">
                            {{ $notification->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 py-16 text-center">
                <i class="bi bi-bell text-6xl text-slate-300"></i>
                <h3 class="mt-4 text-lg font-semibold text-slate-700">
                    Belum ada notifikasi
                </h3>
                <p class="text-slate-500 mt-2">
                    Semua pemberitahuan dari guru akan muncul di sini.
                </p>
            </div>
        @endforelse
    </div>
    <!-- Pagination -->
    <div class="mt-8">
    </div>
</div>
@endsection