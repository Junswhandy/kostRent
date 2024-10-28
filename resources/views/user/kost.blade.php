{{-- <!-- File: resources/views/user/rented_kost.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kost yang Sedang Anda Sewa</h1>

        @if ($kost)
            <div class="card">
                <div class="card-body">
                    <h3>{{ $kost->nama_kost }}</h3>
                    <p>Tipe Kost: {{ $kost->tipe_kost }}</p>
                    <p>Alamat: {{ $kost->alamat }}</p>
                    <p>Harga Sewa: Rp {{ number_format($kost->harga_sewa, 0, ',', '.') }}</p>
                    <!-- Tambahkan informasi lain jika diperlukan -->
                </div>
            </div>
        @else
            <p>Anda belum menyewa kost saat ini.</p>
        @endif
    </div>
@endsection --}}

<h1>p</h1>