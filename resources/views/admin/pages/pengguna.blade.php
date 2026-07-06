@extends('admin.layouts.app')
@section('content')
   <h2 class="text-2xl font-extrabold text-slate-800 mb-6 tracking-tight">Daftar Pengguna</h2>
   <div class="bg-white shadow-sm border border-slate-200/60 rounded-2xl p-6">
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
                            <a href="#" class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200/30 flex items-center justify-center transition-all duration-200 shadow-sm" title="Edit Pengguna">
                                <i class="bi bi-pencil-square text-sm"></i>
                            </a>
                            <form action="#" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 border border-red-200/30 flex items-center justify-center transition-all duration-200 shadow-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                    <i class="bi bi-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                     </td>
                </tr>
                @endforeach
             </tbody>
        </table>
    </div>
@endsection