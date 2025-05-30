<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchandiseController extends Controller
{
    
   public function indexAdmin()
    {
        $merchandise = Merchandise::all();  // Ambil semua data dari DB untuk admin
        return view('dashboard.merchandise.index', compact('merchandise'));
    }

    // Daftar merchandise untuk user umum
    public function index()
    {
        $merchandise = Merchandise::all();  // Ambil semua data dari DB untuk user
        return view('merchandise.index', compact('merchandise'));
    }

    // Detail merchandise untuk user umum berdasarkan ID
    public function show($id)
    {
        $merchandise = Merchandise::findOrFail($id);  // Cari berdasarkan ID, jika tidak ada throw 404
        $sizes = $merchandise->size;
        return view('merchandise.show', compact('merchandise'));
    }

    // Detail merchandise untuk Admin berdasarkan ID
    public function showAdmin($id)
    {
        $merchandise = Merchandise::findOrFail($id);
        return view('dashboard.merchandise.show', compact('merchandise'));
    }


    public function create()
    {
        return view('dashboard.merchandise.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric',
            'detail' => 'nullable|string',
            'size' => 'nullable|array',               // size nullable
            'size.*' => 'string|max:50',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if (!isset($validated['size'])) {
            $validated['size'] = null; // atau [] jika ingin default array kosong
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('merchandise-images', 'public');
        }

        Merchandise::create($validated);

        return redirect()->route('dashboard.merchandise.index')->with('success', 'Merchandise berhasil ditambahkan.');
    }

    public function edit(Merchandise $merchandise)
    {
        return view('dashboard.merchandise.edit', compact('merchandise'));
    }

    public function update(Request $request, Merchandise $merchandise)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric',
            'detail' => 'nullable|string',
            'size' => 'nullable|array',               // size nullable
            'size.*' => 'string|max:50',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if (!isset($validated['size'])) {
            $validated['size'] = null; // atau [] jika ingin default array kosong
        }

        if ($request->hasFile('image')) {
            if ($merchandise->image && Storage::disk('public')->exists($merchandise->image)) {
                Storage::disk('public')->delete($merchandise->image);
            }
            $validated['image'] = $request->file('image')->store('merchandise-images', 'public');
        }

        $merchandise->update($validated);

        return redirect()->route('dashboard.merchandise.index')->with('success', 'Merchandise berhasil diperbarui.');
    }

    public function destroy(Merchandise $merchandise)
    {
        if ($merchandise->image && Storage::disk('public')->exists($merchandise->image)) {
            Storage::disk('public')->delete($merchandise->image);
        }

        $merchandise->delete();

        return redirect()->route('dashboard.merchandise.index')->with('success', 'Merchandise berhasil dihapus.');
    }
 
}