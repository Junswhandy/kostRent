<?php

// File: app/Http/Controllers/KostController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kost; // Pastikan namespace model Kost benar
use App\Models\Booking; // Pastikan model Booking sudah dibuat

class userKostController extends Controller
{
    public function showRentedKost()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Get all 'kost' rented by the user along with the associated 'booking'
        $kosts = Kost::whereHas('booking', function ($query) use ($user) {
            $query->where('id_user', $user->id); // Make sure the user is the one who rented
        })->get(); // Use 'get()' instead of 'first()' to retrieve all related kosts

        // Pass all kost and booking data to the view
        return view('user.kost.kostSaya', compact('kosts'));
    }



}

