<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{    
    public function __construct(){
      
      $this->middleware('auth');

    }
        public function ContactView()
    {  
        Log::info('ContactUsController -> getAll started');
    	$contacts = ContactUs::latest()->get();
        Log::info('ContactUsController -> ContactUs Count - ' . $contacts->count());
        Log::info('ContactUsController -> getAll ended');
        return view('backend.setup.contact.index', compact('contacts'));
    }

        public function ContactEdit($id)
    {   
        Log::info('ContactUsController -> editContactUs started');
        $contact = ContactUs::find($id);
        Log::info('ContactUsController -> edit ContactUs id - ' . $contact->id);
        Log::info('ContactUsController -> getAll endContactUs Update');
        return view('backend.setup.contact.edit',compact('contact'));


    }

    public function ContactUpdate(Request $request,$id){
       
       Log::info('ContactUsController -> updateContactUs started');

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

       Log::info('ContactUsController -> Contact Us data update id - ' . $id);
       Log::info('ContactUsController -> Contact us Content Update ended');

        return redirect()->route('contact.view')->with($notification);
    }
}
