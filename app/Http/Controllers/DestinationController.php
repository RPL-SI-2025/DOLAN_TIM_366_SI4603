<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DestinationController extends Controller
{
    protected $mainImagePath = 'images/destinations';
    protected $additionalImagePath = 'images/additional_destinations';

    public function index()
    {
        $destinations = Destination::all();
        return view('dashboard.destination.index', compact('destinations'));
    }
    
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return view('dashboard.destination.show', compact('destination'));
    }

    public function create()
    {
        if (Auth::check() && (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin')) {
            return redirect()->route('dashboard.destination.index')->with('error', 'Akses ditolak. Hanya admin yang boleh.');
        }
        return view('dashboard.destination.create');
    }

    public function store(Request $request)
    {
        if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            return response()->json(['message' => 'Akses ditolak. Hanya admin yang boleh.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|max:2048',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path($this->mainImagePath), $imageName);
            $validated['image'] = $this->mainImagePath . '/' . $imageName;
        }

        if ($request->hasFile('additional_images')) {
            $additionalImages = [];
            foreach ($request->file('additional_images') as $file) {
                $imgName = time() . '_' . rand(1000, 9999) . '_' . $file->getClientOriginalName();
                $file->move(public_path($this->additionalImagePath), $imgName);
                $additionalImages[] = $this->additionalImagePath . '/' . $imgName;
            }
            $validated['additional_images'] = $additionalImages;
        } else {
            $validated['additional_images'] = [];
        }

        Destination::create($validated);
        return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            return redirect()->route('dashboard.destination.index')->with('error', 'Akses ditolak. Hanya admin yang boleh.');
        }
        return view('dashboard.destination.edit', compact('destination'));
    }
    
    public function update(Request $request, $id)
    {
        if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            return redirect()->route('dashboard.destination.index')->with('error', 'Akses ditolak. Hanya admin yang boleh.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'image|max:2048',
            'removed_images' => 'nullable|array',
            'existing_images' => 'nullable|array',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $destination = Destination::findOrFail($id);

        try {
            if ($request->hasFile('image')) {
                if ($destination->image && File::exists(public_path($destination->image))) {
                    File::delete(public_path($destination->image));
                }
                
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path($this->mainImagePath), $imageName);
                $validated['image'] = $this->mainImagePath . '/' . $imageName;
            }

            $currentAdditionalImages = is_array($destination->additional_images) ? $destination->additional_images : [];
            $finalAdditionalImages = [];
            
            // Proses gambar yang sudah ada
            if ($request->has('existing_images')) {
                $finalAdditionalImages = $request->input('existing_images', []);
            } else {
                $finalAdditionalImages = $currentAdditionalImages;
            }
            
            // Hapus gambar yang dipilih untuk dihapus
            if ($request->has('removed_images') && is_array($request->removed_images)) {
                foreach ($request->removed_images as $imageToRemove) {
                    if (File::exists(public_path($imageToRemove))) {
                        File::delete(public_path($imageToRemove));
                    }
                    
                    $finalAdditionalImages = array_filter($finalAdditionalImages, function ($img) use ($imageToRemove) {
                        return $img !== $imageToRemove;
                    });
                }
                $finalAdditionalImages = array_values($finalAdditionalImages);
            }

            // Tambahkan gambar baru
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $file) {
                    $imgName = time() . '_' . rand(1000, 9999) . '_' . $file->getClientOriginalName();
                    $file->move(public_path($this->additionalImagePath), $imgName);
                    $finalAdditionalImages[] = $this->additionalImagePath . '/' . $imgName;
                }
            }

            $validated['additional_images'] = $finalAdditionalImages;
            $destination->update($validated);

            return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui destinasi: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            return response()->json(['message' => 'Akses ditolak. Hanya admin yang boleh.'], 403);
        }

        $destination = Destination::findOrFail($id);

        if ($destination->image && File::exists(public_path($destination->image))) {
            File::delete(public_path($destination->image));
        }
        
        if (!empty($destination->additional_images) && is_array($destination->additional_images)) {
            foreach ($destination->additional_images as $image) {
                if (File::exists(public_path($image))) {
                    File::delete(public_path($image));
                }
            }
        }

        $destination->delete();

        return redirect()->route('dashboard.destination.index')->with('success', 'Destinasi berhasil dihapus.');
    }

    public function getDestinations()
    {
        $destinations = Destination::inRandomOrder()->limit(4)->get();

        $data = $destinations->map(function ($item) {
            $item->image = $item->image ? asset($item->image) : null;

            if ($item->additional_images && is_array($item->additional_images)) {
                $item->additional_images = array_map(function ($img) {
                    return asset($img);
                }, $item->additional_images);
            }

            return $item;
        });

        return response()->json($data);
    }
}

