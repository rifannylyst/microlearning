@extends('admin.layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">

    <h1 class="text-2xl font-bold text-gray-800 mb-4">
        {{ $quiz->judul }}
    </h1>

    <!-- BUTTON -->
    <div class="flex gap-2 mb-4">

        <button
            onclick="window.location.href='{{ route('admin.materi.detail-materi', $quiz->materi_id) }}'"
            class="bg-gray-500 text-white px-4 py-2 rounded">

            Kembali

        </button>

        <button
            onclick="tambahPertanyaan()"
            class="bg-blue-500 text-white px-4 py-2 rounded">

            Tambah Pertanyaan

        </button>

    </div>

    <!-- LIST PERTANYAAN -->
    @if($quiz->pertanyaan->isEmpty())

        <p>Belum ada pertanyaan</p>

    @else

        <div class="space-y-4">

            @foreach($quiz->pertanyaan as $pertanyaan)

                <div class="bg-white shadow p-4 rounded">

                    <!-- SOAL -->
                    <h2 class="text-lg font-bold">
                        {{ $pertanyaan->soal }}
                    </h2>

                    <p class="text-gray-500 mb-3">
                        {{ $pertanyaan->tipe }}
                    </p>

                    <!-- BUTTON PERTANYAAN -->
                    <div class="flex gap-2 mb-3">

                        <button
                            onclick="editPertanyaan(
                                '{{ $pertanyaan->id }}',
                                '{{ $pertanyaan->soal }}',
                                '{{ $pertanyaan->tipe }}'
                            )"

                            class="bg-yellow-500 text-white px-3 py-1 rounded">

                            Edit Pertanyaan

                        </button>

                        <form
                            action="{{ route('admin.pertanyaan.destroy', $pertanyaan->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Yakin hapus pertanyaan?')"
                                class="bg-red-500 text-white px-3 py-1 rounded">

                                Hapus Pertanyaan

                            </button>

                        </form>
                        
                        @if ($pertanyaan->jawaban->isEmpty())
                            
                      <button
                            onclick="tambahJawaban(
                                '{{ $pertanyaan->id }}',
                                '{{ $pertanyaan->tipe }}'
                            )"

                            class="bg-green-500 text-white px-3 py-1 rounded">

                            Tambah Jawaban

                        </button>
                        @endif
                    </div>

                    <!-- JAWABAN -->
                    @if($pertanyaan->jawaban->isEmpty())

                        <p class="text-gray-500">
                            Belum ada jawaban
                        </p>

                    @else

                        @foreach($pertanyaan->jawaban as $jawaban)

                            <div class="flex justify-between items-center border p-2 rounded mb-2">

                                <div>

                                    {{ $jawaban->jawaban }}

                                    @if($jawaban->is_benar)

                                        <span class="text-green-500 font-bold">
                                            (Benar)
                                        </span>

                                    @endif

                                </div>

                                <!-- BUTTON JAWABAN -->
                                <div class="flex gap-2">

                                    <button
                                        onclick="editJawaban(
                                            '{{ $jawaban->id }}',
                                            '{{ $jawaban->jawaban }}',
                                            '{{ $jawaban->is_benar }}'
                                        )"

                                        class="bg-yellow-500 text-white px-2 py-1 rounded">

                                        Edit

                                    </button>

                                    <form
                                        action="{{ route('admin.jawaban.destroy', $jawaban->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin hapus jawaban?')"
                                            class="bg-red-500 text-white px-2 py-1 rounded">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endforeach

                    @endif

                </div>

            @endforeach

        </div>

    @endif

</div>

<!-- MODAL TAMBAH PERTANYAAN -->
<div id="tambahPertanyaanModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <div class="bg-white p-6 rounded w-full max-w-md">

        <h2 class="text-xl font-bold mb-4">
            Tambah Pertanyaan
        </h2>

        <form
            method="POST"
            action="{{ route('admin.pertanyaan.store', $quiz->id) }}">

            @csrf

            <div class="mb-3">

                <label>Soal</label>

                <textarea
                    name="soal"
                    class="w-full border p-2 rounded"></textarea>

            </div>

            <div class="mb-3">

                <label>Tipe</label>

                <select
                    name="tipe"
                    class="w-full border p-2 rounded">

                    <option value="pilihan_ganda">
                        Pilihan Ganda
                    </option>

                    <option value="isian">
                        Isian
                    </option>

                </select>

            </div>

            <div class="flex justify-end">

                <button
                    type="button"
                    onclick="closeTambahPertanyaan()"
                    class="bg-gray-500 text-white px-4 py-2 rounded mr-2">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

