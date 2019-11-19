@extends('layouts.backend._master')

@section('content')
    <section class="wrapper">
        <!-- page start-->

        <div class="wrapper">
            <div class="row">
                <div class="col-lg-8 col-md-offset-2">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Brand
                        </header>
                        <div class="panel-body">

                            <form action="{{ route('post.update', $post->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                @include('admin.post._form')
                                @method('put')

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10 text-right">
                                        <button name="" type="submit" class="btn btn-primary">Update Brand</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>

                </div>
            </div>
        </div>


    </section>


@endsection