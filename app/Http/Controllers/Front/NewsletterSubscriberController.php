<?php

namespace App\Http\Controllers\Front;

use App\NewsletterSubscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $subscriber = $subscriber->withTrashed();
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

    public function edit(NewsletterSubscriber $newsletterSubscriber)
    {
        $data['title'] = 'Edit Newsletter';
        $data['subscriber'] = $newsletterSubscriber;
        return view('admin.newsletter.edit',$data);
    }


    public function update(Request $request, NewsletterSubscriber $newsletterSubscriber)
    {
        $request->validate([
            'status'=>'required',
        ]);

        $subscriber_data = $request->except('_token','_method');
        $subscriber_data['updated_by'] = 1;
        $newsletterSubscriber->update($subscriber_data);
        session()->flash('message','Newsletter is updated successfully!');
        return redirect()->route('subscriber.index');
    }

    public function destroy(NewsletterSubscriber $newsletterSubscriber)
    {
        $newsletterSubscriber->delete();
        session()->flash('message','Newsletter is deleted successfully');
        return redirect()->route('subscriber.index');
    }

    public function restore($id)
    {
        $newsletterSubscriber = NewsletterSubscriber::onlyTrashed()->findOrFail($id);
        $newsletterSubscriber->restore();
        session()->flash('message','Newsletter is restored successfully');
        return redirect()->route('subscriber.index');
    }



    public function permanent_delete($id)
    {
        $newsletterSubscriber = NewsletterSubscriber::onlyTrashed()->findOrFail($id);
        $newsletterSubscriber->forceDelete();
        session()->flash('error_message','Newsletter has been permanently deleted!');
        return redirect()->route('subscriber.index');
    }

}
