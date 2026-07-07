@extends('admin.layouts.app')
@section('content')
   <h2 class="text-2xl font-extrabold text-slate-800 mb-6 tracking-tight">Daftar Pengguna</h2>
   <div class="bg-white shadow-sm border border-slate-200/60 rounded-2xl p-6">
        <div class="flex justify-between items-center mb-8">
            <div>
                <!-- space for visual alignment -->
            </div>
            <div class="flex flex-wrap gap-2.5">
                <button
                    type="button"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2.5 rounded-xl text-xs font-semibold shadow-sm hover:shadow shadow-blue-500/10 transition-all duration-200"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                    <i class="bi bi-plus-lg"></i>
                    <span>Tambah Pengguna</span>
                </button>
            </div>
        </div>
        <table class="min-w-full table-auto">
             <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                 <th class="py-3 px-6 text-left">Nama</th>
                 <th class="py-3 px-6 text-left">Email</th>
                 <th class="py-3 px-6 text-left">Role</th>
                 <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
             </thead>
             <tbody class="text-gray-600 text-sm font-light">
                @foreach ($pengguna as $user)
                 <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                    <td class="py-3 px-6 text-left">{{ $user->role }}</td>
                     <td class="py-3 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" class="w-8 h-8 rounded-lg bg-yellow-50 hover:bg-yellow-100 text-yellow-600 border border-yellow-200/30 flex items-center justify-center transition-all duration-200 shadow-sm" onclick="editPengguna({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')">
                                <i class="bi bi-pencil text-sm"></i>
                            </button>
                            <button type="button" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 border border-red-200/30 flex items-center justify-center transition-all duration-200 shadow-sm" onclick="hapusPengguna({{ $user->id }})">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                        </div>
                     </td>
                </tr>
                @endforeach
             </tbody>
        </table>
    </div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.pengguna.store') }}" method="POST">
            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengguna</h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Nama</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>
                            
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required>
                        <button
                            type="button"
                            id="togglePassword"
                            class="btn btn-outline-secondary">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select
                            name="role"
                            class="form-control"
                            required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <form id="formEdit" method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Pengguna</h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                <div class="mb-3">
                    <label>Nama</label>
                    <input
                        type="text"
                        id="editName"
                        name="name"
                        class="form-control mb-3">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input
                        type="email"
                        id="editEmail"
                        name="email"
                        class="form-control mb-3">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <div class="input-group mb-3">
                    <input
                        type="password"
                        id="editPassword"
                        name="password"
                        class="form-control mb-3">
                        <button
                            type="button"
                            id="toggleEditPassword"
                            class="btn btn-outline-secondary mb-3">
                            <i id="eyeIconEdit" class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select
                        id="editRole"
                        name="role"
                        class="form-control mb-3">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">
                        Update
                    </button>

                </div>

            </div>

        </form>
    </div>
</div>
<script>
    function editPengguna(id, name, email, role) {
        const formEdit = document.getElementById('formEdit');
        formEdit.action = `/admin/pengguna/${id}`;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        const modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
        modalEdit.show();
    }

    function hapusPengguna(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
            const formDelete = document.createElement('form');
            formDelete.method = 'POST';
            formDelete.action = `/admin/pengguna/${id}`;
            formDelete.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(formDelete);
            formDelete.submit();
        }
    }

    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    const icon = document.getElementById('eyeIcon');

    toggle.addEventListener('click', function () {

        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }

    });

    const editPassword = document.getElementById('editPassword');
    const toggleEdit = document.getElementById('toggleEditPassword');
    const iconEdit = document.getElementById('eyeIconEdit');
    toggleEdit.addEventListener('click', function () {

        if (editPassword.type === 'editPassword') {
            editPassword.type = 'text';
            iconEdit.classList.remove('bi-eye');
            iconEdit.classList.add('bi-eye-slash');
        } else {
            editPassword.type = 'editPassword';
            iconEdit.classList.remove('bi-eye-slash');
            iconEdit.classList.add('bi-eye');
        }

    });
</script>
@endsection