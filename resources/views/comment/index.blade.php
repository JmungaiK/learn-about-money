<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">List of Comments:</h3>
                    <ul>
                        @foreach($comments as $comment)
                        <li class="py-4">
                            <span>{{ $comment->comment }}</span>
                        </li>
                        @endforeach
                        {{$comments->links()}}
                    </ul>
                </div>

                <div class="mt-4 p-6">
                    <!-- Add new video link -->
                    <a href="{{ route('modulevideo.index') }}" class="text-purple-500 hover:underline ml-4">Back to Modules</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>