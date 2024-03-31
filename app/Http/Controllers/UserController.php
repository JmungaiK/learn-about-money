<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use App\Models\Video;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve total users, active users, total modules, and total videos
        $totalUsers = User::count();
        $activeUsers = User::where('active', true)->count(); // Assuming you have an 'active' column
        $totalModules = Module::count();
        $totalVideos = Video::count();

        // Retrieve all users
        $users = User::paginate(10); // Adjust pagination as needed

        // Pass data to the view
        return view('user.index', compact('users', 'totalUsers', 'activeUsers', 'totalModules', 'totalVideos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'integer', 'in:1,2,3'], // 1 - admin, 2 - mod,  3 - user
        ]);

        // Create the new user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']), // Hash the password before storing
            'role' => $data['role'],
            'email_verified_at' => now(), // Set email_verified_at to now initially

        ]);

        // Redirect the user to the user details page after creation
        return redirect()->route('user.show', $user)->with('message', 'User created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id], // Ensure email uniqueness except for the current user
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Allow nullable password field
            'role' => ['required', 'integer', 'in:1,2,3'] // 1 - admin, 2 - mod,  3 - user
        ]);

        // Update the user's information
        $user->update($data);

        return redirect()->route('user.show', $user)->with('message', 'User was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('user.index')->with('message', 'User was deleted');
    }
}
