<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    private $mainImagePath = 'destinations';
    private $additionalImagePath = 'destinations/additional';

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

    public function edit($id)
    {
        if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            return redirect()->route('dashboard.destination.index')->with('error', 'Akses ditolak. Hanya admin yang boleh.');
        }
        
        $destination = Destination::findOrFail($id);
        return view('dashboard.destination.edit', compact('destination'));
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
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'image' => 'required|image|max:2048',
        'additional_images' => 'nullable|array',
        'additional_images.*' => 'image|max:2048',
        // Remove stock and price validation
        'tour_includes' => 'nullable|string',
        'tour_payments' => 'nullable|string',
        'has_ticket' => 'nullable|boolean',
        'status' => 'nullable|string|max:255',
    ]);

    $validated['user_id'] = Auth::id();

    if (in_array(Auth::user()->role, ['admin', 'super_admin'])) {
        $validated['status'] = 'approved';
    } else {
        $validated['status'] = 'pending';
        $validated['has_ticket'] = 0;
    }

    // Remove stock and price setting logic

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store($this->mainImagePath, 'public');
    }

    if ($request->hasFile('additional_images')) {
        $additionalImages = [];
        foreach ($request->file('additional_images') as $file) {
            $additionalImages[] = $file->store($this->additionalImagePath, 'public');
        }
        $validated['additional_images'] = $additionalImages;
    } else {
        $validated['additional_images'] = [];
    }

    try {
        $destination = Destination::create($validated);
        
        // Logic if-else untuk redirect berdasarkan role user
        if (in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            // Jika admin, redirect ke dashboard destinations dengan pesan sukses
            return redirect()->route('dashboard.destination.index')
                             ->with('success', 'Destinasi berhasil ditambahkan dan langsung disetujui.');
        } else {
            // Jika user biasa, redirect ke daftar kontribusi mereka
            return redirect()->route('user.destinations.index')
                             ->with('success', 'Destinasi berhasil ditambahkan! Terima kasih telah mengirimkan destinasi.');
        }
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
        // Remove stock and price validation
        'tour_includes' => 'nullable|string',
        'tour_payments' => 'nullable|string',
        'has_ticket' => 'nullable|boolean',
        'status' => 'nullable|string|max:255',
    ]);

    // Remove stock and price setting logic

    $destination = Destination::findOrFail($id);

    try {
        // Handle main image update menggunakan Storage
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($destination->image && Storage::disk('public')->exists($destination->image)) {
                Storage::disk('public')->delete($destination->image);
            }
            
            $validated['image'] = $request->file('image')->store($this->mainImagePath, 'public');
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
                if (Storage::disk('public')->exists($imageToRemove)) {
                    Storage::disk('public')->delete($imageToRemove);
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
                $finalAdditionalImages[] = $file->store($this->additionalImagePath, 'public');
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

        // Delete main image if exists menggunakan Storage
        if ($destination->image && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
        }
        
        // Delete all additional images if they exist menggunakan Storage
        if (!empty($destination->additional_images) && is_array($destination->additional_images)) {
            foreach ($destination->additional_images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
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
            // Check if file exists before attempting to delete menggunakan Storage
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
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
        $destinations = Destination::where('status', 'approved')->get();
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

        $levels = [
            10  => 1,
            100 => 2,
            200 => 3,
        ];

        // Cek setiap level, attach badge jika user sudah mencapai threshold dan belum memiliki badge
        foreach ($levels as $threshold => $badgeId) {
            if ($user->points >= $threshold) {
                if (!$user->badges()->where('badges.id', $badgeId)->exists()) {
                    $user->badges()->attach($badgeId);
                }
            }
        }
    }

    return redirect()->back()->with('success', 'Status berhasil diubah menjadi ' . $request->status);
}
public function userDestinations()
{
    $user = Auth::user();
    
    // Jika user saat ini adalah admin/super_admin, jangan tampilkan destinasi apapun di contribute list
    if (in_array($user->role, ['admin', 'super_admin'])) {
        $destinations = collect(); // Empty collection
    } else {
        // Untuk user biasa, tampilkan semua destinasi yang mereka buat
        $destinations = Destination::where('user_id', Auth::id())->get();
    }
    
    return view('user.crowdsourcing.index', compact('destinations'));
}
}
