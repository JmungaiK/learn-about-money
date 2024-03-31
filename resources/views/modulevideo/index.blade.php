<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Module Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">List of Modules:</h3>
                    <ul>
                        @foreach($modules as $module)
                        <li>
                            <span>{{ $module->module }}</span>
                            <div class="inline-block, mt-4 p-3">
                                <!-- Show module link -->
                                <a href="{{ route('modulevideo.show', $module->id) }}" class="text-blue-500 hover:underline ml-4">Details</a>
                                <!-- Edit module link -->
                                <a href="{{ route('module.edit', $module->id) }}" class="text-blue-500 hover:underline ml-4">Edit</a>
                                <!-- Delete module form -->
                                <form action="{{ route('module.destroy', $module->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-4" onclick="return confirm('Are you sure you want to delete this module?')">Delete</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    {{ $modules->links()}}
                </div>

                <div class="mt-4 p-6">
                    <!-- Add new module link -->
                    <a href="{{ route('modulevideo.create') }}" class="text-blue-500 hover:underline">Add New Module</a>
                    <a href="{{ route('mod') }}" class="text-blue-500 hover:underline ml-4">Back to Moderator Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>