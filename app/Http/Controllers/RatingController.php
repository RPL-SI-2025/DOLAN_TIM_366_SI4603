<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Destination;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()) {
            $ratings = Rating::with(['user', 'destination'])->latest()->paginate(10);
            return view('dashboard.ratings.index', compact('ratings'));
        }
        
        $ratings = Rating::with(['user', 'destination'])->latest()->paginate(10);
        return view('user.ratings.index', compact('ratings'));
    }

    public function create(Destination $destination)
    {
        if (!auth()->user()->isUser()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }
        return view('user.ratings.create', compact('destination'));
    }

    public function store(Request $request, Destination $destination)
    {
        if (!auth()->user()->isUser()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string|max:1000',
        ]);

        $rating = $destination->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'feedback' => $validated['feedback'],
        ]);

        return redirect()->route('destinations.show', $destination)
            ->with('success', 'Rating submitted successfully');
    }

    public function show(Rating $rating)
    {
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()) {
            return view('dashboard.ratings.show', compact('rating'));
        }
        return view('user.ratings.show', compact('rating'));
    }

    public function edit(Rating $rating)
    {
        if (auth()->id() !== $rating->user_id) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }
        return view('user.ratings.edit', compact('rating'));
    }

    public function update(Request $request, Rating $rating)
    {
        if (auth()->id() !== $rating->user_id) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string|max:1000',
        ]);

        $rating->update($validated);

        return redirect()->route('user.ratings.show', $rating)
            ->with('success', 'Rating updated successfully');
    }

    public function destroy(Rating $rating)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $rating->delete();
        return redirect()->route('dashboard.ratings.index')
            ->with('success', 'Rating deleted successfully');
    }

    public function byDestination(Destination $destination)
    {
        $ratings = $destination->ratings()->with('user')->latest()->paginate(10);
        return view('dashboard.ratings.by_destination', compact('destination', 'ratings'));
    }
} 