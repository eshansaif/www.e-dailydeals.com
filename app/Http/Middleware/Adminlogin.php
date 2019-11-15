<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

class Adminlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(Session::has('adminSession'))){
            return redirect('admin/login');
        }else{
            $admin_details = Admin::where('email',Session::get('adminSession'))->first();
            if ($admin_details['type'] == "Admin"){
                $admin_details['categories_access'] = 1;
                $admin_details['products_access'] = 1;
                $admin_details['orders_access'] = 1;
                $admin_details['users_access'] = 1;
            }
            Session::put('adminDetails',$admin_details);


            //dd(Session::get('adminDetails'));
            $currentPath= Route::getFacadeRoot()->current()->uri();
            if ($currentPath=="admin/category" && Session::get('adminDetails')['categories_access']==0){
                return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
            }

            if ($currentPath=="admin/category/create" && Session::get('adminDetails')['categories_access']==0){
                return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
            }

            if ($currentPath=="admin/product" && Session::get('adminDetails')['products_access']==0){
                return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
            }

            if ($currentPath=="admin/product/create" && Session::get('adminDetails')['products_access']==0){
                return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
            }

            //dd($currentPath);
    }
        return $next($request);
    }
}
