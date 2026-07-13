@extends('admin.layouts.app')

@section('content')

<h2 class="text-2xl font-semibold text-gray-800 mb-6">
    Detail Materi
</h2>

<a href="{{ route('admin.materi') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition mb-4 inline-block">
    Kembali
</a>

<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-semibold text-gray-800 mb-2"> {{ $materi->judul }} </h3>
    <p class="text-gray-600 mb-4"> {{ $materi->deskripsi }} </p>
    <p class="text-sm text-gray-500"> Dibuat oleh: {{ $materi->user->name ?? 'Unknown' }} </p>

    <!-- KONTEN -->
    <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-2">
        Konten Terkait
    </h3>

    @if($materi->konten_materi->isEmpty())
        <p class="text-gray-600"> Belum ada konten terkait.</p>
    @else
        <div class="grid grid-cols-2 gap-4">
            @foreach($materi->konten_materi as $konten)
            <div class="bg-gray-100 p-3 rounded">
                <h4 class="text-md font-semibold text-gray-800 mb-2 capitalize"> {{ $konten->tipe }} </h4>
                {{-- =========================
                    JIKA MENGGUNAKAN LINK
                ========================== --}}
                @if($konten->link)
                    @if($konten->tipe == 'video')
                        @php
                            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $konten->link, $matches);
                            $youtubeId = $matches[1] ?? null;
                        @endphp
                        @if($youtubeId)
                            <iframe class="w-full h-64 rounded mb-2" src="https://www.youtube.com/embed/{{ $youtubeId }}" allowfullscreen> </iframe>
                        @else
                            <a href="{{ $konten->link }}" target="_blank" class="text-blue-500 underline">Buka Video</a>
                        @endif
                    @else
                        <a href="{{ $konten->link }}" target="_blank" class="text-blue-500 underline">
                            Buka Link
                        </a>
                    @endif
                {{-- =========================
                    JIKA MENGGUNAKAN FILE
                ========================== --}}
                @elseif($konten->isi)
                    @if($konten->tipe == 'materi')
                        <iframe src="{{ asset('storage/'.$konten->isi) }}" class="w-full h-64 rounded mb-2"> </iframe>
                    @elseif($konten->tipe == 'video')
                        <video controls class="w-full rounded mb-2">
                            <source src="{{ asset('storage/'.$konten->isi) }}">
                        </video>
                    @elseif($konten->tipe == 'audio')
                        <audio controls class="w-full mb-2">
                            <source src="{{ asset('storage/'.$konten->isi) }}">
                        </audio>
                    @endif
                @endif
                @if($konten->deskripsi)
                    <p class="text-gray-700 mb-2">
                        {{ $konten->deskripsi }}
                    </p>
                @endif
                @if($konten->durasi)
                    <p class="text-sm text-gray-500 mb-3">
                        Durasi: {{ $konten->durasi }} menit
                    </p>
                @endif
                <!-- BUTTON -->
                <div class="flex gap-2">
                    <button
                        onclick='editModal(
                            {{ $konten->id }},
                            @json($konten->tipe),
                            @json($konten->link),
                            @json($konten->deskripsi),
                            {{ $konten->durasi ?? "null" }}
                        )'
                        class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <button onclick="deleteModal('{{ $konten->id }}')" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <button onclick="openModal('tambahKontenModal')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition mt-4">
        Tambah Konten
    </button>
    <!-- QUIZ -->
    <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-2 py-4">
        Quiz Terkait
    </h3>

    @if($materi->quiz->isEmpty())
        <p class="text-gray-600">
            Belum ada quiz terkait.
        </p>
    @else
        <div class="grid grid-cols-2 gap-4">
            @foreach($materi->quiz as $quiz)
            <div class="bg-gray-100 p-3 rounded">
                <h4 class="text-md font-semibold text-gray-800 mb-1">
                    {{ $quiz->judul }}
                </h4>
                
                @if($quiz->pertanyaan->count() > 0)
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $quiz->pertanyaan->count() }} pertanyaan
                    </p>
                @endif
                <!-- BUTTON -->
                <div class="flex gap-2">
                    <a href="{{ route('admin.quiz.detail-quiz', $quiz->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-2 px-3 rounded transition">
                    <i class="bi bi-eye"></i>
                </a>
                    <!-- EDIT -->
                    <button onclick="editQuizModal( '{{ $quiz->id }}', '{{ $quiz->judul }}' )" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition">
                        <i class="bi bi-pencil-fill"></i>
                    </button>

                    <!-- DELETE -->
                    <button onclick="deleteQuizModal('{{ $quiz->id }}')" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                </div>
            </div>
            @endforeach
        </div>
    @endif

    <button onclick="openModal('tambahQuizModal')" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition mt-4">
        <i class="bi bi-plus-circle"></i>
        Tambah Quiz
    </button>

    
</div>



<!-- =========================
    MODAL TAMBAH KONTEN
