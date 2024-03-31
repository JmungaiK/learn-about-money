<x-app-layout>
    <div class="container">
        <h1 class="ml-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Your Progress</h1>
        <div class="p-3 ml-3 ">
            <a href="{{ route('dashboard') }}" class="video-cancel-button text-blue-500 hover:underline">Dashboard</a>
        </div>
        @if ($progress->isEmpty())
        <p>No progress found.</p>
        @else
        <table class="table ml-10">
            <thead class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <tr class="ml-3 p-1">
                    <th>Video Title</th>
                    <th> Status </th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody class="text-gray-900 dark:text-gray-100">
                @foreach ($progress as $progressItem)
                <tr>
                    <td>{{ $progressItem->video->title }}</td>
                    <td class="ml-4">{{ $progressItem->video_complete ? 'Complete' : 'Incomplete' }}</td>
                    <td>
                        <a href="{{ route('progress.show', $progressItem) }}" class="text-blue-500 hover:underline ml-5">View</a>
                        <a href="{{ route('progress.edit', $progressItem) }}" class="text-purple-500 hover:underline ml-5">Edit</a>
                        <!-- Add delete button if necessary -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    {{ $progress->links() }}
</x-app-layout>