<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
        $admin = $admin->orderBy('id','DESC')->paginate(5);
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
        //$admin = $request->except('_token','password');
        //$admin['password'] = md5($request->password);
        //dd($admin);

        /*if($request->hasFile('image')){
            $file = $request->file('image');
            $file->move('images/admins/',$file->getClientOriginalName());
            $admin['image'] = 'images/admins/'.$file->getClientOriginalName();
        }*/

        $data = $request->except('_token','password');
        $data['password'] = md5($request->password);
        if ($data['type'] == "Admin"){
            $admin = new Admin();
            $admin->type = $data['type'];
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->phone = $data['phone'];
            $admin->password = $data['password_confirmation'];
            $admin->status = $data['status'];
            $admin->save();
            session()->flash('message', 'Admin is Created Successfully!');
        }elseif ($data['type'] == "Operator"){
            if (empty($data['categories_access'])){
                $data['categories_access'] = 0;
            }
            if (empty($data['products_access'])){
                $data['products_access'] = 0;
            }
            if (empty($data['orders_access'])){
                $data['orders_access'] = 0;
            }
            if (empty($data['users_access'])){
                $data['users_access'] = 0;
            }
            $admin = new Admin();
            $admin->type = $data['type'];
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->phone = $data['phone'];
            $admin->password = $data['password_confirmation'];
            $admin->status = $data['status'];
            $admin->categories_access = $data['categories_access'];
            $admin->products_access = $data['products_access'];
            $admin->orders_access = $data['orders_access'];
            $admin->users_access = $data['users_access'];
            $admin->save();
            session()->flash('message', 'operator is Created Successfully!');
        }

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
        //dd($data['admin']);
        return view('admin.admin.edit',$data);
    }




    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'email'=>'sometimes|required|email|unique:admins,email,'.$admin->id,
            'status'=>'required',
            'password'=>'required|confirmed',
        ]);
        //$admin_req= $request->except('_token','password');
        $admin_req = $request->except('_token');
        /*if($request->has('password'))
        {
            $admin_req['password'] = md5($request->password);

        }*/


        //dd($admin_req);
        /*if($request->hasFile('image')){
            $file = $request->file('image');
            $file->move('images/admins/',$file->getClientOriginalName());
            File::delete($admin->image);
            $admin_req['image'] = 'images/admins/'.$file->getClientOriginalName();
        }*/



        if ($admin_req['type'] == "Admin"){

            Admin::where('email',$admin_req['email'])->update([
               'name'=> $admin_req['name'],
               'password'=> md5($admin_req['password']),
               'phone'=> $admin_req['phone'],
               'status'=> $admin_req['status']
            ]);
            session()->flash('message', 'Admin is Updated Successfully!');
        }elseif ($admin_req['type'] == "Operator"){
            if (empty($admin_req['categories_access'])){
                $admin_req['categories_access'] = 0;
            }
            if (empty($admin_req['products_access'])){
                $admin_req['products_access'] = 0;
            }
            if (empty($admin_req['orders_access'])){
                $admin_req['orders_access'] = 0;
            }
            if (empty($admin_req['users_access'])){
                $admin_req['users_access'] = 0;
            }
            Admin::where('email',$admin_req['email'])->update([
                'name'=> $admin_req['name'],
                'password'=> md5($admin_req['password']),
                'phone'=> $admin_req['phone'],
                'status'=> $admin_req['status'],
                'categories_access'=> $admin_req['categories_access'],
                'products_access'=> $admin_req['products_access'],
                'orders_access'=> $admin_req['orders_access'],
                'users_access'=> $admin_req['users_access'],
            ]);
            session()->flash('message', 'Operator is Updated Successfully!');
        }

        //$admin->update($admin_req);
        //dd($admin);
        //session()->flash('message','Admin updated successfully');
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
