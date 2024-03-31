<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Module Index') }}
        </h2>
    </x-slot>

    <div class="mt-4 ml-12 p-3">
        <a href="{{ route('dashboard') }}" class="video-cancel-button text-blue-500 hover:underline">Dashboard</a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("List of available modules:") }}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-6">
                    @foreach($modules as $module)
                    <div class="bg-white dark:bg-gray-700 border dark:border-gray-600 rounded-lg shadow-md p-4">
                        <h2 class="text-lg font-semibold font-size-large mb-2">{{ $module->module }}</h2>
                        <p class="text-gray-600 dark:text-gray-300">{{ $module->description }}</p>
                        <div class="mt-4">
                            <a href="{{ route('module.show', $module->id) }}" class="text-blue-500 hover:underline">View Details</a>
                        </div>
                    </div>
                    @endforeach
                    {{ $modules->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>