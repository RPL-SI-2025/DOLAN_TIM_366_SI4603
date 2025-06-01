<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    public function index()
    {
        $merchandises = Merchandise::all();
        return view('dashboard.merchandise.index', compact('merchandises'));
    }

    public function publicIndex()
    {
        $merchandises = Merchandise::all();
        return view('merchandise.index', compact('merchandises'));
    }

    public function publicShow(Merchandise $merchandise)
    {
        return view('merchandise.show', compact('merchandise'));
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
            'size' => 'nullable|string|max:255', // size sebagai string dan nullable
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('merchandise-images', 'public');
        }

        Merchandise::create($validated);

        return redirect()->route('dashboard.merchandise.index')->with('success', 'Merchandise berhasil ditambahkan.');
    }

    public function show(Merchandise $merchandise)
    {
        return view('dashboard.merchandise.show', compact('merchandise'));
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
            'size' => 'nullable|string|max:255', // size sebagai string dan nullable
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

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

    public function showPurchaseForm(Merchandise $merchandise)
    {
        if ($merchandise->stock <= 0) {
            return redirect()->route('merchandise.show', $merchandise->id)
                ->with('error', 'Sorry, this merchandise is currently out of stock.');
        }

        return view('merchandise.merch_form', compact('merchandise'));
    }
}