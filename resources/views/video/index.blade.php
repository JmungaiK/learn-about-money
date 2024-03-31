<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Video Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">List of Videos:</h3>
                    <ul>
                        @foreach($videos as $video)
                        <li>
                            <span>{{ $video->title }}</span>
                            <div class="inline-block">
                                <!-- Edit video link -->
                                <a href="{{ route('video.edit', $video->id) }}" class="text-blue-500 hover:underline ml-4">Edit</a>
                                <!-- Delete video form -->
                                <form action="{{ route('video.destroy', $video->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-4" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    {{ $videos->links() }}
                </div>

                <div class="mt-4 p-6">
                    <!-- Add new video link -->
                    <a href="{{ route('video.create') }}" class="text-green-500 hover:underline">Add New Video</a>
                    <a href="{{ route('modulevideo.index') }}" class="text-orange-500 hover:underline ml-4">Back to Modules</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>