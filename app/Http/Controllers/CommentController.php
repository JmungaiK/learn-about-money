<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::paginate(10);
        return view('comment.index', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $videoId = $request->input('video_id'); #


        // Validate the incoming request data
        $request->validate([
            'comment' => 'required|string|max:255',
            'video_id' => 'required|integer', // Validate the 'video_id' field
            'user_id' => 'required|integer', // Validate the 'user_id' field
        ]);


        // Create a new comment instance
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->user_id = auth()->id(); // Assuming the user is authenticated
        $comment->video_id = $videoId;
        $comment->save();

        // Redirect back to the video page with a success message
        return redirect()->route('video.show', $request->video)->with('success', 'Comment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        if ($comment->video_id !== request()->video()->id) {
            abort(403);
        }
        return view('comment.show', ['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {

        if ($comment->video_id !== request()->video()->id) {
            abort(403);
        }
        return view('comment.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if ($comment->video_id !== request()->video()->id) {
            abort(403);
        }
        $data = $request->validate([
            'comment' => ['string'],
        ]);

        $comment->update($data);

        return to_route('comment.show', $comment)->with('success', __("Comment has been updated"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->video_id !== request()->video()->id) {
            abort(403);
        }

        $comment->delete();

        return to_route('comment.index', $comment)->with('success', __("Comment has been deleted"));
    }
}
