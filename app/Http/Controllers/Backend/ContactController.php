<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{    
    public function __construct(){
      
      $this->middleware('auth');

    }
        public function ContactView()
    {
    	$contacts = ContactUs::latest()->get();
        return view('backend.setup.contact.index', compact('contacts'));
    }

        public function ContactEdit($id)
    {
        $contact = ContactUs::find($id);
        return view('backend.setup.contact.edit',compact('contact'));

    }

    public function ContactUpdate(Request $request,$id){
       
        $validatedData = $request->validate([
            'location' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'email' => 'required',
        ]);

        $data = ContactUs::find($id);
        $data->location = $request->location;
        $data->phone = $request->phone;
        $data->fax = $request->fax;
        $data->email = $request->email;
        $data->save();
        
        $notification = array(
           'message' => 'Home Contact Updated Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('contact.view')->with($notification);
    }
}
