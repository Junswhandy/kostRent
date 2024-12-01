<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Kost; // Pastikan namespace model Kost benar
use App\Models\KonfirmasiBayar;


class BookingController extends Controller
{
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

        // Simpan data booking
        Booking::create([
            'id_user' => Auth::id(),
            'id_kost' => $request->id_kost,
            'tanggal_masuk' => $request->tanggal_masuk,
            'hitungan_sewa' => $request->durasi_sewa,
            'durasi_sewa' => $request->durasi_sewa,
            'tanggal_keluar' => $tanggal_keluar,
            'jumlah_kamar' => 1,
            'status' => 'Menunggu Konfirmasi', // Status awal
        ]);

        // Update jumlah kamar pada tabel kost
        $kost = Kost::find($request->id_kost);
        if ($kost && $kost->jumlah_kamar > 0) {
            $kost->jumlah_kamar -= 1; // Kurangi jumlah kamar
            $kost->save();
        } else {
            return redirect()->back()->with('error', 'Kamar tidak tersedia!');
        }

        // Update kolom id_kost di tabel users
        $user = Auth::user();
        $user->id_kost = $request->id_kost;
        $user->save();

        // Redirect dengan notifikasi sukses
        return redirect()->back()->with('success', 'Kost berhasil dipesan!');
    }


    // owner
    // public function handleBooking(Request $request, $id)
    // {
    //     // Ambil data booking berdasarkan ID
    //     $booking = Booking::findOrFail($id);

    //     // Pastikan pemilik kost yang sedang login sesuai dengan pemilik booking
    //     if ($booking->kost->id_pemilik !== Auth::id()) {
    //         return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk mengubah status booking ini.');
    //     }

    //     // Proses aksi (Setujui atau Tolak)
    //     if ($request->action === 'approve') {
    //         // Ubah status menjadi "Disetujui"
    //         $booking->update(['status' => 'Disetujui']);
    //         return redirect()->route('owner.booking.index')->with('success', 'Booking berhasil disetujui.');
    //     } elseif ($request->action === 'reject') {
    //         // Hapus booking
    //         $booking->delete();
    //         return redirect()->route('owner.booking.index')->with('success', 'Booking berhasil ditolak.');
    //     }

    //     // Ambil semua booking milik pemilik yang sedang login
    //     $bookings = Booking::whereHas('kost', function ($query) {
    //         $query->where('id_pemilik', Auth::id());
    //     })->with('kost')->get();

    //     // Kembalikan view dengan data booking
    //     return view('owner.booking.index', compact('bookings'));
    // }
    public function index()
    {
        // Ambil data booking yang terkait dengan kost yang dimiliki oleh pemilik yang sedang login
        $bookings = Booking::whereHas('kost', function ($query) {
            $query->where('id_pemilik', Auth::id());
        })->get();

        // Kembalikan ke view dengan data booking yang sudah difilter
        return view('owner.booking.index', compact('bookings'));
    }

    public function confirm(Request $request)
    {
        // Ambil id booking dari request
        $bookingId = $request->input('id_booking'); // pastikan 'id_booking' sesuai dengan yang ada di form

        // Cari booking berdasarkan ID
        $booking = Booking::findOrFail($bookingId);

        // Pastikan status booking adalah 'Menunggu Konfirmasi'
        if ($booking->status === 'Menunggu Konfirmasi') {
            $booking->status = 'Disetujui';
            $booking->save();
            return redirect()->route('owner.booking.index')->with('success', 'Booking telah disetujui.');
        }

        return redirect()->route('owner.booking.index')->with('error', 'Booking sudah diproses.');
    }

    public function reject(Request $request)
    {
        // Ambil id booking dari request
        $bookingId = $request->input('id_booking'); // pastikan 'id_booking' sesuai dengan yang ada di form

        // Cari booking berdasarkan ID
        $booking = Booking::findOrFail($bookingId);

        // Hapus booking yang ditolak
        $booking->delete();
        return redirect()->route('owner.booking.index')->with('success', 'Booking telah ditolak.');
    }


}
