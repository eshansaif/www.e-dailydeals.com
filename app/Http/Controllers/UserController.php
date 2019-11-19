<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'User List';
        $user = new User();
        $user = $user->withTrashed();
        if ($request->has('search') && $request->search != null){
            $user = $user->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $user = $user->where('status',$request->status );
        }
        $user = $user->orderBy('id','DESC')->paginate(3);
        $data['categories'] = $user;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $user = $user->appends($render);
        }

        $data['serial'] = managePagination($user);
        return view('admin.admin.index',$data);
    }

    public function create()
    {
        $data['title'] = 'Create new User';
        return view('admin.admin.create',$data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required|confirmed',
            'status'=>'required',
        ]);
        $user = $request->except('_token','password');
        $user['password'] = bcrypt($request->password);

        /*if($request->hasFile('image')){
            $file = $request->file('image');
            $file->move('images/users/',$file->getClientOriginalName());
            $admin['image'] = 'images/users/'.$file->getClientOriginalName();
        }*/
        User::create($user);
        session()->flash('message', 'User is Created Successfully!');
        return redirect()->route('admin.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['title']="Edit User";
        $data['admin']= User::findOrFail($id);
        return view('admin.admin.edit',$data);
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'email'=>'sometimes|required|email|unique:users,email,'.$user->id,
            'status'=>'required',
            'password'=>'confirmed',
        ]);
        $user_req= $request->except('_token','password');
        if($request->has('password'))
        {
            $user_req['password'] = bcrypt($request->password);
        }
        /*if($request->hasFile('image')){
            $file = $request->file('image');
            $file->move('images/users/',$file->getClientOriginalName());
            File::delete($admin->image);
            $user_req['image'] = 'images/users/'.$file->getClientOriginalName();
        }*/

        $user->update($user_req);
        session()->flash('message','User updated successfully');
        return redirect()->route('admin.index');
    }

    
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message','User is Deleted Successfully!');
        return redirect()->route('admin.index');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        session()->flash('message','User is restored successfully!');
        return redirect()->route('admin.index');
    }



    public function permanent_delete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        session()->flash('message','User is permanently deleted!');
        return redirect()->route('admin.index');
    }


    public function viewCustomers(Request $request)
    {
        $data['title'] = 'Customer List';
        $user = new User();
        $user = $user->withTrashed();
        if ($request->has('search') && $request->search != null){
            $user = $user->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $user = $user->where('status',$request->status );
        }
        $user = $user->where(['admin' => null])->orderBy('id','DESC')->paginate(5);
        $data['users'] = $user;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $user = $user->appends($render);
        }

        $data['serial'] = managePagination($user);
        return view('admin.customer.customer_view',$data);
    }

    /*public function viewCustomersChart()
    {
        return view('')
    }*/


}
