<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Module;
use App\Models\ModuleVideo;
use App\Models\Progress;
use Illustrate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalVideos = Video::all();
        $videos = Video::paginate();
        return view('video.index', ['videos' => $videos]);

        return $totalVideos->toJson($totalVideos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['string'],
            'thumbnail' => ['required', 'string'],
            'youtube_url' => ['required', 'string'],
            'duration' => ['required', 'date_format:H:i:s']
        ]);

        $video = Video::create($data);

        return to_route('video.index')->with('message', 'Video was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {

        // Pass the $progress variable to the view
        $progress = Progress::where('video_id', $video->id)
            ->where('user_id', auth()->id())
            ->first();
        // Get the module of the current video
        $moduleVideo = ModuleVideo::where('video_id', $video->id)->first();

        // Check if the module video exists
        if (!$moduleVideo) {
            abort(404); // Or handle the error as appropriate for your application
        }

        // Retrieve the module
        $module = $moduleVideo->module;

        // Check if the module exists
        if (!$module) {
            abort(404); // Or handle the error as appropriate for your application
        }

        // Retrieve the videos associated with the module, ordered by a specific column
        $videos = $module->videos()->orderBy('order_column')->get();


        // Find the index of the current video
        $currentIndex = $videos->search(function ($item) use ($video) {
            return $item->id === $video->id;
        });

        // Determine if there is a previous video
        $previousVideo = null;
        if ($currentIndex !== false && $currentIndex > 0) {
            $previousVideo = $videos[$currentIndex - 1];
        }

        // Determine if there is a next video
        $nextVideo = null;
        if ($currentIndex !== false && $currentIndex < $videos->count() - 1) {
            $nextVideo = $videos[$currentIndex + 1];
        }

        // Retrieve ratings and comments for the current video
        $ratings = $video->ratings()->get();
        $comments = $video->comments()->paginate(20);

        return view('video.show', [
            'video' => $video,
            'ratings' => $ratings,
            'comments' => $comments,
            'nextVideo' => $nextVideo,
            'previousVideo' => $previousVideo,
            'progress' => $progress
        ]);
    }


    /**
     * Display the next specified resource.
     */


    /* public function shownext(Video $video)
    {
        //check the id of the current video

        //add to the id to the video of current

        //redirect to the desired video
        return view('video.show', ['video' => $video]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('video.edit', ['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['string'],
            'thumbnail' => ['required', 'string'],
            'youtube_url' => ['required', 'string'],
            'duration' => ['required', 'date_format:H:i:s']
        ]);

        $video->update($data);

        return to_route('video.index')->with('message', 'Video was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return to_route('video.index', $video)->with('message', 'Video was deleted');
    }
}
