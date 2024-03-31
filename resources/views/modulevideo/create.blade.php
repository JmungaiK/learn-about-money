<x-app-layout>
    <div class="container">
        <h1>Create Module</h1>



        <form action="{{ route('module.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="module">Module Name:</label>
                <input type="text" name="module" id="module" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>
            <div class="mt-4 p-6">
                <button type="submit" class="text-blue-500 hover:underline ml-4">Create Module</button>
                <a href="{{ route('modulevideo.index') }}" class="video-cancel-button text-red-500 hover:underline ml-4">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>