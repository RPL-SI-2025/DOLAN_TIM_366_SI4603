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
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        // Check if user already has a rating for this destination
        $existingRating = Rating::where('user_id', auth()->id())
                               ->where('destination_id', $destination->id)
                               ->first();

        if ($existingRating) {
            return response()->json([
                'error' => 'You have already rated this destination. You can edit your existing rating.',
                'existing_rating' => $existingRating
            ], 400);
        }

        return response()->json(['destination' => $destination]);
    }

    public function store(Request $request, Destination $destination)
    {
        if (!auth()->user()->isUser()) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        // Check if user already has a rating for this destination
        $existingRating = Rating::where('user_id', auth()->id())
                               ->where('destination_id', $destination->id)
                               ->first();

        if ($existingRating) {
            return response()->json([
                'error' => 'You have already rated this destination. You can edit your existing rating.',
                'existing_rating' => $existingRating
            ], 400);
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

        return response()->json([
            'success' => 'Rating submitted successfully',
            'rating' => $rating->load('user')
        ]);
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
        if (!auth()->user()->isUser() || auth()->id() !== $rating->user_id) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        return response()->json(['rating' => $rating]);
    }

    public function update(Request $request, Rating $rating)
    {
        if (!auth()->user()->isUser() || auth()->id() !== $rating->user_id) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string|max:1000',
        ]);

        $rating->update($validated);

        return response()->json([
            'success' => 'Rating updated successfully',
            'rating' => $rating->load('user')
        ]);
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

    public function getAllRatings(Destination $destination)
    {
        $ratings = $destination->ratings()->with('user')->latest()->get();
        return response()->json(['ratings' => $ratings]);
    }
}