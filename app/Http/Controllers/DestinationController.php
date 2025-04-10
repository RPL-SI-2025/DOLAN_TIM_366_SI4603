<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function getDestinations()
    {
        // Ambil 4 destinasi secara acak
        $destinations = Destination::inRandomOrder()->limit(4)->get();

        // Mengembalikan data dalam format JSON
        return response()->json($destinations);
    }
}
