<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Kost</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-screen bg-gray-100">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-60 text-white fixed h-full">
            @include('owner.template.sidebar')
        </aside>

        <div class="flex-grow ml-64 p-6 bg-white overflow-y-auto">
            <h1 class="text-3xl font-bold mb-6">Tambah Kost</h1>

            <!-- Form Tambah Kost -->
            <form action="{{ route('kost.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">

                    <!-- Nama Kost -->
                    <div>
                        <label for="nama_kost" class="block text-sm font-medium text-gray-700">Nama Kost</label>
                        <input type="text" id="nama_kost" name="nama_kost" value="{{ old('nama_kost') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('nama_kost')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tipe Kost -->
                    <div>
                        <label for="tipe_kost" class="block text-sm font-medium text-gray-700">Tipe Kost</label>
                        <input type="text" id="tipe_kost" name="tipe_kost" value="{{ old('tipe_kost') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('tipe_kost')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jenis Kost -->
                    <div>
                        <label for="jenis_kost" class="block text-sm font-medium text-gray-700">Jenis Kost</label>
                        <input type="text" id="jenis_kost" name="jenis_kost" value="{{ old('jenis_kost') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('jenis_kost')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jumlah Kamar -->
                    <div>
                        <label for="jumlah_kamar" class="block text-sm font-medium text-gray-700">Jumlah Kamar</label>
                        <input type="number" id="jumlah_kamar" name="jumlah_kamar" value="{{ old('jumlah_kamar') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('jumlah_kamar')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tanggal Tagih -->
                    <div>
                        <label for="tanggal_tagih" class="block text-sm font-medium text-gray-700">Tanggal Tagih</label>
                        <input type="date" id="tanggal_tagih" name="tanggal_tagih" value="{{ old('tanggal_tagih') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('tanggal_tagih')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nama Pemilik -->
                    <div>
                        <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
                        <input type="text" id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('nama_pemilik')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nama Bank -->
                    <div>
                        <label for="nama_bank" class="block text-sm font-medium text-gray-700">Nama Bank</label>
                        <input type="text" id="nama_bank" name="nama_bank" value="{{ old('nama_bank') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('nama_bank')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No Rekening -->
                    <div>
                        <label for="no_rekening" class="block text-sm font-medium text-gray-700">No Rekening</label>
                        <input type="text" id="no_rekening" name="no_rekening" value="{{ old('no_rekening') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('no_rekening')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Foto Bangunan Utama -->
                    <div>
                        <label for="foto_bangunan_utama" class="block text-sm font-medium text-gray-700">Foto Bangunan Utama</label>
                        <input type="file" id="foto_bangunan_utama" name="foto_bangunan_utama" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md" accept="image/*" required>
                        @error('foto_bangunan_utama')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Foto Kamar -->
                    <div>
                        <label for="foto_kamar" class="block text-sm font-medium text-gray-700">Foto Kamar</label>
                        <input type="file" id="foto_kamar" name="foto_kamar" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md" accept="image/*" required>
                        @error('foto_kamar')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Foto Kamar Mandi -->
                    <div>
                        <label for="foto_kamar_mandi" class="block text-sm font-medium text-gray-700">Foto Kamar Mandi</label>
                        <input type="file" id="foto_kamar_mandi" name="foto_kamar_mandi" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md" accept="image/*" required>
                        @error('foto_kamar_mandi')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Foto Interior -->
                    <div>
                        <label for="foto_interior" class="block text-sm font-medium text-gray-700">Foto Interior</label>
                        <input type="file" id="foto_interior" name="foto_interior" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md" accept="image/*" required>
                        @error('foto_interior')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Provinsi -->
                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('provinsi')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kota -->
                    <div>
                        <label for="kota" class="block text-sm font-medium text-gray-700">Kota</label>
                        <input type="text" id="kota" name="kota" value="{{ old('kota') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('kota')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('kecamatan')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kelurahan -->
                    <div>
                        <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                        <input type="text" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('kelurahan')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('alamat')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Harga Sewa -->
                    <div>
                        <label for="harga_sewa" class="block text-sm font-medium text-gray-700">Harga Sewa</label>
                        <input type="number" id="harga_sewa" name="harga_sewa" value="{{ old('harga_sewa') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('harga_sewa')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div>
                        <label for="kontak" class="block text-sm font-medium text-gray-700">Kontak</label>
                        <input type="text" id="kontak" name="kontak" value="{{ old('kontak') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('kontak')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Fasilitas Kost -->
                    <div>
                        <label for="fasilitas_kost" class="block text-sm font-medium text-gray-700">Fasilitas Kost</label>
                        <textarea id="fasilitas_kost" name="fasilitas_kost" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('fasilitas_kost') }}</textarea>
                        @error('fasilitas_kost')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Link Google Maps -->
                    <div>
                        <label for="link_gmaps" class="block text-sm font-medium text-gray-700">Link Google Maps</label>
                        <input type="text" id="link_gmaps" name="link_gmaps" value="{{ old('link_gmaps') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('link_gmaps')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
