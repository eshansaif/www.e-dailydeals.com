@extends('layouts.frontend.blog.front.master')
@section('content')

    <div class="row">
        <div class="col-lg-8 pb-80">
            <div class="post-details-cover">
                <!-- Post Thumbnail -->
                <div class="post-thumb-cover">
                    <div class="post-thumb">
                        <img src="{{ asset($blog_details->file) }}" alt="" class="img-fluid">
                    </div>
                    <!-- Post Meta Info -->
                    <div class="post-meta-info">
                        <!-- Category -->
                        <p class="cats">
                            <a href="#">{{ $blog_details->category->name }}</a>
                        </p>

                        <!-- Title -->
                        <div class="title">
                            <h2>{{ $blog_details->title }}</h2>
                        </div>

                        <!-- Meta -->
                        <ul class="nav meta align-items-center">
                            <li class="meta-author">
                                <img src="assets/images/blog/author.jpg" alt="" class="img-fluid">
                                <a href="#">{{ $blog_details->user->name }}</a>
                            </li>
                            <li class="meta-date"><a href="#">{{ date('d M Y',strtotime($blog_details->published_at)) }}</a></li>
{{--                            <li> 2 min read </li>--}}
{{--                            <li class="meta-comments"><a href="#"><i class="fa fa-comment"></i> 2</a></li>--}}
                        </ul>
                    </div>
                    <!-- End of Post Meta Info -->
                </div>
                <!-- End oF Post Thumbnail -->

                <!-- Post Content -->
                <div class="post-content-cover my-drop-cap">
                    {{ $blog_details->details }}
                </div>
                <!-- End of Post Content -->

                <!-- Author Box -->
                <div class="post-about-author-box">
                    <div class="author-avatar">
                        <img src="{{ asset($blog_details->user->image) }}" alt="" class="img-fluid">
                    </div>
                    <div class="author-desc">
                        <h5> <a href="#"> {{ $blog_details->user->name }} </a> </h5>
                        <div class="description">
                            {{ $blog_details->user->details }}
                        </div>
                    </div>
                </div>
                <!-- End of Author Box -->
            </div>
        </div>
        <div class="col-lg-4 pb-90">
            <div class="my-sidebar">
                <!-- Author Widget -->
                <div class="widget widget-about">
                    <!-- Widget Content -->
                    <div class="widget-content">
                        <!-- Author Image -->
                        <div class="author-image">
                            <img src="{{ asset($blog_details->user->image) }}" alt="" class="img-fluid">
                        </div>
                        <!-- Author Name -->
                        <div class="author-name text-center">
                            <a href="#">{{ $blog_details->user->name }}</a>
                        </div>

                        <div class="author-text text-center">
                            {{ $blog_details->user->details }}
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
                        <!-- Single Post -->
                        @include('front.front.blog._right_recent')
                    </div>
                    <!-- End of Widget Content -->
                </div>
                <!-- End of Recent Post Widget -->

            </div>
        </div>
    </div>
@endsection