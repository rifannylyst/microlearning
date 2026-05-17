@extends('admin.layouts.app')

@section('content')
<h2 class="text-2xl font-semibold text-gray-800 mb-6">Detail Materi</h2>

<a href="{{ route('admin.materi') }}" 
   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition mb-4 inline-block">
    Kembali
</a>

<button onclick="openModal('tambahKontenModal')" 
    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition mb-4">
    Tambah Konten
</button>

<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $materi->judul }}</h3>
    <p class="text-gray-600 mb-4">{{ $materi->deskripsi }}</p>
    <p class="text-sm text-gray-500">Urutan: {{ $materi->urutan }}</p>

    {{-- tampilkan nama user (lebih baik dari created_by) --}}
    <p class="text-sm text-gray-500">
        Dibuat oleh: {{ $materi->user->name ?? 'Unknown' }}
    </p>

    <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-2">
        Konten Terkait
    </h3>

    @if($materi->konten_materi->isEmpty())
        <p class="text-gray-600">Belum ada konten terkait.</p>
    @else
        <div class="grid grid-cols-2 gap-4">

            @foreach($materi->konten_materi as $konten)
            <div class="bg-gray-100 p-3 rounded">

                <h4 class="text-md font-semibold text-gray-800 mb-1 capitalize">
                    {{ $konten->tipe }}
                </h4>

                {{-- Tampilkan konten sesuai tipe --}}
                @if($konten->tipe == 'gambar')
                    <img src="{{ asset('storage/'.$konten->isi) }}" 
                        class="w-full h-40 object-cover rounded mb-2">

                @elseif($konten->tipe == 'video')
                    <video controls class="w-full rounded mb-2">
                        <source src="{{ asset('storage/'.$konten->isi) }}">
                    </video>

                @elseif($konten->tipe == 'audio')
                    <audio controls class="w-full mb-2">
                        <source src="{{ asset('storage/'.$konten->isi) }}">
                    </audio>
                @endif

                @if($konten->deskripsi)
                <p class="text-gray-700 mb-2">
                    {{ $konten->deskripsi }}
                </p>
                @endif

                <p class="text-sm text-gray-500">
                    Urutan: {{ $konten->urutan }}
                </p>

                @if($konten->durasi)
                <p class="text-sm text-gray-500">
                    Durasi: {{ $konten->durasi }} menit
                </p>
                @endif
                <button onclick="editModal('{{ $konten->id }}', '{{ $konten->tipe }}', '{{ $konten->isi }}', '{{ $konten->deskripsi }}', '{{ $konten->urutan }}', '{{ $konten->durasi }}')" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition">
                <i class="bi bi-pencil-fill"></i>
                </button>

                <button onclick="deleteModal('{{ $konten->id }}')" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition">
                <i class="bi bi-trash-fill"></i>
                </button>
            </div>
            @endforeach
            
        </div>
    @endif

    <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-2">
        Quiz Terkait
    </h3>

    @if($materi->quiz->isEmpty())
        <p class="text-gray-600">Belum ada quiz terkait.</p>
    @else
        <div class="grid grid-cols-2 gap-4">
            @foreach($materi->quiz as $quiz)
            <div class="bg-gray-100 p-3 rounded">
                <h4 class="text-md font-semibold text-gray-800 mb-1">
                    {{ $quiz->judul }}
                </h4>
                <a href="{{ route('admin.quiz.detail-quiz', $quiz->id) }}" class="text-blue-500 hover:underline">
                    Lihat Detail Quiz
                </a>
                @if($quiz->pertanyaan->count() > 0)
                    <p class="text-sm text-gray-500">
                        {{ $quiz->pertanyaan->count() }} pertanyaan
                    </p>
                @endif
            </div>
            @endforeach
        </div>
    @endif

    <button onclick="openModal('tambahQuizModal')" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition mt-4">
        <i class="bi bi-plus-circle"></i> Tambah Quiz
    </button>
</div>

<!-- Modal Tambah Konten -->
<div id="tambahKontenModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">Tambah Konten</h2>
        <form action="{{ route('admin.materi.konten.store', $materi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="materi_id" value="{{ $materi->id }}">

            <div class="mb-4">
                <label for="tipe" class="block text-gray-700 mb-2">Tipe Konten</label>
                <select name="tipe" id="tipe" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="">Pilih tipe konten</option>
                    <option value="gambar">Gambar</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="isi" class="block text-gray-700 mb-2">File Konten</label>
                <input type="file" name="isi" id="isi" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 mb-2">Deskripsi (opsional)</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full border border-gray-300 p-2 rounded" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label for="urutan" class="block text-gray-700 mb-2">Urutan</label>
                <input type="number" name="urutan" id="urutan" class="w-full border border-gray-300 p-2 rounded" value="{{ $nextUrutan }}" required>
            </div>

            <div class="mb-4">
                <label for="durasi" class="block text-gray-700 mb-2">Durasi (menit, opsional)</label>
                <input type="number" name="durasi" id="durasi" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahKontenModal')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Quiz -->
<div id="tambahQuizModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">Tambah Quiz</h2>
        <form action="{{ route('admin.materi.quiz.store', $materi->id) }}" method="POST">
            @csrf
            <input type="hidden" name="materi_id" value="{{ $materi->id }}">

            <div class="mb-4">
                <label for="judul" class="block text-gray-700 mb-2">Judul Quiz</label>
                <input type="text" name="judul" id="judul" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahQuizModal')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Batal</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Simpan</button>
            </div>
        </form>
    </div>

<!-- Modal Edit -->
<!-- Modal Edit Konten -->
<div id="editKontenModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">
            Edit Konten
        </h2>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Tipe Konten
                </label>
                <select name="tipe" id="editTipe" class="w-full border border-gray-300 p-2 rounded">
                    <option value="gambar">Gambar</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    File Baru (opsional)
                </label>
                <input type="file"
                    name="isi"
                    class="w-full border border-gray-300 p-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea name="deskripsi" id="editDeskripsi" rows="3" class="w-full border border-gray-300 p-2 rounded"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Urutan
                </label>
                <input type="number" name="urutan" id="editUrutan" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Durasi
                </label>
                <input type="number" name="durasi" id="editDurasi" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editKontenModal')" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus -->
<div id="deleteKontenModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-sm">
        <h2 class="text-xl font-semibold mb-4">
            Konfirmasi Hapus
        </h2>
        <p class="mb-6 text-gray-700">
            Apakah Anda yakin ingin menghapus konten ini? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('deleteKontenModal')" class="bg-gray-500 text-white px-4 py-2 rounded">
                Batal
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function editModal(id, tipe, isi, deskripsi, urutan, durasi) {
        // Logika untuk membuka modal edit dan mengisi form dengan data konten yang dipilih
        openModal('editKontenModal');

        document.getElementById('editTipe').value = tipe;
        document.getElementById('editDeskripsi').value = deskripsi;
        document.getElementById('editUrutan').value = urutan;
        document.getElementById('editDurasi').value = durasi;

        // Set action form edit dengan ID konten yang akan diedit
        document.getElementById('editForm').action = `/admin/materi/{{ $materi->id }}/konten/${id}`;
    }
    function deleteModal(id) {
        // Logika untuk membuka modal konfirmasi hapus
        openModal('deleteKontenModal');
        // Set action form hapus dengan ID konten yang akan dihapus
        document.getElementById('deleteForm').action = `/admin/materi/{{ $materi->id }}/konten/${id}`;
    }
</script>
@endsection