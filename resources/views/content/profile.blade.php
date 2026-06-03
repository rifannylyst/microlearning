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
            @if(session('success'))
                <div class="mx-6 mt-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-5">

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', auth()->user()->name) }}"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', auth()->user()->email) }}"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Password Baru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Kosongkan jika tidak ingin mengubah"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="pt-3">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium">
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>
@endsection