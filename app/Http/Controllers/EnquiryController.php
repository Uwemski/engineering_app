<?php

namespace App\Http\Controllers;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Events\EnquiryCreated;
use Illuminate\Support\Facades\Log;


class EnquiryController extends Controller
{
    //index page
    public function index(){
        return view('client.contact-us');
    }

    //a function to create 
    public function store(Request $request) {
        //fire the function
        //dd("Fire");
        //validate
        $data = $request->validate([
            'name' => 'required|min:2|max:25',
            'email' => 'required',
            'message' => 'required'
        ]);

        //strip_tags
        foreach($data as $key => $val){
            $data[$key] = strip_tags($val);
        }

        //create
        $enquiry = Enquiry::create($data);

        //event
        event(new EnquiryCreated($enquiry));

        Log::info('=== ENQUIRY EVENT FIRED ===', [
    'name' => $enquiry->name,
    'email' => $enquiry->email,
    'subject' => $enquiry->message
]);


        //success message
        if($enquiry){
            return redirect()->back()->with('success', 'Message sent successfully');
        }else{
            return redirect()->back()->with('error', 'Error, please try again!');
        }
    }

}
