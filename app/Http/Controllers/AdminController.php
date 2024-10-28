<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // Points to resources/views/admin/dashboard.blade.php
    }

    public function users()
    {
        return view('admin.users'); // Points to resources/views/admin/users.blade.php
    }
}

