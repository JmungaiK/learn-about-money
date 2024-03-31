<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::paginate();
        return view('rating.index', ['ratings' => $ratings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rating.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $videoId)
    {
        // Check if the user has already rated the video
        $existingRating = Rating::where('user_id', $request->user()->id)
            ->where('video_id', $videoId)
            ->first();

        // If the user has already rated the video, prevent them from submitting another rating
        if ($existingRating) {
            return redirect()->back()->with('error', 'You have already rated this video.');
        }

        // If the user has not rated the video before, proceed with storing the new rating
        $data = $request->validate([
            'rating' => ['integer']
        ]);

        $data['user_id'] = $request->user()->id;
        $data['video_id'] = $videoId;

        $rating = Rating::create($data);

        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        if ($rating->video_id !== request()->video()->id) {
            abort(403);
        }
        return view('rating.show', ['rating' => $rating]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        if ($rating->video_id !== request()->video()->id) {
            abort(403);
        }
        return view('rating.edit', ['rating' => $rating]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        if ($rating->video_id !== request()->video()->id) {
            abort(403);
        }
        $data = $request->validate([
            'rating' => ['integer']
        ]);

        $rating->update($data);

        return to_route('rating.show', $rating)->with('message', 'Rating was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        if ($rating->video_id !== request()->video()->id) {
            abort(403);
        }
        $rating->delete();

        return to_route('rating.index', $rating)->with('message', 'Rating was deleted');
    }
}
