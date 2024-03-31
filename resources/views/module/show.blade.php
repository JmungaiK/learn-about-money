<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Module Details') }}
        </h2>
    </x-slot>

    <div class="mt-4 ml-12 p-3">
        <a href="{{ route('dashboard') }}" class="video-cancel-button text-blue-500 hover:underline">Dashboard</a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">{{ $module->module }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $module->description }}</p>
                </div>

                <div class="mt-4 p-6 p-6 text-gray-900 dark:text-gray-100">
                    <!-- List of videos within the module -->
                    <h4 class="text-lg font-semibold mb-2">Videos:</h4>
                    <ul>
                        @foreach($videos as $video)
                        <li class="py-3">
                            <a href="{{ route('video.show', $video->id) }}"><img src="{{ $video->thumbnail }}" alt="video thumbnail" class="ml-24"></a>
                            <a href="{{ route('video.show', $video->id) }}">{{ $video->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                    {{ $videos->links() }}
                </div>


                <!-- Progress tracking for users or management options for moderators and administrators -->
                @if(auth()->user()->role([2, 1]))
                <!-- Management options for moderators and administrators -->
                <div class="mt-4">
                    <!-- Add management options here -->
                </div>
                @else
                <!-- Progress tracking for users -->
                <div class="mt-4">
                    <!-- Add progress tracking here -->
                </div>
                @endif
            </div>

            <div class="mt-4 p-6">
                <a href="{{ route('module.index') }}" class="text-purple-500 hover:underline">Back to Modules</a>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>