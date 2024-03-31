<x-app-layout>
    <div class="container">
        <h1 class="ml-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Progress</h1>
        <div class="mt-2 p-2">
            <a href="{{ route('dashboard') }}" class="video-cancel-button text-purple-500 hover:underline ml-2">Dashboard</a>
        </div>
        <div class="mt-2 p-2 mb-3">
            <a href="{{ route('progress.index') }}" class="video-cancel-button text-orange-500 hover:underline ml-2">Go Back</a>
        </div>
        <form action="{{ route('progress.update', $progress) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="container form-group text-gray-900 dark:text-gray-100 mt-4 ml-5 p-5">
                <label for="video_complete">Completion Status:</label>
            </div>
            <div class="row ml-9">
                <select name="video_complete" id="video_complete" class="form-control">
                    <option value="0" {{ $progress->video_complete == 0 ? 'selected' : '' }}>Incomplete</option>
                    <option value="1" {{ $progress->video_complete == 1 ? 'selected' : '' }}>Complete</option>
                </select>
            </div>

            <button type="submit" class="text-blue-500 hover:underline mt-12 ml-5">Update Progress</button>
        </form>
    </div>
</x-app-layout>