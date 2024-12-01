<?php
namespace App\Http\Controllers;
use App\Models\Kost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        // Mendapatkan semua data kost tanpa filter id pemilik
        $kost = Kost::all();
        $kost = Kost::query();

        if ($request->filled('harga')) {
            $kost->where('harga_sewa', '<=', $request->input('harga'));
        }

        if ($request->filled('jenis_kost')) {
            $kost->where('jenis_kost', $request->input('jenis_kost'));
        }

        if ($request->filled(key: 'kota')) {
            $kost->where('kota', 'like', '%' . $request->input('kota') . '%');
        }

        $kost = $kost->get();
        // Kembalikan tampilan untuk halaman awal
        return view('index', data: compact('kost'));
    }
}

