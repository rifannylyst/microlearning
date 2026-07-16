<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('formLogin');
    }

    public function login(Request $request){
       $credentials = $request->only('email', 'password');

       if (Auth::attempt($credentials)) {
           $request->session()->regenerate();

           //Ambil user yang login
           $user = Auth::user();

           //cek role user
           if ($user->role === 'admin') {
               return redirect()->route('admin.dashboard');
           } else {
               return redirect()->route('home');
           }
       }

        return back()
        ->withInput($request->only('email'))
        ->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register()
    {
        return view('formRegister');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ],
        [
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'email.unique' => 'Email sudah digunakan.',
        'email.email' => 'Format email tidak valid.',
        'name.required' => 'Nama wajib diisi.',
        'name.string' => 'Nama harus berupa teks.',
        'name.max' => 'Nama maksimal 255 karakter.',]);

        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'user'; // Set role default sebagai user
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

}
