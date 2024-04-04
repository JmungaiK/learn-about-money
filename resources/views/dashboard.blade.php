<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <div class="mt-4 p-6">
                    <a href="{{ route('module.index') }}" class="video-cancel-button text-purple-500 hover:underline ml-4">Modules</a>
                </div>
                <div class="mt-4 p-6">
                    <a href="{{ route('progress.index') }}" class="video-cancel-button text-green-500 hover:underline ml-4">Your progress</a>
                </div>
                <div class="mt-4 p-6">
                    <a href="{{ route('report.generate', ['type' => 'modules']) }}" class="video-cancel-button text-orange-500 hover:underline ml-4">Download Modules Report</a>
                </div>
                <div class="mt-4 p-6">
                    <a href="{{ route('report.generate', ['type' => 'videos']) }}" class="video-cancel-button text-gray-500 hover:underline ml-4">Download Videos Report</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>