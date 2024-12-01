<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-60 text-white fixed h-full">
        @include('admin.template.sidebar')
    </aside>

  
<div class="container mx-auto ml-60 p-4 bg-white overflow-y-auto">
    <h2 class="text-2xl font-bold mb-6">Edit User</h2>

    <!-- Form untuk mengedit data user -->
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold">Password (Leave blank to keep current password)</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- No HP -->
        <div class="mb-4">
            <label for="no_hp" class="block text-gray-700 font-semibold">No HP</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
            @error('no_hp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pekerjaan -->
        <div class="mb-4">
            <label for="pekerjaan" class="block text-gray-700 font-semibold">Pekerjaan</label>
            <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
            @error('pekerjaan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jenis Kelamin -->
        <div class="mb-4">
            <label for="jenis_kelamin" class="block text-gray-700 font-semibold">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
                <option value="laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Foto Profil -->
        <div class="mb-4">
            <label for="foto_profil" class="block text-gray-700 font-semibold">Foto Profil</label>
            @if($user->foto_profil)
                <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="w-16 h-16 mb-2 rounded-full">
            @endif
            <input type="file" id="foto_profil" name="foto_profil" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
            @error('foto_profil')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Level -->
        <div class="mb-4">
            <label for="level" class="block text-gray-700 font-semibold">Level</label>
            <select id="level" name="level" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
                <option value="admin" {{ old('level', $user->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('level', $user->level) == 'user' ? 'selected' : '' }}>User</option>
                <option value="owner" {{ old('level', $user->level) == 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
            @error('level')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan Perubahan</button>
        </div>
    </form>
</div>
</body>
</html>


