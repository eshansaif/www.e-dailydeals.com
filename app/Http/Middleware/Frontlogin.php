<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;


class Frontlogin
{

    public function handle($request, Closure $next)
    {
        //echo Session::get('frontSession'); die;
        if(empty(Session::has('frontSession'))){
            return redirect('login');
        }
        return $next($request);
    }
}
