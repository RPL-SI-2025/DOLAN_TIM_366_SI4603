<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Badge;
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
    public function createForUser()
{
    // Jika user adalah admin, arahkan ke form admin
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'super_admin'])) {
        return redirect()->route('dashboard.destination.create')
                         ->with('info', 'Gunakan form khusus admin.');
    }
    return view('user.crowdsourcing.create');
}
    

public function store(Request $request)
{
    // Validasi data yang masuk
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'image' => 'required|image|max:2048',
        'additional_images' => 'nullable|array',
        'additional_images.*' => 'image|max:2048',
        'stock' => 'nullable|integer|min:0',
        'price' => 'nullable|numeric|min:0|max:999999999.99',
        'tour_includes' => 'nullable|string',
        'tour_payments' => 'nullable|string',
        'has_ticket' => 'nullable|boolean',
        'status' => 'nullable|string|max:255',
        
    ]);

    // Tambahkan user_id agar relasi dapat tersimpan
    $validated['user_id'] = Auth::id();

    // Jika admin/super_admin, tetapkan status "approved"
    if (in_array(Auth::user()->role, ['admin', 'super_admin'])) {
        $validated['status'] = 'approved';
    } else {
        // Untuk user biasa: status "pending" dan force has_ticket false
        $validated['status'] = 'pending';
        $validated['has_ticket'] = 0;
    }

    // Set nilai default jika has_ticket false
    if (isset($validated['has_ticket']) && $validated['has_ticket'] == 0) {
        $validated['stock'] = 0;
        $validated['price'] = 0;
        $validated['tour_payments'] = null;
    }

    // Upload gambar utama
    if ($request->hasFile('image')) {
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path($this->mainImagePath), $imageName);
        $validated['image'] = $this->mainImagePath . '/' . $imageName;
    }

    // Upload gambar tambahan
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

    try {
        $destination = Destination::create($validated);
        return redirect()->route('home')
                         ->with('success', 'Destinasi berhasil ditambahkan! Terima kasih telah mengirimkan destinasi.');
    } catch (\Exception $e) {
        return redirect()->back()
                         ->with('error', 'Gagal menambahkan destinasi: ' . $e->getMessage())
                         ->withInput();
    }
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
            'stock' => 'required_if:has_ticket,1|integer|min:0|nullable',
            'price' => 'required_if:has_ticket,1|numeric|min:0|nullable',
            'tour_includes' => 'nullable|string',
            'tour_payments' => 'nullable|string',
            'has_ticket' => 'nullable|boolean',
            'status' => 'nullable|string|max:255', // penambahan field status

        ]);

        // Set appropriate values when has_ticket is false
        if (isset($validated['has_ticket']) && $validated['has_ticket'] == 0) {
            $validated['stock'] = 0;
            $validated['price'] = 0;
            $validated['tour_payments'] = null;
        }

        $destination = Destination::findOrFail($id);

        try {
            // Handle main image update
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($destination->image && File::exists(public_path($destination->image))) {
                    File::delete(public_path($destination->image));
                }
                
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path($this->mainImagePath), $imageName);
                $validated['image'] = $this->mainImagePath . '/' . $imageName;
            }

            // Handle additional images
            $currentAdditionalImages = is_array($destination->additional_images) ? $destination->additional_images : [];
            $finalAdditionalImages = [];
            
            // Keep existing images that weren't removed
            if ($request->has('existing_images')) {
                $finalAdditionalImages = $request->input('existing_images', []);
            } else {
                $finalAdditionalImages = $currentAdditionalImages;
            }
            
            // Delete removed images from storage
            if ($request->has('removed_images') && is_array($request->removed_images)) {
                foreach ($request->removed_images as $imageToRemove) {
                    // Check if file exists before deleting
                    if (File::exists(public_path($imageToRemove))) {
                        File::delete(public_path($imageToRemove));
                    }
                    
                    // Remove from the final images array
                    $finalAdditionalImages = array_filter($finalAdditionalImages, function ($img) use ($imageToRemove) {
                        return $img !== $imageToRemove;
                    });
                }
                $finalAdditionalImages = array_values($finalAdditionalImages);
            }

            // Add new additional images
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

        // Delete main image if exists
        if ($destination->image && File::exists(public_path($destination->image))) {
            File::delete(public_path($destination->image));
        }
        
        // Delete all additional images if they exist
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

    // Add a new method to handle AJAX image deletion
    public function removeImage(Request $request)
    {
        if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Hanya admin yang boleh.'], 403);
        }

        $imagePath = $request->input('image_path');
        
        if (!$imagePath) {
            return response()->json(['success' => false, 'message' => 'Path gambar tidak ditemukan.'], 400);
        }

        try {
            // Check if file exists before attempting to delete
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
                return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus.']);
            } else {
                return response()->json(['success' => false, 'message' => 'File tidak ditemukan.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus gambar: ' . $e->getMessage()], 500);
        }
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

    public function showAllDestinations()
    {
        $destinations = Destination::all();
        return view('user.destinations.index', compact('destinations'));
    }

    public function showDestination($id)
    {
        $destinations = Destination::findOrFail($id);
        $other_destinations = Destination::where('id', '!=', $id)->get();
        return view('user.destinations.show', compact('destinations', 'other_destinations'));
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|in:approved,denied',
    ]);

    $destination = Destination::findOrFail($id);
    $destination->update(['status' => $request->status]);

    if ($request->status === 'approved') {
        $user = $destination->user;
        $user->points += 10;
        $user->save();
    }
        // Cek apakah sudah punya badge
        if (!$user->badges()->where('name', 'Kontributor Pertama')->exists()) {
            $badge = Badge::firstOrCreate([
                'name' => 'Kontributor Pertama'
            ], [
                'description' => 'Mendapatkan persetujuan untuk destinasi pertama',
                'icon' => 'icons/first_contributor.png', // opsional
            ]);

            $user->badges()->attach($badge->id);
        }

    return redirect()->back()->with('success', 'Status berhasil diubah menjadi ' . $request->status);
}

public function userDestinations()
{
    $destinations = Destination::where('user_id', Auth::id())->get();
    return view('user.crowdsourcing.index', compact('destinations'));
}
}
