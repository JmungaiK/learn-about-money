<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">User Information:</h3>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong>
                        @switch($user->role)
                        @case(1)
                        Admin
                        @break
                        @case(2)
                        Moderator
                        @break
                        @case(3)
                        User
                        @break
                        @endswitch
                    </p>
                    <!-- Add more user details here as needed -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>