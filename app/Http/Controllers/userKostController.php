<?php

// File: app/Http/Controllers/KostController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userKostController extends Controller
{
    public function showRentedKost()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mengambil data kost yang disewa oleh user
        $kost = $user->rentedKost;

        // Menampilkan data kost pada view
        return view('user.kost', compact('kost'));
    }
}

