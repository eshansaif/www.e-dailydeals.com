<?php

namespace App\Http\Controllers\Front;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function register(Request $request)
    {


        if ($request->isMethod('post')){
            $data = $request->all();
            ///dd($data);
            $userCount = User::where('email',$data['email'])->count();
            if ($userCount > 0){
                return redirect()->back()->with(session()->flash('error_message','This Email already exists'));
            }else{
                echo "Success"; die;
            }
        }
        return view('front.customer.register');
    }

    public function checkEmail(Request $request)
    {

        $data = $request->all();
        $userCount = User::where('email',$data['email'])->count();
        if ($userCount > 0){
            echo "false";
        }else{
            echo "true"; die;
        }

    }

}
