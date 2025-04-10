<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Promo;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua destinasi dan promo yang masih berlaku
        $destinations = Destination::all();
        $promos = Promo::where('valid_until', '>=', now())->get();

        // Mengirim data ke homepage view
        return view('home', compact('destinations', 'promos'));
    }
}