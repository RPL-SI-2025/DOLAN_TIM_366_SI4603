<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        // cek apakah admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak. Hanya admin yang boleh.',
            ], 403);
        }

        // Validasi data yang diterima
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //  upload gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public/images');
        }

        // Simpan ke database
        $article = Article::create($validated);

        return response()->json([
            'message' => 'Artikel berhasil dibuat.',
            'data' => $article,
        ], 201);
    }

    public function update(Request $request, $id)
{
    // Hanya admin
    if (Auth::check() && Auth::user()->role !== 'admin') {
        return response()->json([
            'message' => 'Akses ditolak. Hanya admin yang boleh.',
        ], 403);
    }

    // Cari artikel
    $article = Article::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'text' => 'sometimes|required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Upload gambar baru jika ada
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('public/images');
    }

    // Update data
    $article->update($validated);

    return response()->json([
        'message' => 'Artikel berhasil diperbarui.',
        'data' => $article,
    ]);
}

    public function destroy($id)
    {
        // Hanya admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak. Hanya admin yang boleh.',
            ], 403);
        }

        // Cari artikel
        $article = Article::findOrFail($id);

        // Hapus artikel
        $article->delete();

        return response()->json([
            'message' => 'Artikel berhasil dihapus.',
        ]);
    }
}
