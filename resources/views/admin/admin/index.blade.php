@extends('layouts.backend._master')
@section('content')


    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <header class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <a class="btn btn-primary" href="{{ route('admin.create') }}">Add New <i class="fa fa-plus"></i></a>
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
                                    <th>Access</th>
                                    <th>Phone</th>
                                    <th>Admin Type</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $admin)
                                    <?php
                                        if($admin->type == "Admin"){
                                            $access = "All";
                                        }
                                        else{

                                            $access = "";
                                            if ($admin->categories_access == 1){
                                                $access .= "Categories,";
                                            }
                                            if ($admin->products_access == 1){
                                                $access .= "Products,";
                                            }
                                            if ($admin->orders_access == 1){
                                                $access .= "Orders,";
                                            }
                                            if ($admin->users_access == 1){
                                                $access .= "Users";
                                            }
                                        }
                                 ?>
                                <tr class="">
                                    <td>{{ $serial++ }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td><span class="label {{ ($admin->type == 'Admin')?'label-primary':'label-default'}}">{{ $admin->type }}</span></td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $access }}</td>
                                    <td><span class="label {{ ($admin->status == 'Active')?'label-info':'label-danger'}}">{{ $admin->status }}</span></td>
                                    <td>
                                        @if($admin->type == 'Admin')
                                            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-sm btn-info">Edit</a>
                                         @else

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
                                        @endif

                                    </td>


                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $admins->render() }}
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->



@endsection