<?php

namespace App\Http\Controllers\Front;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function view_register()
    {
        $data['title'] = 'New Customer Registration';
        return view('front.customer.register', $data);

    }
    public function register(Request $request)
    {


        if ($request->isMethod('post')){
            $data = $request->all();
            ///dd($data);
            $userCount = User::where('email',$data['email'])->count();
            if ($userCount > 0){
                return redirect()->back()->with(session()->flash('error_message','This Email already exists'));
            }else{
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->phone = $data['phone'];
                /*date_default_timezone_set('Asia/Kolkata');
                $user->created_at = date("Y-m-d H:i:s");
                $user->updated_at = date("Y-m-d H:i:s");*/
                $user->save();
                if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    return redirect('cart');
                }
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
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
