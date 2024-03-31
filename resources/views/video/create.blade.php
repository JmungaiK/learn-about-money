<x-app-layout>
    <div class="video-container single-video">
        <h1>Add new Video</h1>
        <form action="{{ route('video.store') }}" method="post" class="video">
            @csrf

            <textarea name="title" rows="10" class="video-title-body" placeholder="Add the title here"></textarea>
            <textarea name="description" rows="10" class="video-description-body" placeholder="Add the description here"></textarea>
            <textarea name="thumbnail" rows="10" class="video-thumbnail-body" placeholder="Add the thumbnail here"></textarea>
            <textarea name="youtube_url" rows="10" class="video-url-body" placeholder="Add the Youtube_url here"></textarea>
            <input type="text" name="duration" class="video-duration-body" placeholder="Duration (HH:MM:SS)">
            <div class="mt-3">
                <button class="video-submit-button text-blue-500 hover:underline">Submit</button>
            </div>
        </form>
        <div class="mt-2">
            <a href="{{ route('video.index') }}" class="text-red-500 hover:underline">Cancel</a>
        </div>
    </div>
    </div>
</x-app-layout>