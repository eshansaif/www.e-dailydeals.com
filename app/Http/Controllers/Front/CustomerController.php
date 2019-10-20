<?php

namespace App\Http\Controllers\Front;

//use App\Country;
use App\Country;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class CustomerController extends Controller
{
    public function view_register()
    {
        $data['title'] = 'New Customer Registration';
        return view('front.customer.register', $data);

    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
        ]);


        if ($request->isMethod('post')){
            $data = $request->all();
            ///dd($data);
            $userCount = User::where('email',$data['email'])->count();
            if ($userCount > 0){
                return redirect()->back()->with(session()->flash('error_message','This Email already exists!'));
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
                    Session::put('frontSession',$data['email']);

                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                    }

                    return redirect('cart');
                }
            }
        }
    }

    public function view_login()
    {

        $data['title'] = 'Customer Login';
        return view('front.customer.login', $data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /*$credentials = $request->only('email', 'password');
         if (Auth::attempt([$credentials, 'admin' => 'null'])) {
             Session::put('frontSession',$credentials['email']);
            return redirect()->intended('/');
        }*/

        $credentials = $request->input();
        //dd($credentials);
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'],'admin' => null])){
            Session::put('frontSession',$credentials['email']);

            if(!empty(Session::get('session_id'))){
                $session_id = Session::get('session_id');
                DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $credentials['email']]);
            }
            return redirect()->intended('cart');
        }

        Session::flash('error_message', 'Invalid Email or Password!');
        return redirect()->back()->withInput(['email' => $request->email]);
    }

    public function account(Request $request){

        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        //$userDetails = User::find(Auth::user()->id);
        //dd($userDetails->name);
        $countries = Country::get();

        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            /*echo "<pre>"; print_r($data); die;*/

            if(empty($data['name'])){
                return redirect()->back()->with('message','Please enter your Name to update your account details!');
            }

            if(empty($data['address'])){
                $data['address'] = '';
            }

            if(empty($data['zip'])){
                $data['zip'] = '';
            }

            if(empty($data['city'])){
                $data['city'] = '';
            }

            if(empty($data['district'])){
                $data['district'] = '';
            }

            if(empty($data['country'])){
                $data['country'] = '';
            }

            if(empty($data['phone'])){
                $data['phone'] = '';
            }

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->zip = $data['zip'];
            $user->city = $data['city'];
            $user->district = $data['district'];
            $user->country = $data['country'];
            $user->phone = $data['phone'];
            $user->save();
            return redirect()->back()->with(session()->flash('message','Your Account details updated Successfully!'));
        }

        return view('front.customer.account')->with(compact('countries','userDetails'));
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                // Update password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with(session()->flash('message','Your Password is updated successfully!'));
            }else{
                return redirect()->back()->with(session()->flash('error_message','Current password is Incorrect!'));
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('frontSession');
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
