@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $quiz->judul }}</h1>
        <button onclick="tambahPertanyaan()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition mb-4">
            Tambah Pertanyaan
        </button>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Pertanyaan</h2>
        @if($quiz->pertanyaan->isEmpty())
            <p class="text-gray-600">Belum ada pertanyaan terkait.</p>
        @else
            <div class="space-y-4">
                @foreach($quiz->pertanyaan as $pertanyaan)
                    <div class="bg-gray-100 p-4 rounded">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $pertanyaan->soal }}</h3>
                        <p class="text-lg">Tipe soal: {{ $pertanyaan->tipe }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal Tambah Pertanyaan -->
    <div id="tambahPertanyaanModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Pertanyaan</h2>
            <form id="tambahPertanyaanForm" method="POST" action="{{ route('admin.pertanyaan.store') }}">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                <div class="mb-4">
                    <label for="soal" class="block text-gray-700 mb-2">Soal</label>
                    <textarea name="soal" id="soal" class="w-full border border-gray-300 p-2 rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="tipe" class="block text-gray-700 mb-2">Tipe Soal</label>
                    <select name="tipe" id="tipe" class="w-full border border-gray-300 p-2 rounded" required>
                        <option value="">Pilih tipe soal</option>
                        <option value="pilihan_ganda">Pilihan Ganda</option>
                        <option value="isian_singkat">Isian Singkat</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('tambahPertanyaanModal')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition mr-2">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function tambahPertanyaan() {
            document.getElementById('tambahPertanyaanModal').classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection