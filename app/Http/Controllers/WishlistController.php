<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Destination;

class WishlistController extends Controller
{
    // Menambahkan destinasi ke wishlist
    public function add(Request $request)
{
    // Pastikan user sudah login
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Ambil data destinasi berdasarkan ID
    $destination = Destination::find($request->destination_id);

    if (!$destination) {
        return redirect()->route('destinations.show', $request->destination_id)
                         ->with('error', 'Destinasi tidak ditemukan!');
    }

    // Cek jika destinasi sudah ada di wishlist
    $wishlist = Wishlist::where('user_id', Auth::id())->where('destination_id', $destination->id)->first();

    if ($wishlist) {
        return response()->json(['success' => false, 'message' => 'Destinasi sudah ada di wishlist.'], 400);
    }

    // Membuat entry baru di wishlist
    $wishlist = new Wishlist();
    $wishlist->user_id = Auth::id(); // Menyimpan ID pengguna yang login
    $wishlist->destination_name = $destination->name; // Menyimpan nama destinasi
    $wishlist->destination_image = $destination->image;
    $wishlist->destination_id = $request->destination_id; // Menyimpan ID destinasi
    $wishlist->save();

    return response()->json([
        'success' => true,
        'message' => 'Destinasi berhasil ditambahkan ke wishlist.'
    ]);
}

    // Menghapus destinasi dari wishlist
    public function remove($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        if ($wishlist->user_id != Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus destinasi ini.');
        }

        $wishlist->delete();
        return back()->with('success', 'Destinasi berhasil dihapus dari wishlist.');
    }

    public function show()
    {
    // Mengambil data wishlist pengguna yang sedang login
    $wishlists = Wishlist::where('user_id', Auth::id())->get();
    
    // Mengirim data ke view
    return view('wishlist.show', compact('wishlists'));
    }
    
    public function toggle(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => 'Anda belum login.'], 401);
    }

    $destinationId = $request->destination_id;
    $userId = Auth::id();

    $wishlist = Wishlist::where('user_id', $userId)
                ->where('destination_id', $destinationId)
                ->first();

    if ($wishlist) {
        $wishlist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Destinasi dihapus dari wishlist.',
            'in_wishlist' => false
        ]);
    } else {
        $destination = Destination::find($destinationId);

        if (!$destination) {
            return response()->json(['success' => false, 'message' => 'Destinasi tidak ditemukan.'], 404);
        }

        Wishlist::create([
            'user_id' => $userId,
            'destination_id' => $destinationId,
            'destination_name' => $destination->name,
            'destination_image' => $destination->image,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Destinasi ditambahkan ke wishlist.',
            'in_wishlist' => true
        ]);
    }
}
}
