<?php
// app/Http/Middleware/RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Check if the user is authenticated and has the specified role
        if (!$user || $user->level !== $role) {
            return redirect('/login'); // Redirect to a general dashboard or login page
        }

        return $next($request);
    }
}

