<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Video;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all modules, videos
        $modules = Module::with('videos')->paginate(3);
        $totalModules = Module::count();

        // Check if the user is authenticated
        if (auth()->check()) {
            // If the user is authenticated, return the view with modules
            return view('module.index', compact(
                'modules',
                'totalModules'
            ));
        } else {
            // Else, redirect to login page
            return redirect('/login');
        }
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
            'module' => ['required', ' string', ' max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $module = Module::create($data);

        return to_route('modulevideo.show', $module)
            ->with('message', 'Module created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        // Retrieve videos associated with the module
        $videos = $module->videos(true)->paginate(3);

        return view('module.show', [
            'module' => $module,
            'videos' => $videos
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return view('module.edit', ['module' => $module]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $data = $request->validate([
            'module' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000']
        ]);

        $module->update($data);

        return to_route('modulevideo.show', $module)
            ->with('message', 'Module updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {

        $module->delete();

        return to_route('module.index')
            ->with('message', 'Module deleted successfully');
    }
}
