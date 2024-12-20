<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect based on user role
            $user = Auth::user();

            if ($user->level === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->level === 'user') {
                return redirect()->route('user.dashboard');
            } elseif ($user->level === 'owner') {
                return redirect()->route('owner.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Dapatkan user_id dari pengguna yang sedang login
        $userId = Auth::id();

        // Hapus semua session yang terkait dengan user_id ini
        DB::table('sessions')->where('user_id', $userId)->delete();

        // Logout pengguna
        Auth::guard('web')->logout();

        // Invalidate session saat ini
        $request->session()->invalidate();

        // Regenerate token untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
