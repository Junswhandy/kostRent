<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Bukti Bayar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('user.template.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h1 class="text-2xl font-bold text-center mb-6">Daftar Konfirmasi Pembayaran</h1>

            <!-- Tabel Konfirmasi -->
            <div class="bg-white shadow-md rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">ID Kost</th>
                            <th class="px-4 py-2">Nama Kost</th>
                            <th class="px-4 py-2">Harga Sewa</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($konfirmasiBayar as $data)
                            <tr>
                                <td class="border px-4 py-2">{{ $data->id_kost }}</td>
                                <td class="border px-4 py-2">{{ $data->kost->nama_kost }}</td>
                                <td class="border px-4 py-2">Rp {{ number_format($data->kost->harga_sewa, 0, ',', '.') }}</td>
                                <td class="border px-4 py-2">{{ $data->kost->alamat }}</td>
                                <td class="border px-4 py-2">{{ $data->status }}</td>
                                <td class="border px-4 py-2">
                                    <button 
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                                        @click="showModal = true; selectedKost = {{ json_encode($data) }}"
                                    >
                                        Unggah Bukti
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div 
        x-data="{ showModal: false, selectedKost: null }" 
        x-show="showModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
        style="display: none;"
    >
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h2 class="text-xl font-bold mb-4">Unggah Bukti Pembayaran</h2>

            <form action="{{ route('konfirmasi.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Data Kost -->
                <div class="mb-4" x-show="selectedKost">
                    <label for="id_kost" class="block text-gray-700 font-semibold mb-2">ID Kost</label>
                    <input 
                        type="text" 
                        name="id_kost" 
                        id="id_kost" 
                        class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        :value="selectedKost.id_kost"
                        readonly
                    >
                </div>

                <div class="mb-4" x-show="selectedKost">
                    <label for="nama_kost" class="block text-gray-700 font-semibold mb-2">Nama Kost</label>
                    <input 
                        type="text" 
                        name="nama_kost" 
                        id="nama_kost" 
                        class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        :value="selectedKost.kost.nama_kost"
                        readonly
                    >
                </div>

                <div class="mb-4" x-show="selectedKost">
                    <label for="harga_sewa" class="block text-gray-700 font-semibold mb-2">Harga Sewa</label>
                    <input 
                        type="text" 
                        name="harga_sewa" 
                        id="harga_sewa" 
                        class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        :value="'Rp ' + new Intl.NumberFormat().format(selectedKost.kost.harga_sewa)"
                        readonly
                    >
                </div>

                <!-- Bukti Bayar -->
                <div class="mb-4">
                    <label for="bukti_bayar" class="block text-gray-700 font-semibold mb-2">Unggah Bukti Bayar</label>
                    <input 
                        type="file" 
                        name="bukti_bayar" 
                        id="bukti_bayar" 
                        class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('bukti_bayar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-2">
                    <button 
                        type="button" 
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600"
                        @click="showModal = false"
                    >
                        Tutup
                    </button>
                    <button 
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                    >
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
