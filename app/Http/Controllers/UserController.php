<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all(); // Ambil semua data user
        return view('admin.user', compact('users')); // Return view dengan data user
    }

    // Form untuk menambah user baru
    public function create()
    {
        return view('admin.userCreate'); // Menampilkan form create user
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'level' => 'required|in:user,admin,owner',
            'no_hp' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'id_kost' => 'nullable|integer|exists:kost,id_kost',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan user baru
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->no_hp = $request->no_hp;
        $user->pekerjaan = $request->pekerjaan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->id_kost = $request->id_kost;

        // Jika ada file foto_profil yang diupload
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_profil', $filename); // Simpan gambar ke folder storage
            $user->foto_profil = $filename; // Simpan nama file di database
        }

        $user->save();

        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan');
    }

    // Menampilkan form edit untuk user
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan id
        return view('admin.user.edit', compact('user')); // Return view edit dengan data user
    }

    // Mengupdate data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'level' => 'required|in:user,admin,owner',
            'no_hp' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_kost' => 'nullable|integer|exists:kost,id_kost',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->level = $request->level;
        $user->no_hp = $request->no_hp;
        $user->pekerjaan = $request->pekerjaan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->id_kost = $request->id_kost;

        // Jika ada file foto_profil yang diupload
        if ($request->hasFile('foto_profil')) {
            // Hapus foto profil lama jika ada
            if ($user->foto_profil) {
                Storage::delete('public/foto_profil/' . $user->foto_profil);
            }

            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_profil', $filename); // Simpan gambar baru
            $user->foto_profil = $filename; // Update nama file di database
        }

        $user->save();

        return redirect()->route('admin.user')->with('success', 'User berhasil diupdate');
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus foto profil jika ada
        if ($user->foto_profil) {
            Storage::delete('public/foto_profil/' . $user->foto_profil);
        }

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus');
    }
}
