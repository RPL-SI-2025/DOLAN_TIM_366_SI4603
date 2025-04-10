<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    public function store(Request $request)
    {
        // Cek apakah pengguna adalah admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak. Hanya admin yang boleh.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination = Destination::create($validated);

        return response()->json([
            'message' => 'Destinasi berhasil ditambahkan.',
            'data' => $destination,
        ], 201);
    }
}
