<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //dd(Carbon::now()->day);
        $data['title'] = 'Dashboard';
        $data['total_customer'] = User::where('status','Active')->count();
        $data['total_craft_designer'] = Admin::where(['status'=>'Active','type'=>'Operator'])->count();

        $data['today_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->count();
        $data['new_orders']  = Order::where('order_status','New')->count();


        //orders reporting
        $data['current_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $data['last_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $data['before_last_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        $data['before_last_two_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(3))->count();
        $data['before_last_three_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(4))->count();
        $data['before_last_four_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(5))->count();

        $data['before_last_five_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(6))->count();

        $data['before_last_six_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(7))->count();

        $data['before_last_seven_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(8))->count();

        $data['before_last_eight_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(9))->count();

        $data['before_last_nine_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(10))->count();

        $data['before_last_ten_month_orders'] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(11))->count();




        //customer Line chart
        $data['current_month_customers'] = User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $data['last_month_customers'] = User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $data['before_last_month_customers'] = User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(2))->count();

        //dd($data['today_orders']);
        return view('admin.dashboard', $data);

    }


}
