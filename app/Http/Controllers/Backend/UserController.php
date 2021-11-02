<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CollectionCentre;
use App\Mail\registerMail;
use Illuminate\Support\Facades\Mail;
use Auth;

class UserController extends Controller
{   
    public function __construct(){
      
      $this->middleware('auth');
    }

    public function UserView()
    {   //$allData = User::all();
        $data['allData'] = User::where('usertype','Admin')
                           ->where('role','!=','Admin')->get();
        

        return view('backend.user.view',$data);
    }

    public function UserAdd()
    {
        $data['ccenter'] = CollectionCentre::get(["centre_name", "id","economic_centre_id"]);
        return view('backend.user.add',$data);
    }

    public function UserStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required',
        ]);

        $data = new User();
        $code = rand(0000,9999);
        $data->usertype = 'Admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->ecentre_id = Auth::user()->ecentre_id;
        
        if (Auth::user()->role == 'EC-Officer') {
            
        $data->ccentre_id = $request->ccenter;
        
        }

        if (Auth::user()->role == 'RC-Officer') {
            
        $data->ccentre_id = Auth::user()->ccentre_id;
            
        }
        
        $data->save();

        $data1 = [
               'email' => $request->email,
               'password' => $code,
               'role' => $request->role
            ];
    
     $mail = new RegisterMail($data1);
    
     Mail::to($request->email)->send($mail);
        
        $notification = array(
           'message' => 'User Inserted Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function UserEdit($id)
    {
        $editData = User::find($id);
        return view('backend.user.edit',compact('editData'));
    }

    public function UserUpdate(Request $request,$id){
       
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required',
        ]);

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;
        $data->save();
        
        $notification = array(
           'message' => 'User Updated Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function UserDelete($id){

        $user = User::find($id);
        $user->delete();

        $notification = array(
           'message' => 'User Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('user.view')->with($notification);
    }
}
