<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone'   => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'avatar'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);

        $user = User::find(Auth::id());

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        if ($request->hasFile('avatar')) {
            // Hapus foto lama kalau ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Upload foto baru
            $path = $request->file('avatar')->store('profile_photos', 'public');
            $user->update(['profile_photo_path' => $path]);
        }

        return redirect()->route('user.profile.show')->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroy(Request $request)
    {
        $authUser = Auth::user();
        $user = User::find($authUser->id);

        // Hapus foto profil dari storage kalau ada
        if ($user && $user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Logout dulu supaya tidak error auth setelah delete
        Auth::logout();

        // Hapus akun
        if ($user) {
            $user->delete();
        }

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
