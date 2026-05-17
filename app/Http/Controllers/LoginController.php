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

         return back()->withErrors([
              'email' => 'Email atau password salah.',
         ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
