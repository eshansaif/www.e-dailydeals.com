@extends('layouts.backend._master')
@section('content')


    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <header class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <a class="btn btn-primary" href="{{--{{ route('subscriber.create') }}--}}">Add New <i class="fa fa-plus"></i></a>
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
                                        <li><a href="{{ route('newsletter.export') }}">Export to Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>(Change)Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subscribers as $subscriber)

                                    <tr class="">
                                        <td>{{ $serial++ }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>
                                            @if($subscriber->status == 'Active')
                                                <a href="{{ url('admin/update-newsletter-status/'.$subscriber->id.'/Inactive') }}"><span class="label label-info"> Active </span></a>
                                                @else
                                                <a href="{{ url('admin/update-newsletter-status/'.$subscriber->id.'/Active') }}"><span class="label label-danger"> Inactive </span></a>

                                                @endif
                                        </td>
                                       {{-- <td><span class="label {{ ($subscriber->status == 'Active')?'label-info':'label-danger'}}">{{ $subscriber->status }}</span></td>
                                       --}} <td>{{ $subscriber->created_at }}</td>
                                        <td><a class="btn btn-sm btn-danger" href="{{ url('admin/delete-newsletter-email/'.$subscriber->id.'') }}" >Delete</a></td>
                                        {{--<td>

                                            @if($subscriber->deleted_at == null)
                                                <a href="{{ route('subscriber.edit', $subscriber->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <form action="{{ route('subscriber.destroy', $subscriber->id) }}" method="post" style="display: inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to delete this subscriber')">Delete</button>
                                                </form>
                                            @else
                                                <form action="{{ route('subscriber.restore', $subscriber->id) }}" method="post" style="display: inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('You are going to restore this subscriber')">Restore</button>
                                                </form>

                                                <form action="{{ route('subscriber.permanent_delete', $subscriber->id) }}" method="post" style="display: inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to permanently delete this subscriber')">Permanent Delete</button>
                                                </form>
                                            @endif
                                        </td>--}}


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $subscribers->render() }}
                    </div>

                </section>
        </div>
    </div>
    </div>
    <!--body wrapper end-->



@endsection