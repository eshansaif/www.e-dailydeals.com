@foreach($featured_posts as $post)
    <div class="featured-post">
        <!-- Post Thumbnail -->
        <a href="{{ route('blog.details',$post->id) }}">
            <img src="{{ asset($post->file) }}" alt="" class="img-fluid">
        </a>
        <!-- Post Title -->
        <div class="featured-post-title">
            <h6> <a href="{{ route('blog.details',$post->id) }}">{{ $post->title }}</a> </h6>
        </div>
    </div>
<!-- End of Single Post -->
@endforeach<!-- Single Post -->