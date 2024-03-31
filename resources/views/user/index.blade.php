<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">List of Users:</h3>
                    <!-- Display system statistics and reports here -->
                    <h3 class="text-lg font-semibold mt-4">System Statistics:</h3>
                    <p>Total Registered Users: {{ $totalUsers }}</p>
                    <p>Total Active Users: {{ $activeUsers }}</p>
                    <p>Total Modules: {{ $totalModules }}</p>
                    <p>Total Videos: {{ $totalVideos }}</p>
                    <!-- Add more statistics and reports as needed -->
                    <ul>
                        @foreach($users as $user)
                        <li>
                            <span>{{ $user->name }}</span>
                            <div class="inline-block">
                                <!-- View user details link -->
                                <a href="{{ route('user.show', $user->id) }}" class="text-blue-500 hover:underline ml-4">View Details</a>
                                <!-- Edit user roles link -->
                                <a href="{{ route('user.edit', $user->id) }}" class="text-blue-500 hover:underline ml-4">Edit Roles</a>
                                <!-- Delete user form -->
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-4" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    {{ $user->links() }}
                </div>

                <div class="mt-4 p-6">
                    <!-- Add new user link -->
                    <a href="{{ route('user.create') }}" class="text-blue-500 hover:underline">Add New User</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>