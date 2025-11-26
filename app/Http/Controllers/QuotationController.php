<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Events\QuotationCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuotationController extends Controller
{
    //method to view index
    public function index() {
        // dd('jddjujdj');
        return view('client.quotation');
    }

    public function store(Request $request) {

        $data = $request->validate([
            'subject' => 'required|min:5|max:50',
            'description' => 'required|min:5|max:200',
            'file' => 'mimes:jpg,png,pdf,jpeg,docx|max:10024',
            'quotation_price' => "required|numeric|min:0|max:99999999"
        ]);

        // dd($data);
        foreach($data as $d => $v ){
            $data[$d] = strip_tags($v);
        }
        // $data['subject'] = strip_tags($data['subject']);
        // $data['description'] = strip_tags($data['description']);
        // $data['quotation_price'] = strip_tags($data['quotation_price']);

        $data['user_id'] = auth()->id();
        // dd($data);
        if($request->hasFile('file')){
            $path = $request->file('file')->store('uploads', 'public');

            $data['file'] = $path;
        }

        $quote = Quotation::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'quotation_price' => $request->quotation_price,
            'user_id' => Auth::id(),
        ]);

        event(new QuotationCreated($quote));

        Log::info("---Event Fired");

        if($quote){
            return redirect()->back()->with("Success", "Quotation has been sent successfully");
        }else {
            return redirect()->back()->with("Error", "Error encountered, please try again");
        }
    }
}
