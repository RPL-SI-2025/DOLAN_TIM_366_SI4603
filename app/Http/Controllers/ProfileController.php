<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan profil pengguna yang sedang login.
     */
    public function show()
    {
        $user = Auth::user();
        return view('dashboard.profile.show', compact('user'));
    }

    /**
     * Menampilkan form edit profil pengguna.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    /**
     * Menyimpan perubahan profil pengguna.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone'   => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'avatar'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Update data pengguna (nama, email, telepon, alamat)
        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        // Cek jika ada file gambar yang diupload
        if ($request->hasFile('avatar')) {
            // Hapus foto profil lama jika ada
            if ($user->profile_photo_path) {
                Storage::delete($user->profile_photo_path);
            }

            // Simpan foto profil baru
            $path = $request->file('avatar')->store('profile_photos', 'public'); // Menyimpan di folder storage/app/public/profile_photos

            // Update path foto profil pengguna
            $user->update(['profile_photo_path' => $path]);
        }

        return redirect()->route('dashboard.profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}

