<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\KonfirmasiBayar;
use App\Models\Kost;

class KonfirmasiBayarController extends Controller
{
    /**
     * Tampilkan daftar konfirmasi pembayaran.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil data konfirmasi bayar untuk user yang sedang login
        $konfirmasiBayar = KonfirmasiBayar::where('id_user', $user->id)->with('kost')->get();

        return view('user.kost.konfirmasiBayar', compact('konfirmasiBayar'));
    }

    /**
     * Proses upload bukti bayar.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'id_kost' => 'required|exists:kost,id_kost',
            'bukti_bayar' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', // Maksimal 2MB
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Simpan file bukti bayar
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('bukti_bayar', $fileName, 'public');

            // Simpan data ke tabel konfirmasi bayar
            KonfirmasiBayar::create([
                'id_user' => $user->id,
                'id_kost' => $request->id_kost,
                'bukti_bayar' => $filePath,
                'status' => 'Menunggu Konfirmasi',
            ]);

            return redirect()->route('konfirmasi.index')->with('success', 'Bukti bayar berhasil diunggah!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti bayar. Silakan coba lagi.');
    }
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_kost' => 'required|exists:kost,id_kost',
            'tanggal_masuk' => 'required|date',
            'durasi_sewa' => 'required|integer|min:1',
        ]);

        // Hitung tanggal keluar
        $tanggal_keluar = date('Y-m-d', strtotime($request->tanggal_masuk . ' + ' . $request->durasi_sewa . ' months'));

        // Simpan data ke tabel konfirmasi bayar
        KonfirmasiBayar::create([
            'id_user' => Auth::id(),
            'id_kost' => $request->id_kost,
            'tanggal_masuk' => $request->tanggal_masuk,
            'durasi_sewa' => $request->durasi_sewa,
            'tanggal_keluar' => $tanggal_keluar,
            'status' => 'Belum Bayar',
        ]);

        // Redirect dengan notifikasi sukses
        //   return redirect()->route('konfirmasi.index')->with('success', 'Permintaan konfirmasi pembayaran berhasil disimpan! Silakan unggah bukti bayar.');
    }

}
