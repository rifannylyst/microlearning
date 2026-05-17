@extends('admin.layouts.app')
@section('content')
   <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Pengguna</h2>
   <div class="bg-white shadow-md rounded-lg p-6">
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
                        <a href="#" class="text-blue-500 hover:underline">Edit</a>
                        <form action="#" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
             </tbody>
        </table>
    </div>
@endsection