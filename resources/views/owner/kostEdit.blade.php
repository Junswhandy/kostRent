<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Kost</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-screen bg-gray-100">
    <div class="flex h-full">
        <aside class="w-60 text-white fixed h-full">
            @include('owner.template.sidebar')
        </aside>

        <div class="flex-grow ml-64 p-6 bg-white overflow-y-auto">
            <h1 class="text-3xl font-bold mb-6">Edit Kost</h1>

            <form action="{{ route('kost.update', $kost->id_kost) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <!-- Semua field dari tabel kost -->
                    @php
                        $fields = [
                            'nama_kost', 'tipe_kost', 'jenis_kost', 'jumlah_kamar', 'tanggal_tagih',
                            'nama_pemilik', 'nama_bank', 'no_rekening', 'provinsi', 'kota', 'kecamatan',
                            'kelurahan', 'alamat', 'harga_sewa', 'kontak', 'deskripsi', 'fasilitas_kost',
                            'link_gmaps'
                        ];
                    @endphp

                    @foreach ($fields as $field)
                        <div>
                            <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 capitalize">
                                {{ str_replace('_', ' ', $field) }}
                            </label>
                            <input type="{{ $field === 'harga_sewa' || $field === 'jumlah_kamar' ? 'number' : 'text' }}"
                                id="{{ $field }}" name="{{ $field }}"
                                value="{{ old($field, $kost->$field) }}"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                            @error($field)
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach

                    <!-- Upload Foto -->
                    @php
                        $photos = [
                            'foto_bangunan_utama' => 'Bangunan Utama',
                            'foto_kamar' => 'Kamar',
                            'foto_kamar_mandi' => 'Kamar Mandi',
                            'foto_interior' => 'Interior'
                        ];
                    @endphp

                    @foreach ($photos as $photoField => $photoLabel)
                        <div>
                            <label for="{{ $photoField }}" class="block text-sm font-medium text-gray-700">
                                {{ $photoLabel }}
                            </label>
                            <input type="file" id="{{ $photoField }}" name="{{ $photoField }}" 
                                class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md" 
                                accept="image/*">
                            @if ($kost->$photoField)
                                <img src="{{ asset('storage/' . $kost->$photoField) }}" alt="{{ $photoLabel }}" class="w-32 h-32 mt-2">
                            @endif
                            @error($photoField)
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-6">Update Kost</button>
            </form>
        </div>
    </div>
</body>

</html>
