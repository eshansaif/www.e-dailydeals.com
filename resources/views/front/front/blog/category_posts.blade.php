@extends('layouts.frontend.blog.front.master')
@section('content')

    <div class="row">
        <div class="col-lg-8">
            <!-- Popular Post -->
            <section class="popular-post pb-10">
                <!-- Section title -->
                <div class="section-title">
                    <h2>Category - {{ $category->name }}</h2>
                </div>
                <!-- End of Section title -->

                <div class="post-blog-list">
                    @foreach($posts as $post)
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
                                                <img src="{{ asset($post->user->image) }}" alt="" class="img-fluid">
                                                <a href="#">{{ $post->user->name }}</a>
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
                {{ $posts->render() }}
            </section>
            <!-- End of Popular Post  -->


        </div>
        <div class="col-lg-4">
            <div class="pt-88">
                <div class="my-sidebar">
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
                            @include('front/front.blog._right_recent')
                        </div>
                        <!-- End of Widget Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection