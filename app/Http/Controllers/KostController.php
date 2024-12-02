<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
class KostController extends Controller
{


    // untuk admin
    public function indexAdmin()
    {
        // Mendapatkan semua data kost tanpa filter id pemilik
        $kost = Kost::all();

        // Mengembalikan view dengan data kost untuk admin
        return view('admin.kost', compact('kost'));
    }


    // fungsi untuk filtering
    public function indexUser(Request $request)
    {
        // Inisialisasi query Kost
        $kostQuery = Kost::query();

        // Filter berdasarkan harga
        if ($request->filled('harga')) {
            $kostQuery->where('harga_sewa', '<=', $request->input('harga'));
        }

        // Filter berdasarkan jenis kost
        if ($request->filled('jenis_kost')) {
            $kostQuery->where('jenis_kost', $request->input('jenis_kost'));
        }

        // Filter berdasarkan kota
        if ($request->filled('kota')) {
            $kostQuery->where('kota', 'like', '%' . $request->input('kota') . '%');
        }

        // Ambil data kost sesuai filter
        $kost = $kostQuery->get();

        // Kembalikan view ke user.dashboard dengan data kost
        return view('user.dashboard', compact('kost'));
    }



    // untuk owner
    public function index1()
    {
        // Mendapatkan data kost yang dimiliki oleh pemilik yang sedang login
        $kost = Kost::where('id_pemilik', auth()->user()->id)->get();

        // Mengembalikan view dengan data kost
        return view('owner.kost', compact('kost'));
    }


    // Menampilkan daftar kost milik pemilik tertentu
    public function index()
    {
        // Ambil data kost berdasarkan id pemilik yang sedang login
        $kost = Kost::where('id_pemilik', auth()->user()->id)->get();

        // Mengembalikan view dengan data kost
        return view('owner.dashboard', compact('kost'));
    }


    public function show($id)
    {
        // Ambil data kost berdasarkan ID
        $kost = Kost::findOrFail($id);

        // Menampilkan tampilan detail kost
        return view('owner.kost.show', compact('kost'));
    }

    public function showUser($id)
    {
        // Ambil data kost berdasarkan ID
        $kost = Kost::findOrFail($id);

        // Menampilkan tampilan detail kost
        return view('user.kost.show', compact('kost'));
    }



    // Menampilkan form untuk menambahkan kost baru
    public function create()
    {

        return view('owner.kostCreate');
    }

    // Menyimpan data kost baru
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_kost' => 'required|string|max:255',
            'tipe_kost' => 'required|string|max:255',
            'jenis_kost' => 'required|string|max:255',
            'jumlah_kamar' => 'required|integer',
            'tanggal_tagih' => 'required|date',
            'nama_pemilik' => 'required|string',
            'nama_bank' => 'required|string',
            'no_rekening' => 'required|string|max:50',
            'foto_bangunan_utama' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kamar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kamar_mandi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_interior' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'provinsi' => 'required|string|max:25',
            'kota' => 'required|string|max:25',
            'kecamatan' => 'required|string|max:25',
            'kelurahan' => 'required|string|max:25',
            'alamat' => 'required|string|max:255',
            'harga_sewa' => 'required|integer',
            'kontak' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas_kost' => 'required|string',
            'link_gmaps' => 'nullable|string',
        ]);

        // Menyimpan gambar
        // Menyimpan gambar di subfolder masing-masing
        $foto_bangunan_utama = $request->file('foto_bangunan_utama')->store('foto_kost/foto_bangunan_utama', 'public');
        $foto_kamar = $request->file('foto_kamar')->store('foto_kost/foto_kamar', 'public');
        $foto_kamar_mandi = $request->file('foto_kamar_mandi')->store('foto_kost/foto_kamar_mandi', 'public');
        $foto_interior = $request->file('foto_interior')->store('foto_kost/foto_interior', 'public');



        // Menyimpan data kost dengan path gambar
        $kost = Kost::create([
            'nama_kost' => $validated['nama_kost'],
            'tipe_kost' => $validated['tipe_kost'],
            'jenis_kost' => $validated['jenis_kost'],
            'jumlah_kamar' => $validated['jumlah_kamar'],
            'tanggal_tagih' => $validated['tanggal_tagih'],
            'nama_pemilik' => $validated['nama_pemilik'],
            'nama_bank' => $validated['nama_bank'],
            'no_rekening' => $validated['no_rekening'],
            'foto_bangunan_utama' => basename($foto_bangunan_utama),
            'foto_kamar' => basename($foto_kamar),
            'foto_kamar_mandi' => basename($foto_kamar_mandi),
            'foto_interior' => basename($foto_interior),
            'provinsi' => $validated['provinsi'],
            'kota' => $validated['kota'],
            'kecamatan' => $validated['kecamatan'],
            'kelurahan' => $validated['kelurahan'],
            'alamat' => $validated['alamat'],
            'harga_sewa' => $validated['harga_sewa'],
            'kontak' => $validated['kontak'],
            'deskripsi' => $validated['deskripsi'],
            'fasilitas_kost' => $validated['fasilitas_kost'],
            'link_gmaps' => $validated['link_gmaps'],
            'id_pemilik' => Auth::id(), // Set id_pemilik langsung saat pembuatan
        ]);

        // Set id_pemilik berdasarkan pengguna yang sedang login
//$kost->id_pemilik = Auth::id();  // Menggunakan ID pengguna yang sedang login

        // Simpan ke database
        $kost->save();

        return redirect()->route('kost.index1')->with('success', 'Data kost berhasil ditambahkan');
    }


    // Menampilkan form untuk mengedit kost
    public function edit($id_kost)
    {
        $kost = Kost::findOrFail($id_kost);
        return view('owner.kostEdit', compact('kost'));
    }


    // Memperbarui data kost
    public function update(Request $request, $id_kost)
    {
        $kost = Kost::findOrFail($id_kost);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kost' => 'required|string|max:255',
            'tipe_kost' => 'required|string|max:255',
            'jenis_kost' => 'required|string|max:255',
            'jumlah_kamar' => 'required|integer',
            'tanggal_tagih' => 'required|date',
            'nama_pemilik' => 'required|string',
            'nama_bank' => 'required|string',
            'no_rekening' => 'required|string|max:50',
            'foto_bangunan_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kamar_mandi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_interior' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'provinsi' => 'required|string|max:25',
            'kota' => 'required|string|max:25',
            'kecamatan' => 'required|string|max:25',
            'kelurahan' => 'required|string|max:25',
            'alamat' => 'required|string|max:255',
            'harga_sewa' => 'required|integer',
            'kontak' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fasilitas_kost' => 'required|string',
            'link_gmaps' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update data kost
        $kost->nama_kost = $request->nama_kost;
        $kost->tipe_kost = $request->tipe_kost;
        $kost->jenis_kost = $request->jenis_kost;
        $kost->jumlah_kamar = $request->jumlah_kamar;
        $kost->tanggal_tagih = $request->tanggal_tagih;
        $kost->nama_pemilik = $request->nama_pemilik;
        $kost->nama_bank = $request->nama_bank;
        $kost->no_rekening = $request->no_rekening;
        $kost->provinsi = $request->provinsi;
        $kost->kota = $request->kota;
        $kost->kecamatan = $request->kecamatan;
        $kost->kelurahan = $request->kelurahan;
        $kost->alamat = $request->alamat;
        $kost->harga_sewa = $request->harga_sewa;
        $kost->kontak = $request->kontak;
        $kost->deskripsi = $request->deskripsi;
        $kost->fasilitas_kost = $request->fasilitas_kost;
        $kost->link_gmaps = $request->link_gmaps;

        // Handling foto (jika ada file yang diupload)
        if ($request->hasFile('foto_bangunan_utama')) {
            $foto_bangunan_utama = $request->file('foto_bangunan_utama')->store('foto_kost/foto_bangunan_utama', 'public');
            $kost->foto_bangunan_utama = $foto_bangunan_utama;
        }

        if ($request->hasFile('foto_kamar')) {
            $foto_kamar = $request->file('foto_kamar')->store('foto_kost/foto_kamar', 'public');
            $kost->foto_kamar = $foto_kamar;
        }

        if ($request->hasFile('foto_kamar_mandi')) {
            $foto_kamar_mandi = $request->file('foto_kamar_mandi')->store('foto_kost/foto_kamar_mandi', 'public');
            $kost->foto_kamar_mandi = $foto_kamar_mandi;
        }

        if ($request->hasFile('foto_interior')) {
            $foto_interior = $request->file('foto_interior')->store('foto_kost/foto_interior', 'public');
            $kost->foto_interior = $foto_interior;
        }

        // Simpan perubahan
        $kost->save();

        return redirect()->route('kost.index1')->with('success', 'Data kost berhasil diperbarui');
    }





    // Menghapus data kost
    public function destroy(Kost $kost)
    {
        $kost->delete();
        return redirect()->route('kost.index1')->with('success', 'Kost berhasil dihapus');
    }
}

