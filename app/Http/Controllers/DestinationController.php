<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    // READ: Display all destinations
    public function index()
    {
        $destinations = Destination::all();
        return view('destination.index', compact('destinations'));
    }

    // READ: Display a single destination
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return view('destination.show', compact('destination'));
    }

    // CREATE: Show form to create a new destination
    public function create()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard.destination.index')->with('error', 'Akses ditolak. Hanya admin yang boleh.');
        }

        return view('destination.create');
    }

    // CREATE: Store a new destination
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak. Hanya admin yang boleh.'], 403);
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

        Destination::create($validated);

        return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    // UPDATE: Show form to edit a destination
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);

        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard.destination.index')->with('error', 'Akses ditolak. Hanya admin yang boleh.');
        }

        return view('destination.edit', compact('destination'));
    }

    // UPDATE: Update a destination
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak. Hanya admin yang boleh.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $destination = Destination::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::delete('public/' . $destination->image);
            }
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($validated);

        return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil diperbarui.');
    }

    // DELETE: Remove a destination
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak. Hanya admin yang boleh.'], 403);
        }

        $destination = Destination::findOrFail($id);

        if ($destination->image) {
            Storage::delete('public/' . $destination->image);
        }

        $destination->delete();

        return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil dihapus.');
    }
}
