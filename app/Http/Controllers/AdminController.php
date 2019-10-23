<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $data['title'] = 'Admin List';
        $admin = new Admin();
        $admin = $admin->withTrashed();
        if ($request->has('search') && $request->search != null){
            $admin = $admin->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $admin = $admin->where('status',$request->status );
        }
        $admin = $admin->orderBy('id','DESC')->paginate(3);
        $data['admins'] = $admin;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $admin = $admin->appends($render);
        }

        $data['serial'] = managePagination($admin);
        return view('admin.admin.index',$data);
    }

    public function create()
    {
        $data['title'] = 'Create new Admin';
        return view('admin.admin.create',$data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'email'=>'required|unique:admins|email',
            'password'=>'required|confirmed',
            'status'=>'required',
        ]);
        $admin = $request->except('_token','password');
        $admin['password'] = md5($request->password);

        /*if($request->hasFile('image')){
            $file = $request->file('image');
            $file->move('images/admins/',$file->getClientOriginalName());
            $admin['image'] = 'images/admins/'.$file->getClientOriginalName();
        }*/
        Admin::create($admin);
        session()->flash('message', 'Admin is Created Successfully!');
        return redirect()->route('admin.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['title']="Edit Admin";
        $data['admin']= Admin::findOrFail($id);
        return view('admin.admin.edit',$data);
    }


    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'email'=>'sometimes|required|email|unique:admins,email,'.$admin->id,
            'status'=>'required',
            'password'=>'confirmed',
        ]);
        $admin_req= $request->except('_token','password');
        if($request->has('password'))
        {
            $admin_req['password'] = md5($request->password);
        }
        /*if($request->hasFile('image')){
            $file = $request->file('image');
            $file->move('images/admins/',$file->getClientOriginalName());
            File::delete($admin->image);
            $admin_req['image'] = 'images/admins/'.$file->getClientOriginalName();
        }*/

        $admin->update($admin_req);
        session()->flash('message','Admin updated successfully');
        return redirect()->route('admin.index');
    }


    public function destroy(Admin $admin)
    {
        $admin->delete();
        session()->flash('message','Admin is Deleted Successfully!');
        return redirect()->route('admin.index');
    }

    public function restore($id)
    {
        $admin = Admin::onlyTrashed()->findOrFail($id);
        $admin->restore();
        session()->flash('message','Admin is restored successfully!');
        return redirect()->route('admin.index');
    }



    public function permanent_delete($id)
    {
        $admin = Admin::onlyTrashed()->findOrFail($id);
        $admin->forceDelete();
        session()->flash('message','Admin is permanently deleted!');
        return redirect()->route('admin.index');
    }
}
