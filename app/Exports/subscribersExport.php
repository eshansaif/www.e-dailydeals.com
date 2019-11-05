<?php

namespace App\Exports;

use App\NewsletterSubscriber;
use Maatwebsite\Excel\Concerns\FromCollection;

class subscribersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $subscriberData = NewsletterSubscriber::select('id','email','created_at')->where('status','Active')->orderBy('id','DESC')->get();
        return $subscriberData;

        //or
        //return NewsletterSubscriber::all();
    }
}
