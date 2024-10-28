<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost; // Pastikan model Kost di-import

class KostController extends Controller
{
    public function index()
    {
        // Mengambil semua data kost dari database
        $kosts = Kost::all();

        // Me-return view 'admin/kost.blade.php' dengan data kost
        return view('admin.kost', compact('kosts'));
    }
}
