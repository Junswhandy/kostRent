<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>SIMKOS</title>

     <!-- Swiper CSS -->
     <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
     <style>
      .content-container {
          margin-top: 80px; /* Sesuaikan jarak dengan header */
          padding: 0 1rem; /* Menambahkan padding samping */
      }
      .swiper-container {
          width: 100%;
          height: auto;
      }
      .grid-container {
          margin-top: 1rem;
      }
  </style>
  
</head>
<body>
      
      {{-- hero --}}
      <div class="bg-white">
        <header id="header" class="fixed inset-x-0 top-0 z-50 bg-slate-500 text-white transition-all">
          <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
              <h1 class="text-xl font-bold leading-6">SIMKOS</h1>
            </div>
            <div class="flex lg:hidden">
              <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
              </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
              <a href="{{route('home')}}" class="text-sm font-semibold leading-6">Home</a>
              <a href="{{ route('login') }}" class="text-sm font-semibold leading-6">Login</a>
              <a href="{{route("register")}}" class="text-sm font-semibold leading-6">Registrasi</a>
            </div>
          </nav>
        </header>
        
       <!-- Main Content -->
       <div class="content-container">
        <!-- Slider Section -->
       
        <div class="relative max-w-full">
          <!-- Swiper Container -->
          <div class="swiper-container">
            <!-- Slider Main Wrapper -->
            <div class="swiper-wrapper">
              <!-- Slide 1 -->
              <div class="swiper-slide">
                <div class="relative bg-gray-300 rounded-lg overflow-hidden shadow-lg">
                  <img src="{{ asset('storage/slider/banner1.jpeg') }}" alt="Gambar Slider 1" class="w-full h-80 object-cover">
                  <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent text-white p-6">
                    <h2 class="font-bold text-xl">Kos Nyaman & Strategis</h2>
                    <p class="text-sm">Promo Hemat dengan Kode SMARTSTAY</p>
                    <span class="text-lg font-semibold">Diskon Rp25.000</span>
                  </div>
                </div>
              </div>
              <!-- Slide 2 -->
              <div class="swiper-slide">
                <div class="relative bg-gray-300 rounded-lg overflow-hidden shadow-lg">
                  <img src="{{ asset('storage/slider/banner2.jpeg') }}" alt="Gambar Slider 2" class="w-full h-80 object-cover">
                  <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent text-white p-6">
                    <h2 class="font-bold text-xl">Voucher Special</h2>
                    <p class="text-sm">Sewa Kos Pilihan Andalan Anda</p>
                    <span class="text-lg font-semibold">Voucher Rp100.000</span>
                  </div>
                </div>
              </div>
              <!-- Slide 3 -->
              <div class="swiper-slide">
                <div class="relative bg-gray-300 rounded-lg overflow-hidden shadow-lg">
                  <img src="{{ asset('storage/slider/banner3.jpeg') }}" alt="Gambar Slider 2" class="w-full h-80 object-cover">
                  <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent text-white p-6">
                    <h2 class="font-bold text-xl">Voucher Special</h2>
                    <p class="text-sm">Sewa Kos Pilihan Andalan Anda</p>
                    <span class="text-lg font-semibold">Voucher Rp100.000</span>
                  </div>
                </div>
              </div>
              <!-- Add more slides as needed -->
            </div>
            
            <!-- Pagination (if you want dots for navigation) -->
            <div class="swiper-pagination"></div>
        
            <!-- Navigation Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
        


        <!-- Card Section -->
        <div class="grid-container">
            <h1 class="text-2xl font-extrabold text-gray-800 mb-6 text-center">Daftar Kost</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                @foreach($kost as $item)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/foto_kost/foto_bangunan_utama/' . basename($item->foto_bangunan_utama)) }}" alt="Foto Kost" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-bold text-gray-900 mb-2 truncate">{{ $item->nama_kost }}</h2>
                            <p class="text-sm text-gray-600 mb-1">Jenis: <span class="font-medium">{{ $item->jenis_kost }}</span></p>
                            <p class="text-sm text-gray-600 mb-1">Harga: <span class="font-medium">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }} / bulan</span></p>
                            <p class="text-sm text-gray-600 mb-1">Kontak: <span class="font-medium">{{ $item->kontak }}</span></p>
                            <p class="text-sm text-gray-600">Kota: <span class="font-medium">{{ $item->kota }}</span></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
<br>
    <div class="p-10">@include('footer')</div>
    
      </div>
      
      <!-- Swiper JS -->
      <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

      <script>
        const swiper = new Swiper('.swiper-container', {
          loop: true,
          autoplay: {
            delay: 3000,  // Slide interval (3 seconds)
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
      </script>
      


{{-- efek scroll = saat di scroll bg transparent dan text hitam --}}
<script>
  const header = document.getElementById('header');

  window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
      // When scrolled down past 50px, make the background transparent and text black
      header.classList.add('bg-transparent');
      header.classList.remove('bg-slate-500');
      header.classList.remove('text-white');
      header.classList.add('text-black');
    } else {
      // When at the top of the page, restore default background and text color (white)
      header.classList.remove('bg-transparent');
      header.classList.add('bg-slate-500');
      header.classList.remove('text-black');
      header.classList.add('text-white');
    }
  });
</script>




</body>
</html>

