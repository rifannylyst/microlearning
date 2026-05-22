@extends('admin.layouts.app')

@section('content')
   <h2 class="text-2xl font-semibold text-gray-800 mb-6">Data Materi</h2>
        <div class="flex flex-wrap gap-2 mb-4">
        <button onclick="openModal('addModal')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Tambah Materi</button>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
        </div>

    <div class="grid grid-cols-3 gap-4 mt-4">
        @foreach($materis as $materi)
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $materi->judul }}</h3>
            <p class="text-gray-600 mb-4">{{ Str::limit($materi->deskripsi, 100) }}</p>
            <a href="{{ route('admin.materi.detail-materi', $materi->id) }}" class="text-blue-500 hover:underline">Lihat Konten</a>
            <div class="mt-4">
            <button onclick="openModal('editModal-{{ $materi->id }}')" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 transition ml-2">Edit</button>
                <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition ml-2">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal Tambah Materi -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4">Tambah Materi</h2>
            <form action="{{ route('admin.materi.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 mb-2">Judul</label>
                    <input type="text" name="judul" id="judul" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="w-full border border-gray-300 p-2 rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="urutan" class="block text-gray-700 mb-2">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="created_by" class="block text-gray-700 mb-2">Dibuat Oleh</label>
                    <select name="created_by" id="created_by" class="w-full border border-gray-300 p-2 rounded" required>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('addModal')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Materi -->
    @foreach($materis as $materi)
    <div id="editModal-{{ $materi->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4">Edit Materi</h2>
            <form action="{{ route('admin.materi.update', $materi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 mb-2">Judul</label>
                    <input type="text" name="judul" id="judul" class="w-full border border-gray-300 p-2 rounded" value="{{ $materi->judul }}" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="w-full border border-gray-300 p-2 rounded" required>{{ $materi->deskripsi }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="urutan" class="block text-gray-700 mb-2">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="w-full border border-gray-300 p-2 rounded" value="{{ $materi->urutan }}" required>
                </div>
                <div class="mb-4">
                    <label for="created_by" class="block text-gray-700 mb-2">Dibuat Oleh</label>
                    <select name="created_by" id="created_by" class="w-full border border-gray-300 p-2 rounded" required>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ $materi->created_by == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('editModal-{{ $materi->id }}')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
@endsection