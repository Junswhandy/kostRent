<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Kost</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        .swiper-container {
            z-index: 0;
        }

        .swiper-button-next,
        .swiper-button-prev {
            z-index: 10;
        }
    </style>
</head>

<body class="h-screen bg-gray-100">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-64 text-white fixed h-full">
            @include('user.template.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-64 p-6 bg-white overflow-y-auto">
            <div class="max-w-5xl mx-auto">
                <!-- Slider Section -->
                <div class="mb-10">
                    <h1 class="text-2xl font-extrabold text-gray-800 mb-4">Simkos! Solusi Kost Terbaik</h1>
                    <div class="swiper-container rounded-lg overflow-hidden shadow-lg relative">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/slider/banner1.jpeg') }}" alt="Gambar Slider 1" class="w-full h-60 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/slider/banner2.jpeg') }}" alt="Gambar Slider 2" class="w-full h-60 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/slider/banner3.jpeg') }}" alt="Gambar Slider 3" class="w-full h-60 object-cover">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="bg-white shadow-md rounded-lg p-4 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Filter Kost</h2>
                    <form method="GET" action="{{ route('user.dashboard') }}">
                        <div class="flex items-center space-x-8 mb-4">
                            <!-- Filter Harga -->
                            <div class="flex items-center space-x-2">
                                <label for="harga" class="text-gray-600">Harga Terendah</label>
                                <input type="number" name="harga" id="harga" placeholder="Harga Maksimal" class="px-4 py-2 border border-gray-300 rounded-md "/>
                            </div>

                            <!-- Filter Jenis Kost -->
                            <div class="flex items-center space-x-2">
                                <label for="jenis_kost" class="text-gray-600">Jenis Kost</label>
                                <select name="jenis_kost" id="jenis_kost" class="px-4 py-2 border border-gray-300 rounded-md">
                                    <option value="">Semua Jenis</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Putri">Putri</option>
                                    <option value="Pampur">Campur</option>
                                </select>
                            </div>

                            <!-- Filter Alamat -->
                            <div class="flex items-center space-x-2">
                                <label for="kota" class="text-gray-600">Cari Berdasarkan Alamat</label>
                                <input type="text" name="kota" id="kota" placeholder="Masukkan Alamat" class="px-4 py-2 border border-gray-300 rounded-md" />
                            </div>
                        </div>

                        
                        {{-- tombol filter dan reset --}}
                        <div class="flex justify-center items-center space-x-4">
                            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Terapkan Filter</button>
                            <a href="{{ route('user.dashboard') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 text-center">Reset Filter</a>
                        </div>
                        
                
                    </form>
                </div>

                <!-- Card Section -->
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-800 mb-6">Daftar Kost</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                        @foreach($kost as $item)
                            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/foto_kost/foto_bangunan_utama/' . basename($item->foto_bangunan_utama)) }}" alt="Foto Kost" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h2 class="text-lg font-bold text-gray-900 mb-2 truncate">{{ $item->nama_kost }}</h2>
                                    <p class="text-sm text-gray-600 mb-1">Jenis: <span class="font-medium">{{ $item->jenis_kost }}</span></p>
                                    <p class="text-sm text-gray-600 mb-1">Harga: <span class="font-medium">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</span></p>
                                    <p class="text-sm text-gray-600 mb-1">Kontak: <span class="font-medium">{{ $item->kontak }}</span></p>
                                    <p class="text-sm text-gray-600">Kota: <span class="font-medium">{{ $item->kota }}</span></p>
                                </div>
                                <div class="p-4 bg-gray-100">
                                    <a href="{{ route('user.kost.show', $item->id_kost) }}" class="block text-center text-white bg-blue-500 hover:bg-blue-600 font-semibold py-2 px-4 rounded transition duration-200">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>
</body>

</html>
