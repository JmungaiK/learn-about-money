<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as an administrator!") }}


                </div>

                @if(auth()->user()->role(1)) <!--  '1' represents the admin role -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- User management options -->
                    <h3 class="text-lg font-semibold mt-4">User Management:</h3>
                    <div class="mt-3 p-3">
                        <a href="{{ route('user.index') }}" class="video-cancel-button text-gray-500 hover:underline">View Users</a>
                    </div>
                    <div class="mt-3 p-3">
                        <a href="{{ route('user.create') }}" class="video-cancel-button text-gray-500 hover:underline">Create User</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>