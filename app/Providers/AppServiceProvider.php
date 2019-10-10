<?php

namespace App\Providers;

use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('layouts/frontend/_header_bottom',function ($view){
            $view->with('categories',Category::where('status','Active')->orderBy('name','ASC')->pluck('name','id'));
        });

        view()->composer('layouts/frontend/_header_top',function ($view){
            $view->with('userDetails', User::find(Auth::user()->id));
        });
    }
}
