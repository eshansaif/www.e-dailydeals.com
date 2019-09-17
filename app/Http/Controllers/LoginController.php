<?php

namespace App\Http\Controllers;

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

        $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        }

         Session::flash('message','Invalid Email or Password');
        return redirect()->back()->withInput(['email'=>$request->email]);

    }
}
