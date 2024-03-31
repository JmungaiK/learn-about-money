<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Moderator Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as a moderator!") }}
                </div>

                @if(auth()->user()->role(2)) <!-- '2' represents the moderator role -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Moderator tasks and management options -->
                    <h3 class="text-lg font-semibold mt-4">Moderation Tasks:</h3>
                    <div class="mt-4 p-6">
                        <a href="{{ route('video.index') }}" class="video-cancel-button text-green-500 hover:underline ml-4">Videos</a>
                    </div>
                    <div class="mt-4 p-6">
                        <a href="{{ route('comment.index') }}" class="video-cancel-button text-orange-500 hover:underline ml-4">Comments</a>
                    </div>
                    <div class="mt-4 p-6">
                        <a href="{{ route('modulevideo.index') }}" class="video-cancel-button text-yellow-500 hover:underline ml-4">Modules</a>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>