<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function contactUs(Request $request)
    {
        $data['title'] = 'Contact Us';
        if ($request->isMethod('post')){
            $data = $request->all();

            //send email to admin
            $email = "shanjeed.saif.eshan@gmail.com";
            $messageData = [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'phone'=>$data['phone'],
                'comment'=>$data['message']
            ];
            Mail::send('emails.page.enquiry',$messageData,function($message)use($email){
                $message->to($email)->subject('Enquiry from DailyDeals');
            });
            return redirect()->back()->with(session()->flash('message','Your Massage has been Sent Successfully!We will Contact You very soon!'));
        }
        return view('page.contact_us',$data);
    }
}
