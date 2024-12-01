<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Kost</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // JavaScript to handle the modals and calculate the total price
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        // Function to calculate and update the total price
        function updateTotalPrice() {
            const hargaSewa = {{ $kost->harga_sewa }}; // Harga sewa per bulan
            const durasiSewa = document.getElementById('durasi_sewa').value; // Durasi sewa yang dipilih
            const totalHargaElement = document.getElementById('total_harga');

            if (durasiSewa) {
                const totalHarga = hargaSewa * durasiSewa;
                totalHargaElement.textContent = 'Rp ' + totalHarga.toLocaleString(); // Menampilkan total harga
            } else {
                totalHargaElement.textContent = 'Rp 0';
            }
        }
    </script>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        @include('user.template.sidebar')

        <!-- Detail Kost Content -->
        <div class="flex-1 p-8 bg-white overflow-y-auto relative">

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

                <!-- Additional Information -->
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
                    <div>
                        <p class="text-sm text-gray-600">Bank:</p>
                        <p class="text-gray-800">{{ $kost->nama_bank }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nomor Rekening:</p>
                        <p class="text-gray-800">{{ $kost->no_rekening}}</p>
                    </div>
                </div>

                <!-- Booking Button with WhatsApp -->
                <div class="mt-8 text-center flex justify-center items-center gap-4">
                    <button onclick="toggleModal('durationModal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Booking
                    </button>
                    <!-- WhatsApp Button -->
                    <a href="https://wa.me/{{ $kost->kontak }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Duration Selection Modal -->
    <div id="durationModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-10">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pilih Durasi Sewa</h2>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_kost" value="{{ $kost->id_kost }}">

                <label for="tanggal_masuk" class="block text-left mb-2 text-sm text-gray-600">Tanggal Masuk:</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="border-gray-300 rounded-lg w-full mb-4 p-2" required>

                <label for="durasi_sewa" class="block text-left mb-2 text-sm text-gray-600">Durasi Sewa (bulan):</label>
                <select id="durasi_sewa" name="durasi_sewa" class="border-gray-300 rounded-lg w-full mb-4 p-2" onchange="updateTotalPrice()" required>
                    <option value="" disabled selected>Pilih Durasi</option>
                    <option value="1">1 Bulan</option>
                    <option value="3">3 Bulan</option>
                    <option value="6">6 Bulan</option>
                    <option value="12">12 Bulan</option>
                </select>

                <div class="text-left mb-4">
                    <p class="text-sm text-gray-600">Total Harga:</p>
                    <p id="total_harga" class="text-xl font-semibold text-gray-900">Rp 0</p>
                </div>

                <div class="flex justify-center gap-4">
                    <button type="button" onclick="toggleModal('durationModal')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Lanjut
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
