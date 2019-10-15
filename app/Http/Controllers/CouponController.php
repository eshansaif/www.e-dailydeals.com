<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index(Request $request)
    {
        $data['title'] = 'Coupon List';
        $coupon = new Coupon();
        $coupon = $coupon->withTrashed();
        if ($request->has('search') && $request->search != null){
            $coupon = $coupon->where('coupon_code','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $coupon = $coupon->where('status',$request->status );
        }
        $coupon = $coupon->orderBy('id','DESC')->paginate(3);
        $data['coupons'] = $coupon;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $coupon = $coupon->appends($render);
        }

        $data['serial'] = managePagination($coupon);
        return view('admin.coupon.index',$data);
    }


    public function create()
    {
        $data['title'] = 'Create new Coupon';
        return view('admin.coupon.create',$data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required',
            'amount' => 'required',
            'amount_type' => 'required',
            'expiry_date' => 'required',
            'status' => 'required',
        ]);

        $coupon= $request->except('_token');

        //dd($coupon);
        $coupon['created_by'] = 1;
        Coupon::create($coupon);
        session()->flash('message','Coupon Code is created successfully!');


        return redirect()->route('coupon.index');
    }


    public function show(Coupon $coupon)
    {

    }

    public function edit(Coupon $coupon)
    {
        $data['title'] = 'Edit Coupon';
        $data['coupon'] = $coupon;
        return view('admin.coupon.edit',$data);
    }


    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'coupon_code' => 'required',
            'amount' => 'required',
            'amount_type' => 'required',
            'expiry_date' => 'required',
            'status' => 'required',
        ]);

        $coupon_data= $request->except('_token','_method');
        $coupon_data['updated_by'] = 1;
        $coupon->update($coupon_data);
        session()->flash('message','Category is updated successfully!');
        return redirect()->route('coupon.index');
    }

    
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        session()->flash('error_message','Coupon is deleted successfully!');
        return redirect()->route('coupon.index');
    }

    public function restore($id)
    {
        $coupon = Coupon::onlyTrashed()->findOrFail($id);
        $coupon->restore();
        session()->flash('message','Coupon is restored successfully!');
        return redirect()->route('coupon.index');
    }



    public function permanent_delete($id)
    {
        $coupon = Coupon::onlyTrashed()->findOrFail($id);
        $coupon->forceDelete();
        session()->flash('error_message','Coupon is permanently deleted!');
        return redirect()->route('coupon.index');
    }
}
