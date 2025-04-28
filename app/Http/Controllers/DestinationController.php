<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    // READ: Display all destinations (nanti bisa dimodifikasi kalau udah ada homepage)
    public function index()
    {
        $destinations = Destination::all();
        return view('dashboard.destination.index', compact('destinations'));
    }
    
    // READ: Display a single destination (show by id belum dipakai)
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return view('dashboard.destination.show', compact('destination'));
    }

    // CREATE: Show form to create a new destination
    public function create()
    {
        if (Auth::check() && (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin')) {
            return redirect()->route('dashboard.destination.index')->with('error', 'Akses ditolak. Hanya admin yang boleh.');
        }
        return view('dashboard.destination.create');
    }

    // CREATE: Store a new destination
   public function store(Request $request)
    {
    if (Auth::check() && (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin')) {
        return response()->json(['message' => 'Akses ditolak. Hanya admin yang boleh.'], 403);
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'image' => 'nullable|image|max:2048',
        'additional_images' => 'nullable|array',  // Validasi gambar tambahan
        'additional_images.*' => 'image|max:2048', // Validasi setiap gambar tambahan
        'stock' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('destinations', 'public');
    }

    // Menyimpan gambar tambahan
    if ($request->hasFile('additional_images')) {
        $additionalImages = [];
        foreach ($request->file('additional_images') as $file) {
            $additionalImages[] = $file->store('destinations/extra', 'public');
        }
        $validated['additional_images'] = $additionalImages;
    }

    Destination::create($validated);
    return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil ditambahkan.');
}

    // UPDATE: Show form to edit a destination
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        if (Auth::check() && (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin')) {
            return redirect()->route('dashboard.destination.index')->with('error', 'Akses ditolak. Hanya admin yang boleh.');
        }
        return view('dashboard.destination.edit', compact('destination'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|max:2048',
            'removed_images' => 'nullable|array',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);
    
        $destination = Destination::findOrFail($id);
    
        try {
            if ($request->hasFile('image')) {
                if ($destination->image) {
                    Storage::delete("public/{$destination->image}");
                }
                $validated['image'] = $request->file('image')->store('destinations', 'public');
            }
    
            $existingImages = $destination->additional_images ?? [];
    
            if ($request->has('removed_images')) {
                foreach ($request->removed_images as $imageToRemove) {
                    if (Storage::exists('public/' . $imageToRemove)) {
                        Storage::delete('public/' . $imageToRemove);
                    }
                    $existingImages = array_filter($existingImages, function ($img) use ($imageToRemove) {
                        return $img !== $imageToRemove;
                    });
                }
            }
    
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $file) {
                    $path = $file->store('destinations/extra', 'public');
                    if ($path && !in_array($path, $existingImages)) { // Cegah duplikasi
                        $existingImages[] = $path;
                    }
                }
            }
    
            $validated['additional_images'] = array_values($existingImages);
    
            $destination->update($validated);
    
            return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui destinasi: ' . $e->getMessage())->withInput();
        }
    }

      // DELETE: Remove a destination
    public function destroy($id)
      {
        if (Auth::check() && (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin')) {
              return response()->json(['message' => 'Akses ditolak. Hanya admin yang boleh.'], 403);
          }
  
          $destination = Destination::findOrFail($id);
  
          if ($destination->image) {
              Storage::delete('public/' . $destination->image);
          }
  
          $destination->delete();
  
          return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil dihapus.');
    }

    public function getDestinations()
    {
        $destinations = Destination::inRandomOrder()->limit(4)->get();

        $data = $destinations->map(function ($item) {
            $item->image = $item->image ? asset('storage/' . $item->image) : null;

            if ($item->additional_images) {
                $item->additional_images = array_map(function ($img) {
                    return asset('storage/' . $img);
                }, $item->additional_images);
            }

            return $item;
        });

        return response()->json($data);
    }

    public function ShowDestinations()
    {
        $destinations = Destination::all();
        return view('user.destinations.index', compact('destinations'));
    }

}
