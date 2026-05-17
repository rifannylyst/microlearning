<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;

class HomeController extends Controller
{
    public function index()
    {
        $materi = Materi::latest('created_at')->take(3)->get();
        return view('content.home', compact('materi'));
    }
}
