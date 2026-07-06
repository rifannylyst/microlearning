@extends('admin.layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Data Materi Pembelajaran</h2>
            <p class="text-xs text-slate-400 mt-1">Kelola topik belajar, urutan materi, dan konten pembelajaran multi-format.</p>
        </div>
        <div class="flex flex-wrap gap-2.5">
            <button onclick="openModal('addModal')" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2.5 rounded-xl text-xs font-semibold shadow-sm hover:shadow shadow-blue-500/10 transition-all duration-200">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Materi Baru</span>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-semibold border border-slate-200/60 transition-all duration-200">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($materis as $materi)
        <div class="group bg-white rounded-2xl border border-slate-100 hover:border-blue-500/20 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full overflow-hidden">
            {{-- Header card --}}
            <div class="bg-gradient-to-tr from-blue-50 to-indigo-50/50 relative overflow-hidden h-36 flex flex-col justify-between p-4 border-b border-slate-100">
                <!-- Glow bubble backdrop -->
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-blue-200/50 to-indigo-200/50 rounded-full filter blur-xl opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>
                <!-- Grid pattern -->
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:1rem_1rem] opacity-35"></div>
                
                <div class="flex justify-between items-start w-full relative z-20">
                    <span class="text-[9px] font-bold px-2 py-0.5 bg-blue-100 text-blue-700 rounded uppercase tracking-wider">
                        Materi {{ $materi->urutan }}
                    </span>
                </div>
                <div class="relative z-20">
                    <div class="w-8 h-8 rounded-lg bg-blue-600/10 flex items-center justify-center text-blue-600 border border-blue-200/30 group-hover:scale-105 transition-transform duration-300">
                        <i class="bi bi-journal-code text-sm"></i>
                    </div>
                </div>
            </div>

            {{-- Card Body --}}
            <div class="p-5 flex flex-col flex-1">
                <h3 class="font-extrabold text-slate-800 text-base group-hover:text-blue-600 transition-colors line-clamp-1 mb-1">
                    {{ $materi->judul }}
                </h3>
                <p class="text-[10px] text-slate-400 font-semibold mb-3">
                    Dibuat oleh: {{ $materi->user->name ?? 'Admin' }}
                </p>
                <p class="text-xs text-slate-500 leading-relaxed flex-1 line-clamp-3 mb-6">
                    {{ $materi->deskripsi }}
                </p>

                {{-- Interactive Buttons --}}
                <div class="flex items-center gap-2 mt-auto pt-4 border-t border-slate-50">
                    <a href="{{ route('admin.materi.detail-materi', $materi->id) }}"
                       class="flex-1 flex items-center justify-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-600 hover:text-blue-700 py-2.5 px-3 rounded-xl text-xs font-semibold transition-all duration-200"
                       title="Lihat Konten">
                        <i class="bi bi-eye text-sm"></i>
                        <span>Detail Konten</span>
                    </a>
                    <button onclick="openModal('editModal-{{ $materi->id }}')" 
                            class="w-10 h-10 flex items-center justify-center bg-amber-50 hover:bg-amber-100 text-amber-600 hover:text-amber-700 rounded-xl transition-all duration-200" 
                            title="Edit Materi">
                        <i class="bi bi-pencil-square text-sm"></i>
                    </button>
                    <form action="{{ route('admin.materi.destroy', $materi->id) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-10 h-10 flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 rounded-xl transition-all duration-200"
                                title="Hapus Materi">
                            <i class="bi bi-trash text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal Tambah Materi -->
    <div id="addModal" class="fixed inset-0 bg-black/60 z-50 overflow-y-auto p-4 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md my-auto relative z-10 border border-slate-100/50">
            <h2 class="text-lg font-extrabold text-slate-800 mb-5">Tambah Materi</h2>
            <form action="{{ route('admin.materi.store') }}" method="POST" class="m-0">
                @csrf
                <div class="mb-4">
                    <label for="judul" class="block text-xs font-bold text-slate-600 mb-2">Judul</label>
                    <input type="text" name="judul" id="judul" class="w-full border border-slate-200 p-2.5 rounded-xl text-xs font-medium focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-xs font-bold text-slate-600 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border border-slate-200 p-2.5 rounded-xl text-xs font-medium focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="urutan" class="block text-xs font-bold text-slate-600 mb-2">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="w-full border border-slate-200 p-2.5 rounded-xl text-xs font-medium focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all" required>
                </div>
                <div class="mb-5">
                    <label for="created_by" class="block text-xs font-bold text-slate-600 mb-2">Dibuat Oleh</label>
                    <select name="created_by" id="created_by" class="w-full border border-slate-200 p-2.5 rounded-xl text-xs font-medium focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all" required>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2.5">
                    <button type="button" onclick="closeModal('addModal')" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-xs font-bold transition">Batal</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-sm shadow-blue-500/10 hover:shadow transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Materi -->
    @foreach($materis as $materi)
    <div id="editModal-{{ $materi->id }}" class="fixed inset-0 bg-black/60 z-50 overflow-y-auto p-4 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md my-auto relative z-10 border border-slate-100/50">
            <h2 class="text-lg font-extrabold text-slate-800 mb-5">Edit Materi</h2>
            <form action="{{ route('admin.materi.update', $materi->id) }}" method="POST" class="m-0">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="judul" class="block text-xs font-bold text-slate-600 mb-2">Judul</label>
                    <input type="text" name="judul" id="judul" class="w-full border border-slate-200 p-2.5 rounded-xl text-xs font-medium focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all" value="{{ $materi->judul }}" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-xs font-bold text-slate-600 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border border-slate-200 p-2.5 rounded-xl text-xs font-medium focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all" required>{{ $materi->deskripsi }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="urutan" class="block text-xs font-bold text-slate-600 mb-2">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="w-full border border-slate-200 p-2.5 rounded-xl text-xs font-medium focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all" value="{{ $materi->urutan }}" required>
                </div>
                <div class="mb-5">
                    <label for="created_by" class="block text-xs font-bold text-slate-600 mb-2">Dibuat Oleh</label>
                    <select name="created_by" id="created_by" class="w-full border border-slate-200 p-2.5 rounded-xl text-xs font-medium focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all" required>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ $materi->created_by == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2.5">
                    <button type="button" onclick="closeModal('editModal-{{ $materi->id }}')" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-xs font-bold transition">Batal</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-sm shadow-blue-500/10 hover:shadow transition">Simpan</button>
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