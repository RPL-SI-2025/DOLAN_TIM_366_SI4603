<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Promo;
use Illuminate\Http\Request;

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

    public function getDestinations(Request $request)
    {
    $category = $request->get('category', null);

    $query = Destination::query();

    // Jika kategori dipilih, filter berdasarkan kategori
    if ($category) {
        $query->where('category', $category);
    }

    // Ambil destinasi dengan kategori yang sesuai
    $destinations = $query->get();

    return response()->json($destinations);
}

}