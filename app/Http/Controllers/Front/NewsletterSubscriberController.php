<?php

namespace App\Http\Controllers\Front;

use App\NewsletterSubscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class NewsletterSubscriberController extends Controller
{
    public function checkSubscriber(Request $request)
    {
        if ($request->ajax()){
            $data = $request->all();
            $subscriberCount = NewsletterSubscriber::where('email',$data['subscriber_email'])->count();
            if ($subscriberCount>0){
                echo "exists";
            }

        }

    }

    public function addSubscriber(Request $request)
    {
        if ($request->ajax()){
            $data = $request->all();
            $subscriberCount = NewsletterSubscriber::where('email',$data['subscriber_email'])->count();
            if ($subscriberCount>0){
                echo "exists";
            }else{
                //add email in table
                $newsletter = new NewsletterSubscriber();
                $newsletter->email = $data['subscriber_email'];
                $newsletter->status = 'Active';
                $newsletter->save();
                echo "saved";
            }

        }

    }

    public function index(Request $request)
    {

        $data['title'] = 'Subscriber List';
        $subscriber = new NewsletterSubscriber();
        //$subscriber = $subscriber->withTrashed();
        if ($request->has('search') && $request->search != null){
            $subscriber = $subscriber->where('email','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $subscriber = $subscriber->where('status',$request->status );
        }
        $subscriber = $subscriber->orderBy('id','DESC')->paginate(3);
        $data['subscribers'] = $subscriber;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $subscriber = $subscriber->appends($render);
        }

        $data['serial'] = managePagination($subscriber);
        return view('admin.newsletter.index',$data);


    }


    public function updateStatus($id,$status)
    {
        NewsletterSubscriber::where('id',$id)->update(['status'=>$status]);
        return redirect()->back()->with(session()->flash('message','Newsletter Status is updated Successfully!'));

    }

    public function deleteSubscriber($id)
    {
        $subscriber = new NewsletterSubscriber();
        $subscriber = $subscriber->where('id',$id)->delete();
        return redirect()->back()->with(session()->flash('message','Newsletter email has been deleted successfully!'));
    }


    public function exportSubscribers()
    {
        $subscriberData = NewsletterSubscriber::select('id','email','created_at')->where('status','Active')->orderBy('id','DESC')->get();
        $subscriberData = json_decode(json_encode($subscriberData),true);
        //dd($subscriberData);

        return Excel::create('subscribers'.rand(),function ($excel) use($subscriberData){
            $excel->sheet('mySheet',function ($sheet) use($subscriberData){
                $sheet->fromArray($subscriberData);
            });
        })->download('xlsx');
    }



}
