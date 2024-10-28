<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Kembalikan tampilan untuk halaman awal
        return view('index'); // Pastikan Anda sudah membuat view 'home.blade.php'
    }
}

