<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-screen">
    <div class="flex h-full">
        <!-- Sidebar -->
        @include('owner.template.sidebar') <!-- Memasukkan sidebar dari file terpisah -->

        <!-- Dashboard content -->
        <div class="flex-1 p-4 text-black bg-white">
          

            <!-- Card Grid for Kost -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($kost as $item)
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                        <!-- Menampilkan gambar kost -->
                        <img src="{{ asset('storage/foto_kost/foto_bangunan_utama/' . basename($item->foto_bangunan_utama)) }}" alt="Foto Bangunan Utama" class="w-full h-48 object-cover">

                        <div class="px-6 py-4">
                            <!-- Nama Kost -->
                            <h2 class="font-bold text-xl mb-2">{{ $item->nama_kost }}</h2>
                            <!-- Deskripsi Kost -->
                            <p class="text-gray-700 text-base">{{ $item->deskripsi }}</p>
                            <p class="text-gray-700 text-base">{{ $item->jenis_kost }}</p>
                        </div>

                        <div class="px-6 py-4 flex justify-between items-center">
                            <!-- Harga Sewa -->
                            <span class="text-sm text-gray-600">Harga: Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</span>
                            <!-- Link untuk View Details -->
                            <a href="{{ route('owner.kost.show', $item->id_kost) }}" class="text-blue-500 hover:text-blue-700">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</body>
</html>
