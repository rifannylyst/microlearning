@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">

    <div class="max-w-3xl mx-auto">

        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg p-8 text-white">

            <div class="flex items-center gap-5">

                <div class="w-24 h-24 rounded-full bg-white text-blue-600 flex items-center justify-center text-4xl font-bold shadow">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <h1 class="text-3xl font-bold">
                        {{ auth()->user()->name }}
                    </h1>

                    <p class="text-blue-100 mt-1">
                        {{ auth()->user()->email }}
                    </p>
                </div>

            </div>

        </div>

        <!-- Detail Profil -->
        <div class="bg-white rounded-2xl shadow-lg mt-6 overflow-hidden">

            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-800">
                    Informasi Akun
                </h2>
            </div>

            <div class="p-6 space-y-5">

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        Nama Lengkap
                    </label>

                    <div class="bg-gray-50 border rounded-xl px-4 py-3">
                        {{ auth()->user()->name }}
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        Email
                    </label>

                    <div class="bg-gray-50 border rounded-xl px-4 py-3">
                        {{ auth()->user()->email }}
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        Password
                    </label>

                    <div class="bg-gray-50 border rounded-xl px-4 py-3 flex justify-between items-center">
                        <span>••••••••••••</span>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection