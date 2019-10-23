@extends('layouts.backend._master')
@section('content')


    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <header class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{--<a class="btn btn-primary" href="{{ route('admin.create') }}">Add New <i class="fa fa-plus"></i></a>--}}
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
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Country</th>
                                    <th>Zip COde</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Registered on</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $customer)

                                <tr class="">
                                    <td>{{ $serial++ }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->city }}</td>
                                    <td>{{ $customer->district }}</td>
                                    <td>{{ $customer->country }}</td>
                                    <td>{{ $customer->zip }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td><span class="label {{ ($customer->status == 'Active')?'label-info':'label-danger'}}">{{ $customer->status }}</span></td>
                                    <td>{{ $customer->created_at }}</td>
                                    {{--<td>

                                        @if($admin->deleted_at == null)
                                         <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-sm btn-info">Edit</a>
                                       <form action="{{ route('admin.destroy', $admin->id) }}" method="post" style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to delete this admin')">Delete</button>
                                        </form>
                                        @else
                                        <form action="{{ route('admin.restore', $admin->id) }}" method="post" style="display: inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('You are going to restore this admin')">Restore</button>
                                        </form>

                                            <form action="{{ route('admin.permanent_delete', $admin->id) }}" method="post" style="display: inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to permanently delete this admin')">Permanent Delete</button>
                                            </form>
                                            @endif
                                    </td>
--}}

                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $users->render() }}
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->



@endsection