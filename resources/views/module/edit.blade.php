<x-app-layout>
    <h1>Edit Module</h1>



    <form action="{{ route('module.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="module">Module Name:</label>
            <input type="text" class="form-control" id="module" name="module" value="{{ $module->module }}">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $module->description }}</textarea>
        </div>

        <div class="video-buttons, mt-4 p-6">
            <button type="submit" class="text-blue-500 hover:underline ml-4">Update Module</button>
            <a href="{{ route('modulevideo.index') }}" class="video-cancel-button text-red-500 hover:underline ml-4">Cancel</a>
        </div>

    </form>
</x-app-layout>