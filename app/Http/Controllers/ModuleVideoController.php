<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleVideo;
use Illuminate\Http\Request;

class ModuleVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::with('videos')->paginate(5);
        $moduleVideos = ModuleVideo::paginate(3);
        return view('modulevideo.index', [
            'moduleVideos' => $moduleVideos,
            'modules' => $modules
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modulevideo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'video_id' => ['required, integer'],
            'module_id' => ['required, integer']
        ]);

        $moduleVideo = ModuleVideo::create($data);

        return to_route('modulevideo.show', $moduleVideo)->with('message', 'Connection was created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ModuleVideo $moduleVideo)
    {
        // Get the module ID from the module video
        $moduleId = $moduleVideo->module_id;

        // Retrieve the module details directly from the Module model
        $module = Module::find($moduleId);

        // Pass the module and module videos to the view
        return view('modulevideo.show', ['moduleVideo' => $moduleVideo, 'module' => $module]);
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModuleVideo $moduleVideo, module $module)
    {
        return view('modulevideo.edit', ['moduleVideo' => $moduleVideo, 'module' => $module]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModuleVideo $moduleVideo)
    {
        $data = $request->validate([
            'video_id' => ['required, integer'],
            'module_id' => ['required, integer']
        ]);

        $data['video_id'] = $request->video()->id;
        $data['module_id'] = $request->module()->id;
        $moduleVideo->update($data);

        return to_route('modulevideo.show', $moduleVideo)->with('message', 'Connection was updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModuleVideo $moduleVideo)
    {
        $moduleVideo->delete();

        return to_route('moduleVideo.index')->with('message', 'Connection was deleted Successfully');
    }
}