========================= -->
<div id="tambahKontenModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">
            Tambah Konten
        </h2>
        <form action="{{ route('admin.materi.konten.store', $materi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="materi_id" value="{{ $materi->id }}">
            <!-- TIPE -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Tipe Konten
                </label>
                <select name="tipe" id="tipeKonten" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="">Pilih tipe</option>
                    <option value="materi">Materi</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>
                </select>
            </div>
            <!-- JENIS INPUT -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Jenis Konten
                </label>
                <select id="jenisInput" onchange="toggleJenisInput()" class="w-full border border-gray-300 p-2 rounded">
                    <option value="">Pilih jenis input</option>
                    <option value="file">File Upload</option>
                    <option value="link">Link Eksternal</option>
                </select>
            </div>
            <!-- FILE -->
            <div class="mb-4 hidden" id="fileInput">
                <label class="block text-gray-700 mb-2">
                    Upload File
                </label>
                <input type="file" name="isi" id="isi" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- LINK -->
            <div class="mb-4 hidden" id="linkInput">
                <label class="block text-gray-700 mb-2">
                    Link Eksternal
                </label>
                <input type="url" name="link" placeholder="https://youtube.com/..." class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 p-2 rounded"></textarea>
            </div>

            <!-- DURASI -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Durasi (opsional)
                </label>
                <input type="number" name="durasi" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahKontenModal')" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL TAMBAH QUIZ -->
<div id="tambahQuizModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">
            Tambah Quiz
        </h2>
        <form action="{{ route('admin.materi.quiz.store', $materi->id) }}" method="POST">
            @csrf
            <input type="hidden" name="materi_id" value="{{ $materi->id }}">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Judul Quiz
                </label>
                <input type="text" name="judul" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahQuizModal')" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- =========================
    MODAL EDIT
========================= -->
<div id="editKontenModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
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
                    <option value="materi">Materi</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Upload File Baru
                </label>
                <input type="file" name="isi" class="w-full border border-gray-300 p-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Link Eksternal
                </label>
                <input type="url" name="link" id="editLink" class="w-full border border-gray-300 p-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Deskripsi
                </label>

                <textarea name="deskripsi" id="editDeskripsi" rows="3" class="w-full border border-gray-300 p-2 rounded"></textarea>
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

<!-- =========================
    MODAL HAPUS
========================= -->
<div id="deleteKontenModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white p-6 rounded shadow-lg w-full max-w-sm">
        <h2 class="text-xl font-semibold mb-4">
            Konfirmasi Hapus
        </h2>
        <p class="mb-6 text-gray-700">
            Apakah yakin ingin menghapus konten ini?
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

<!-- MODAL EDIT QUIZ -->
<div id="editQuizModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">
            Edit Quiz
        </h2>
        <form id="editQuizForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">
                    Judul Quiz
                </label>
                <input type="text" name="judul" id="editQuizJudul" class="w-full border border-gray-300 p-2 rounded" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editQuizModal')" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Batal
                </button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL DELETE QUIZ -->
<div id="deleteQuizModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-sm">
        <h2 class="text-xl font-semibold mb-4">
            Konfirmasi Hapus
        </h2>
        <p class="mb-6 text-gray-700">
            Apakah yakin ingin menghapus quiz ini?
        </p>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('deleteQuizModal')" class="bg-gray-500 text-white px-4 py-2 rounded">
                Batal
            </button>
            <form id="deleteQuizForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<!-- =========================
    SCRIPT
========================= -->
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function toggleJenisInput() {
        const jenis = document.getElementById('jenisInput').value;
        const fileInput = document.getElementById('fileInput');
        const linkInput = document.getElementById('linkInput');

        fileInput.classList.add('hidden');
        linkInput.classList.add('hidden');

        if (jenis === 'file') {
            fileInput.classList.remove('hidden');
        } else if (jenis === 'link') {
            linkInput.classList.remove('hidden');
        }
    }

    function editModal(id, tipe, link, deskripsi, durasi) {

        document.getElementById('editForm').action =
            `/admin/materi/{{ $materi->id }}/konten/${id}`;

        console.log(document.getElementById('editForm').action);

        openModal('editKontenModal');

        document.getElementById('editTipe').value = tipe;
        document.getElementById('editLink').value = link;
        document.getElementById('editDeskripsi').value = deskripsi;
        document.getElementById('editDurasi').value = durasi;
    }

    function deleteModal(id) {

        openModal('deleteKontenModal');

        document.getElementById('deleteForm').action =
            `/admin/materi/{{ $materi->id }}/konten/${id}`;
    }

    function editQuizModal(id, judul) {

        openModal('editQuizModal');

        document.getElementById('editQuizJudul').value = judul;
        document.getElementById('editQuizForm').action =
            `/admin/quiz/${id}`;
    }

    function deleteQuizModal(id) {

        openModal('deleteQuizModal');
        document.getElementById('deleteQuizForm').action =
            `/admin/quiz/${id}`;
    }

    document.getElementById('tipeKonten').addEventListener('change', function () {
        const fileInput = document.getElementById('isi');

        switch (this.value) {
            case 'video':
                fileInput.accept = '.mp4';
                break;

            case 'audio':
                fileInput.accept = '.mp3';
                break;

            case 'materi':
                fileInput.accept = '.pdf,.doc,.docx';
                break;

            default:
                fileInput.accept = '';
        }

        // Menghapus file yang sudah dipilih ketika tipe berubah
        fileInput.value = '';
    });

</script>

@endsection