<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display a listing of the user's progress.
     */
    public function index()
    {
        $users = User::get();
        $user = User::get(1);
        // Retrieve the user's progress and paginate the results
        $progress = Progress::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate();

        // Pass the progress data to the view
        return view('progress.index', [
            'progress' => $progress,
            'users' => $users,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not implemented
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Not implemented
    }

    /**
     * Display the specified resource.
     */
    public function show(Progress $progress)
    {
        // Check if the progress belongs to the authenticated user
        if ($progress->user_id !== auth()->id()) {
            abort(403);
        }

        // Pass the progress data to the view
        return view('progress.show', compact('progress'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Progress $progress)
    {
        // Check if the progress belongs to the authenticated user
        if ($progress->user_id !== auth()->id()) {
            abort(403);
        }

        // Pass the progress data to the view
        return view('progress.edit', compact('progress'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Progress $progress)
    {
        // Check if the progress belongs to the authenticated user
        if ($progress->user_id !== auth()->id()) {
            abort(403);
        }

        // Validate the request data (optional)
        $request->validate([
            'video_complete' => 'required|boolean',
        ]);

        // Update the video_complete column to 1 if it's not already set to 1
        if (!$progress->video_complete) {
            $progress->update(['video_complete' => true]);
        }

        // Redirect back to the progress index page with a success message
        return redirect()->route('progress.index')->with('message', 'Video marked as complete.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        // Check if the progress belongs to the authenticated user
        if ($progress->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete the progress
        $progress->delete();

        // Redirect back to the progress index page with a success message
        return redirect()->route('progress.index')->with('message', 'You deleted your progress');
    }
}