<!-- MODAL TAMBAH JAWABAN -->
<div id="tambahJawabanModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <div class="bg-white p-6 rounded w-full max-w-md">

        <h2 class="text-xl font-bold mb-4">
            Tambah Jawaban
        </h2>

        <form
            method="POST"
            action="{{ route('admin.jawaban.store') }}">

            @csrf

            <input
                type="hidden"
                name="pertanyaan_id"
                id="jawabanPertanyaanId">

            <!-- PG -->
            <div id="formPG" class="hidden">

                <input type="text" name="a"
                    placeholder="Jawaban A"
                    class="w-full border p-2 rounded mb-2">

                <input type="text" name="b"
                    placeholder="Jawaban B"
                    class="w-full border p-2 rounded mb-2">

                <input type="text" name="c"
                    placeholder="Jawaban C"
                    class="w-full border p-2 rounded mb-2">

                <input type="text" name="d"
                    placeholder="Jawaban D"
                    class="w-full border p-2 rounded mb-2">

                <select
                    name="jawaban_benar"
                    class="w-full border p-2 rounded">

                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>

                </select>

            </div>

            <!-- ESSAY -->
            <div id="formEssay" class="hidden">

                <textarea
                    name="jawaban"
                    class="w-full border p-2 rounded"
                    rows="4"></textarea>

            </div>

            <div class="flex justify-end mt-4">

                <button
                    type="button"
                    onclick="closeTambahJawaban()"
                    class="bg-gray-500 text-white px-4 py-2 rounded mr-2">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

<!-- MODAL EDIT PERTANYAAN -->
<div id="editPertanyaanModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <div class="bg-white p-6 rounded w-full max-w-md">

        <h2 class="text-xl font-bold mb-4">
            Edit Pertanyaan
        </h2>

        <form
            id="editPertanyaanForm"
            method="POST">

            @csrf
            @method('PUT')

            <textarea
                name="soal"
                id="editSoal"
                class="w-full border p-2 rounded mb-3"></textarea>

            <select
                name="tipe"
                id="editTipe"
                class="w-full border p-2 rounded mb-3">

                <option value="pilihan_ganda">
                    Pilihan Ganda
                </option>

                <option value="isian">
                    Isian
                </option>

            </select>

            <div class="flex justify-end">

                <button
                    type="button"
                    onclick="closeEditPertanyaan()"
                    class="bg-gray-500 text-white px-4 py-2 rounded mr-2">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

<!-- MODAL EDIT JAWABAN -->
<div id="editJawabanModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <div class="bg-white p-6 rounded w-full max-w-md">

        <h2 class="text-xl font-bold mb-4">
            Edit Jawaban
        </h2>

        <form
            id="editJawabanForm"
            method="POST">

            @csrf
            @method('PUT')

            <input
                type="text"
                name="jawaban"
                id="editJawabanInput"
                class="w-full border p-2 rounded mb-3">

            <select
                name="is_benar"
                id="editIsBenar"
                class="w-full border p-2 rounded mb-3">

                <option value="1">Benar</option>
                <option value="0">Salah</option>

            </select>

            <div class="flex justify-end">

                <button
                    type="button"
                    onclick="closeEditJawaban()"
                    class="bg-gray-500 text-white px-4 py-2 rounded mr-2">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

<script>

    // TAMBAH PERTANYAAN
    function tambahPertanyaan()
    {
        document.getElementById('tambahPertanyaanModal')
            .classList.remove('hidden');
    }

    function closeTambahPertanyaan()
    {
        document.getElementById('tambahPertanyaanModal')
            .classList.add('hidden');
    }

    // TAMBAH JAWABAN
    function tambahJawaban(id, tipe)
    {
        document.getElementById('tambahJawabanModal')
            .classList.remove('hidden');

        document.getElementById('jawabanPertanyaanId').value = id;

        if(tipe == 'pilihan_ganda')
        {
            document.getElementById('formPG')
                .classList.remove('hidden');

            document.getElementById('formEssay')
                .classList.add('hidden');
        }
        else
        {
            document.getElementById('formEssay')
                .classList.remove('hidden');

            document.getElementById('formPG')
                .classList.add('hidden');
        }
    }

    function closeTambahJawaban()
    {
        document.getElementById('tambahJawabanModal')
            .classList.add('hidden');
    }

    // EDIT PERTANYAAN
    function editPertanyaan(id, soal, tipe)
    {
        document.getElementById('editPertanyaanModal')
            .classList.remove('hidden');

        document.getElementById('editSoal').value = soal;

        document.getElementById('editTipe').value = tipe;

        document.getElementById('editPertanyaanForm')
            .action = '/admin/pertanyaan/' + id;
    }

    function closeEditPertanyaan()
    {
        document.getElementById('editPertanyaanModal')
            .classList.add('hidden');
    }

    // EDIT JAWABAN
    function editJawaban(id, jawaban, benar)
    {
        document.getElementById('editJawabanModal')
            .classList.remove('hidden');

        document.getElementById('editJawabanInput').value = jawaban;

        document.getElementById('editIsBenar').value = benar;

        document.getElementById('editJawabanForm')
            .action = '/admin/jawaban/' + id;
    }

    function closeEditJawaban()
    {
        document.getElementById('editJawabanModal')
            .classList.add('hidden');
    }

</script>

@endsection