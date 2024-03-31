<x-app-layout>
    <h1>Show Module Video</h1>


    <!-- Display details about the associated Module -->
    <h2>Associated Module</h2>
    @if ($module)
    <p>Module Name: {{ $module->module }}</p>
    @if ($module->description)
    <p>Description: {{ $module->description }}</p>
    @else
    <p>No description available for this module.</p>
    @endif
    @else
    <p>No associated module found.</p>
    @endif
    <div class=" mt-4 p-6">
        <a href="{{ route('modulevideo.index') }}" class="video-cancel-button text-blue-500 hover:underline ml-4">Back To Modules</a>
    </div>
</x-app-layout>