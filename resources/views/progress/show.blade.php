<x-app-layout>
    <div class="container">
        <h1 class="ml-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Progress Details</h1>
        <div class="mt-2 p-2">
            <a href="{{ route('dashboard') }}" class="video-cancel-button text-blue-500 hover:underline ml-2">Dashboard</a>
        </div>
        <div class="mt-2 p-2 mb-3">
            <a href="{{ route('progress.index') }}" class="video-cancel-button text-blue-500 hover:underline ml-2">Go Back</a>
        </div>
        <p class="text-gray-900 dark:text-gray-100 ml-6 p-5"><strong>Video Title:</strong> {{ $progress->video->title }}</p>
        <p class="text-gray-900 dark:text-gray-100 mt-4 ml-5 p-5"><strong>Completion Status:</strong> {{ $progress->video_complete ? 'Complete' : 'Incomplete' }}</p>
        <!-- Add more details as needed -->
        <a href="{{ route('progress.edit', $progress) }}" class="text-blue-500 hover:underline ml-3 mt-7 p-4">Edit</a>

        <div>
            <!-- Delete Button -->
            <form action="{{ route('progress.destroy', $progress) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline ml-3 mt-3 p-3" onclick="return confirm('Are you sure you want to delete this progress entry?')">Delete</button>
            </form>
        </div>
    </div>
</x-app-layout>