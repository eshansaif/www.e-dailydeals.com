@extends('layouts.backend._master')
@section('content')


    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <header class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <a class="btn btn-primary" href="{{ route('post.create') }}">Add New <i class="fa fa-plus"></i></a>
                        <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                     </span>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">

                                <div class="btn-group pull-right">

                                    <form class="btn-group" >

                                            <select name="status" id="" class="">
                                                <option  value="">Select status</option>
                                                <option @if(request()->status == 'Active') selected @endif  value="Active">Active</option>
                                                <option @if(request()->status == 'Inactive') selected @endif value="Inactive">Incative</option>
                                            </select>

                                            <input type="text" placeholder="Search.." name="search" value="{{ request()->search }}">
                                            <button type="submit"><i class="fa fa-search"></i></button>


                                    </form>

                                </div>

                                <div class="btn-group pull-left">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)

                                <tr class="">
                                    <td>{{ $serial++ }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    {{--<td width="50%" >{{ $brand->details }}</td>--}}
                                    <td><span class="label {{ ($post->status == 'active')?'label-info':'label-danger'}}">{{ ucfirst($post->status) }}</span></td>
                                    <td><img style="height: 100px; width: 100px" src="{{ asset($post->file) }}" alt=""></td>
                                    <td>
                                        @if($post->deleted_at == null)

                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form action="{{ route('post.destroy', $post->id) }}" method="post" style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to delete this post')">Delete</button>
                                        </form>
                                        @else
                                        <form action="{{ route('post.restore', $post->id) }}" method="post" style="display: inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('You are going to restore this post')">Restore</button>
                                        </form>

                                            <form action="{{ route('post.permanent_delete', $post->id) }}" method="post" style="display: inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to permanently delete this post')">Permanent Delete</button>
                                            </form>
                                            @endif
                                    </td>


                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{--{{ $brands->render() }}--}}
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->



@endsection