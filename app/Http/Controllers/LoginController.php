<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login_form(){
        $data['title'] = 'Login';
        return view('admin.authentication.login.login', $data);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /*$credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        }*/

            $credentials = $request->input();
            $adminCount = Admin::where(['email' => $credentials['email'], 'password' => md5($credentials['password']),'status' => 'Active'])->count();
            if ($adminCount > 0){
                Session::put('adminSession', $credentials['email']);
                return redirect()->intended('admin/dashboard');
            }else{
                /*if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'],'admin' => '1'])){

            }*/
                Session::flash('message','Invalid Email or Password');
                return redirect()->back()->withInput(['email'=>$request->email]);

            }


    }

    public function logout(){
        Session::flush();
        return redirect()->route('admin.login')->with('message', 'Logged out successfully!');

    }
}
