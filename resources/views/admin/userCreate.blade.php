<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah User</title>
    <!-- Tambahkan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>
<body class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64">
        @include('admin.template.sidebar')
    </div>

    <!-- Konten -->
    <div class="flex-grow p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-6">Tambah User</h1>

        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama</label>
                <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
            </div>

           <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

            <div class="mb-4">
                <label for="level" class="block text-gray-700">Level</label>
                <select id="level" name="level" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="no_hp" class="block text-gray-700">No. HP</label>
                <input type="text" id="no_hp" name="no_hp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label for="pekerjaan" class="block text-gray-700">Pekerjaan</label>
                <input type="text" id="pekerjaan" name="pekerjaan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="foto_profil" class="block text-gray-700">Foto Profil</label>
                <input type="file" id="foto_profil" name="foto_profil" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('admin.user') }}" class="ml-4 text-gray-600">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
