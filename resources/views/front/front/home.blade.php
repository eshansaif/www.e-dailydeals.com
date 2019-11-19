@extends('layouts.frontend.blog.front.master')
@section('content')

    <!-- Section Title -->
    <div class="section-title text-center">
        <h2 >Featured Post</h2>
    </div>
    <!-- Section Title -->

    <div class="row">
        <div class="col-lg-6 order-lg-2">
            <!-- Post -->
            <div class="post-default post-has-bg-img">
                <div class="post-thumb">
                    <a href="blog-details.html">
                        <div data-bg-img="{{ asset($featured_posts[0]->file) }}"></div>
                    </a>
                </div>
                <div class="post-data">
                    <!-- Category -->
                    <div class="cats"><a href="#">{{ $featured_posts[0]->category->name }}</a></div>
                    <!-- Title -->
                    <div class="title">
                        <h2><a href="{{ route('blog.details',$featured_posts[0]->id) }}">{{ $featured_posts[0]->title }}</a></h2>
                    </div>
                    <!-- Post Meta -->
                    <ul class="nav meta align-items-center">
                        <li class="meta-author">
                            <img src="{{ asset($featured_posts[0]->author->image) }}" alt="" class="img-fluid">
                            <a href="#">{{ $featured_posts[0]->author->name }}</a>
                        </li>
                        <li class="meta-date"><a href="#">{{ date('d M Y',strtotime($featured_posts[0]->published_at)) }}</a></li>
                        <li class="meta-comments"><a href="#"><i class="fa fa-eye"></i> {{ $featured_posts[0]->total_view }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- End of Post -->
        </div>
        <div class="col-lg-6 order-lg-1">
            @foreach($featured_posts as $index=>$post)
                <!-- Post -->
                @if($index != 0)
                    <div class="post-default post-has-no-thumb">
                        <div class="post-data">
                            <!-- Category -->
                            <div class="cats"><a href="#">{{ $post->category->name }}</a></div>
                            <!-- Title -->
                            <div class="title">
                                <h2><a href="{{ route('blog.details',$post->id) }}">{{ $post->title }}</a></h2>
                            </div>
                            <!-- Post Meta -->
                            <ul class="nav meta align-items-center">
                                <li class="meta-author">
                                    <img src="{{ asset($post->author->image) }}" alt="" class="img-fluid">
                                    <a href="#">{{ $post->author->name }}</a>
                                </li>
                                <li class="meta-date"><a href="#">{{ date('d M Y',strtotime($post->published_at)) }}</a></li>
                                <li class="meta-comments"><a href="#"><i class="fa fa-eye"></i> {{ $post->total_view }}</a></li>
                            </ul>
                            <!-- Post Desc -->
                            <div class="desc">
                                {{ str_limit($post->details,100) }}
                            </div>
                        </div>
                    </div>
                @endif
                    <!-- End of Post -->
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <!-- Popular Post -->
            <section class="popular-post pb-10">
                <!-- Section title -->
                <div class="section-title">
                    <h2>Recent Posts</h2>
                </div>
                <!-- End of Section title -->

                <div class="post-blog-list">
                    @foreach($recent_posts as $post)
                        <!-- Post -->
                            <div class="post-default post-has-right-thumb">
                                <div class="d-flex flex-wrap">
                                    <div class="post-thumb align-self-stretch order-md-2">
                                        <a href="blog-details.html">
                                            <div data-bg-img="{{ asset($post->file) }}"></div>
                                        </a>
                                    </div>
                                    <div class="post-data order-md-1">
                                        <!-- Category -->
                                        <div class="cats"><a href="#">{{ $post->category->name }}</a></div>
                                        <!-- Title -->
                                        <div class="title">
                                            <h2><a href="{{ route('blog.details',$post->id) }}">{{ $post->title }}</a></h2>
                                        </div>
                                        <!-- Post Meta -->
                                        <ul class="nav meta align-items-center">
                                            <li class="meta-author">
                                                <img src="{{ asset($post->author->image) }}" alt="" class="img-fluid">
                                                <a href="#">{{ $post->author->name }}</a>
                                            </li>
                                            <li class="meta-date"><a href="#">{{ $post->published_at }}</a></li>
                                            <li class="meta-comments"><a href="#"><i class="fa fa-eye"></i> {{ $post->total_view }}</a></li>
                                        </ul>
                                        <!-- Post Desc -->
                                        <div class="desc">
                                            <p>
                                                {{ str_limit($post->details,100) }}
                                            </p>
                                        </div>
                                        <!-- Read More Button -->
                                        <a href="{{ route('blog.details',$post->id) }}" class="btn btn-primary">View More</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Post -->
                    @endforeach

                </div>
            </section>
            <!-- End of Popular Post  -->

            <!-- Most Viewed Post -->
            <section class="pt-40 pb-10 most-viewed">
                <!-- Section title -->
                <div class="section-title">
                    <h2>Most Viewed</h2>
                </div>
                <!-- End of Section title -->
                <div class="post-blog-list">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Post -->
                            <div class="post-default post-has-front-title">
                                <div class="post-thumb">
                                    <a href="{{ route('blog.details',$most_viewed_posts[0]->id) }}"> <img src="{{ asset($most_viewed_posts[0]->file) }}" alt="" class="img-fluid"> </a>
                                </div>
                                <div class="post-data">
                                    <!-- Category -->
                                    <div class="cats"><a href="#">{{ $most_viewed_posts[0]->category->name }}</a></div>
                                    <!-- Title -->
                                    <div class="title">
                                        <h2><a href="{{ route('blog.details',$most_viewed_posts[0]->id) }}">{{ $most_viewed_posts[0]->title }}</a></h2>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Post -->
                        </div>
                        @foreach($most_viewed_posts as $index=>$post)
                            @if($index != 0)

                                <div class="col-sm-6">
                                    <!-- Post -->
                                    <div class="post-default">
                                        <div class="post-thumb">
                                            <a href="{{ route('blog.details',$post->id) }}">
                                                <img src="{{ ($post->file!=null)?asset($post->file):'theme-front/images/blog/1.jpg' }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="post-data">
                                            <!-- Category -->
                                            <div class="cats"><a href="#">{{ $post->category->name }}</a></div>
                                            <!-- Title -->
                                            <div class="title">
                                                <h2><a href="{{ route('blog.details',$post->id) }}">{{ $post->title }}</a></h2>
                                            </div>
                                            <!-- Post Desc -->
                                            <div class="desc">
                                                {{ str_limit($post->details,100) }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Post -->
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </section>
            <!-- End of Most Viewed Post -->

        </div>
        <div class="col-lg-4">
        <div class="pt-88">
            <div class="my-sidebar">
                <!-- Author Widget -->
                <div class="widget widget-about">
                    <!-- Widget Content -->
                    <div class="widget-content">
                        <!-- Author Image -->
                        <div class="author-image">
                            <img src="{{ asset('theme-front/images/blog/author.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <!-- Author Name -->
                        <div class="author-name text-center">
                            <a href="#"> Alex Garry </a>
                        </div>
                        <!-- Author Social Links -->
                        <div class="author-social text-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                        <!-- Author Text -->
                        <div class="author-text text-center">
                            In consequat, quam id sodales hendrerit, eros mi molestie leo, nec lacinia risus neque tristique augue. Proin tempus urna vel.
                        </div>
                    </div>
                    <!-- End of Widget Content -->
                </div>
                <!-- End of Author Widget -->

                <!-- Featured Posts -->
                <div class="widget widget-featured-post">
                    <!-- Widget Title -->
                    <h4 class="widget-title">
                        Featured Post
                    </h4>
                    <!-- End of Widget Title -->

                    <!-- Widget Content -->
                    <div class="widget-content">
                        @include('front.front.blog._right_featured')
                    </div>
                    <!-- End of Widget Content -->
                </div>
                <!-- End of Featured Posts -->

                <!-- Recent Post Widget -->
                <div class="widget widget-recent-post">
                    <!-- Widget Title -->
                    <h4 class="widget-title">
                        Recent Post
                    </h4>
                    <!-- End of Widget Title -->

                    <!-- Widget Content -->
                    <div class="widget-content">
                        @include('front.front.blog._right_recent')
                    </div>
                    <!-- End of Widget Content -->
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection