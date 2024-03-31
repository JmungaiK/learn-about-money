<x-app-layout>
    <div class="video-container single-video">
        <div class="video-header">

            <div class="mt-1 p-2">
                <a href="{{ route('dashboard') }}" class="video-cancel-button text-lg text-blue-500 hover:underline">Dashboard</a>
            </div>
            <div class="mt-1 p-2">
                <a href="{{ route('module.index') }}" class="video-cancel-button text-lg text-blue-500 hover:underline">Modules</a>
            </div>
            <div class="mt-1 p-2">
                <!-- Next video in the Module -->
                @if ($previousVideo)
                <a href="{{ route('video.show', $previousVideo->id) }}" class="text-lg text-yellow-500 hover:underline">Previous</a>
                @endif
            </div>
            <div class="mt-1 p-2">
                <!-- Next video in the Module -->
                @if ($nextVideo)
                <a href="{{ route('video.show', $nextVideo->id) }}" class="text-lg text-green-500 hover:underline">Next</a>
                @endif
            </div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight p-2">{{ $video->title }}</h2>
        </div>
        <div class="video">
            <div class="video-body">
                <video controls>
                    <source src="{{ $video->youtube_url }}" type="video/mp4" class="p-6 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight p-2">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="video-description">
                <p class="text-gray-600 dark:text-gray-300" p-4>{{ $video->description }}</p>
            </div>
            <div class="mt-2 p-2">
                @if ($progress)
                <!-- Form to update progress -->
                <form action="{{ route('progress.update', $progress->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="video_complete" value="1">
                    <button type="submit" class="end-video-button text-lg text-blue-500 hover:underline">Finish Video</button>
                </form>
                <!-- Add more progress-related content here -->
                @else
                <!-- Handle case when progress is null -->
                <p class="text-red-600 dark:text-red-300">No progress available for this video.</p>
                @endif
            </div>
            <!-- Ratings Section -->
            <div class="video-ratings">
                <div class="video-rating p-1 ml-3 text-gray-600 dark:text-gray-300">
                    Average Rating:
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$video->averageRating())
                        <i class="fas fa-star"></i> <!-- Solid star icon for filled rating -->
                        @else
                        <i class="far fa-star"></i> <!-- Outline star icon for empty rating -->
                        @endif
                        @endfor
                        ({{ $video->averageRating() }}) <!-- Display the average rating value -->
                </div>

                <!-- Rating Form -->
                <form action="{{ route('rating.store', $video->id) }}" method="POST">
                    @csrf
                    <div class="rating-input p-1 ml-3 text-gray-600 dark:text-gray-300">
                        Rate this video:
                        <div ml-4 p-5>
                            @for ($i = 1; $i <= 5; $i++) <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}">
                                <label for="rating{{ $i }}"><i class="fas fa-star"></i></label>
                                @endfor
                        </div>
                        <div ml-3 p-4>
                            <button type="submit" class="text-lg text-green-500 hover:underline">Rate</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Comment Form -->
            <div class="text-gray-600 dark:text-gray-300 p-0.5">
                <form action="{{ route('comment.store', $video) }}" method="POST">
                    @csrf
                    <input type="hidden" name="video_id" value="{{ $video->id }}">
                    <div class="form-group">
                        <label for="comment">Add a comment:</label>
                        <div class="text-gray-600 dark:text-gray-300">
                            <textarea class="form-control" name="comment" id="comment" rows="1"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="text-lg text-blue-500 hover:underline p-2">Comment</button>
                </form>
            </div>

            <!-- Comments Section -->
            <div class="mt-4 p-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <h2>Comments</h2>
            </div>
            <div class="text-gray-600 dark:text-gray-300 mt-3">

                @foreach($comments as $comment)
                <div class="comment">
                    <p class="font-sembold text-l"><strong>{{ $comment->user->name }}</strong>:
                        <br> {{ $comment->comment }}
                    </p>

                </div>
                @endforeach
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>