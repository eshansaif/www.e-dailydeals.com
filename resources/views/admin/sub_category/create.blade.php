@extends('layouts.backend._master')

@section('content')
    <section class="wrapper">
        <!-- page start-->

        <div class="wrapper">
            <div class="row">
                <div class="col-lg-8 col-md-offset-2">
                    <section class="panel">
                        <header class="panel-heading">
                            Create New Category
                        </header>
                        <div class="panel-body">

                            <form action="{{ route('sub_category.store') }}" method="post" class="form-horizontal">
                                @include('admin.sub_category._form')


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10 text-right">
                                        <button name="" type="submit" class="btn btn-primary">Create Sub-Category</button>
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