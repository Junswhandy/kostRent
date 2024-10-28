<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_hp' => ['nullable', 'string', 'max:15'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'in:laki-laki,perempuan'],
            'foto_profil' => ['nullable', 'image', 'max:2048'],
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

        return redirect(route('dashboard', absolute: false));
    }

}
