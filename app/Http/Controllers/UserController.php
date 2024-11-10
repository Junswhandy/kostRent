<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_hp' => ['required', 'string', 'max:15'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'foto_profil' => ['required', 'image', 'max:2048'],
            'level' => ['required', 'in:admin,user,owner'], // Validation for level
        ]);

        // Handle file upload for foto_profil
        $path = null;
        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('profile_photos', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'pekerjaan' => $request->pekerjaan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto_profil' => $path,
            'level' => $request->level, // Save the selected level
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('admin.user', absolute: true));
    }

    // Menampilkan form edit untuk user
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan id
        return view('admin.userEdit', compact('user')); // Return view edit dengan data user
    }

    // Mengupdate data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data input

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|',
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
            if ($user->foto_profil && Storage::exists('public/' . $user->foto_profil)) {
                Storage::delete('public/' . $user->foto_profil); // Delete the old profile photo if it exists
            }
            $path = null;
            // Simpan foto profil baru
            $filename = time() . '_' . $request->file('foto_profil')->getClientOriginalName(); // Nama file baru
            $path = $request->file('foto_profil')->storeAs('profile_photos', $filename, 'public'); // Simpan gambar dengan nama baru

            // Update nama file di database dengan path yang diinginkan
            $user->foto_profil = 'profile_photos/' . $filename; // Simpan path ke database
            $user->save(); // Pastikan untuk menyimpan perubahan ke database
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
