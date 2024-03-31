<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome to the Reports Page!") }}

                    <!-- Display options to generate and view reports -->
                    <h3 class="text-lg font-semibold mt-4">Generate Reports:</h3>
                    <div class="video-buttons">
                        <a href="{{ route('report.user_activity') }}" class="video-cancel-button btn primary-btn">User Activity</a>
                    </div>
                    <div class="video-buttons">
                        <a href="{{ route('report.video_completion') }}" class="video-cancel-button btn primary-btn">Video Completion Rates</a>
                    </div>
                    <div class="video-buttons">
                        <a href="{{ route('report.module_progress') }}" class="video-cancel-button btn primary-btn">Module Progress</a>
                    </div>
                    <!-- Add more report options as needed -->

                    <!-- Display report viewing options -->
                    <h3 class="text-lg font-semibold mt-6">View Reports:</h3>
                    <div class="video-buttons">
                        <a href="{{ route('report.view', ['type' => 'user_activity']) }}" class="video-cancel-button btn primary-btn">View User Activity</a>
                    </div>
                    <div class="video-buttons">
                        <a href="{{ route('report.view', ['type' => 'video_completion']) }}" class="video-cancel-button btn primary-btn">View Video Completion Rates</a>
                    </div>
                    <div class="video-buttons">
                        <a href="{{ route('report.view', ['type' => 'module_progress']) }}" class="video-cancel-button btn primary-btn">View Module Progress</a>
                    </div>
                    <!-- Add more report viewing options as needed -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
