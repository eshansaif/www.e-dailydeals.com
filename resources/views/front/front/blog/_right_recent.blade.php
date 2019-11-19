@foreach($recent_posts as $post)
    <div class="wrp-cover">
        <!-- Post Thumbnail -->
        <div class="post-thumb">
            <a href="{{ route('blog.details',$post->id) }}">
                <img src="{{ asset($post->file) }}" alt="" class="img-fluid">
            </a>
        </div>
        <!-- Post Title -->
        <div class="post-title">
            <a href="{{ route('blog.details',$post->id) }}">{{ $post->title }}</a>
        </div>
    </div>
@endforeach