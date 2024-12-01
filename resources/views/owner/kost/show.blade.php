<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Kost</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        @include('owner.template.sidebar')

        <!-- Detail Kost Content -->
        <div class="flex-1 p-8 bg-white overflow-y-auto">

            <!-- Header Title -->
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Detail Kost</h1>

            <!-- Gambar Kost -->
            <div class="mb-8 max-w-[90%] mx-auto">
                <img src="{{ asset('storage/foto_kost/foto_bangunan_utama/' . basename($kost->foto_bangunan_utama)) }}" 
                     alt="Foto Bangunan Utama" class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>

            <!-- Detail Information -->
            <div class="max-w-[90%] mx-auto bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $kost->nama_kost }}</h2>
                <p class="text-gray-600 text-lg mb-6">{{ $kost->deskripsi }}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-600">Harga Sewa (Per Bulan):</p>
                        <p class="text-xl font-semibold text-gray-900">Rp {{ number_format($kost->harga_sewa, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Alamat:</p>
                        <p class="text-gray-800">{{ $kost->alamat }}</p>
                    </div>
                </div>

                <!-- Additional Information: Number of Rooms, Contact Info, etc. -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-600">Jumlah Kamar:</p>
                        <p class="text-gray-800">{{ $kost->jumlah_kamar }} Kamar</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nama Pemilik:</p>
                        <p class="text-gray-800">{{ $kost->nama_pemilik }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Kontak:</p>
                        <p class="text-gray-800">{{ $kost->kontak }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Fasilitas:</p>
                        <p class="text-gray-800">{{ $kost->fasilitas_kost }}</p>
                    </div>
                </div>

                <!-- More Detailed Info (if needed) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama Bank:</p>
                        <p class="text-gray-800">{{ $kost->nama_bank }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nomor Rekening:</p>
                        <p class="text-gray-800">{{ $kost->no_rekening }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Link Google Maps:</p>
                        <a href="{{ $kost->link_gmaps }}" target="_blank" class="text-blue-500 hover:text-blue-700">Lihat di Google Maps</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
