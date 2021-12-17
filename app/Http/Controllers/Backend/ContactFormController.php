<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactFormController extends Controller
{  
    
     public function ContactMessageView()
    {   
        Log::info('ContactFormController -> getAll started');
    	$messages = ContactForm::latest()->get();
        Log::info('ContactFormController -> ContactMessage Count - ' . $messages->count());
        Log::info('ContactFormController -> getAll ended');
        return view('backend.message.contact.index', compact('messages'));
    }

    public function ContactMessageStore(Request $request)
    {   
        Log::info('ContactFormController -> ContactMessageCreation started');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_reason' => 'required',
            'district' => 'required',
            'message' => 'required',
        ]);

        $data = new ContactForm();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->contact_reason = $request->contact_reason;
        $data->district = $request->district;
        $data->message = $request->message;
        $data->save();
        
       Log::info('ContactFormController -> Craete New Contact Message Recived With - ' . $request->name .' With email '.$request->email.' and Contact Message for '.$request->contact_reason);
       Log::info('ContactFormController -> ContactMessageCreation ended');

        return redirect('http://127.0.0.1:8000#contact')->with('success','Your message send successfully');
    }

    public function ContactMessageReplay($id){
        
        Log::info('ContactFormController -> ContactMessageReplay started');
        $messages = DB::table('contact_forms')
                ->where('id', $id)
                ->get();
        Log::info('ContactFormController -> Contact Message Reply id - ' . $id);
        Log::info('ContactFormController -> ContactMessageReplay ended');
        return view('backend.message.contact.reply', compact('messages'));
    }

    public function ContactMessageEmail(Request $request){
        
        Log::info('ContactFormController -> ContactMessageEmail started');
        $validatedData = $request->validate([
            'msg' => 'required',

        ]);
        
        $data1 = [
               'subject' => $request->subject,
               'date' => date('Y-m-d'),
               'meassage' => $request->msg
            ];
    
       $mail = new ContactMessageMail($data1);
    
       Mail::to($request->email)->send($mail);

       $data = ContactForm::find($request->id);
       $data->status = 1;
       $data->save();

       Log::info('ContactFormController -> Contact Message Email with subject - ' . $request->subject.' with message date-'.date('Y-m-d'));
       Log::info('ContactFormController -> ContactMessageEmail ended');
         
        $notification = array(
           'message' => 'Reply email sending Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('contact.message.view')->with($notification);
    }

    public function ContactMessageDelete($id){
        
        Log::info('ContactFormController -> ContactMessageDelete started');
        $message = ContactForm::find($id);
        $message->delete();

        $notification = array(
           'message' => 'Contact Message Deleted Successfully',
           'alert-type' => 'error'
        );
        Log::alert('ContactFormController -> Delete Contact Message Id With - ' .$id);
        Log::info('ContactFormController -> ContactMessageDelete ended');

        return redirect()->route('contact.message.view')->with($notification);
    }

}
