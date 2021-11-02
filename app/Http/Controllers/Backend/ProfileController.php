<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CollectionCentre;
use App\Models\EconomicCentre;
use Auth;
use Illuminate\Support\Facades\DB; //query builder in here
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{   
    public function __construct(){
      
      $this->middleware('auth');

    }
    
    public function ProfileView()
    {
    	$id = Auth::user()->id;
        /***********************************************/
        $ccenter = DB::table('users')
                ->select('collection_centres.centre_name as name')
                ->Join('collection_centres','collection_centres.id','=','users.ccentre_id')
                ->where('users.id',$id)
                ->get();

        if ($ccenter->count() != 0)  {
            
            $ccenter =json_decode($ccenter,true);
            $ccenter=$ccenter[0]['name'];

        }        
        /********************************************************/
        $ecenter = DB::table('users')
                ->select('economic_centres.centre_name as name')
                ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                ->where('users.id',$id)
                ->get();

        if ($ecenter->count() != 0)  {
            
            $ecenter =json_decode($ecenter,true);
            $ecenter=$ecenter[0]['name'];

        } 
        /*******************************************************/
    	$user = User::find($id);

    	return view('backend.profile.view',compact('user','ccenter','ecenter'));
    }

    public function ProfileEdit()
    {
    	$id = Auth::user()->id;
        $ccenter = CollectionCentre::get(["centre_name", "id"]);
        $ecenter = EconomicCentre::get(["centre_name", "id"]);
    	$editData = User::find($id);

    	return view('backend.profile.edit',compact('editData','ccenter','ecenter'));
    }

    public function ProfileStore(Request $request)
    {    
        $validatedData = $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255',
            'mobile' => 'required|min:10',
            'address' => 'required|string|max:255',
            'gender' =>'required',
        ]);


    	 $data = User::find(Auth::user()->id);
    	 // $data->name = $request->name;
      //    $data->email = $request->email;
         $data->mobile = $request->mobile;
    	 $data->address = $request->address;
         $data->gender = $request->gender;
         $data->ccentre_id = $request->ccenter;
         $data->ecentre_id = $request->ecenter;

         if ($request->file('image')) {
         	
         	$file = $request->file('image');
         	@unlink(public_path('upload/user_images'.$data->image));
         	$filename = date('YmdHi').$file->getClientOriginalName();
         	$file->move(public_path('upload/user_images'),$filename);
         	$data['image'] = $filename;

         }
         $data->save();

         $notification = array(
           'message' => 'User profile update Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('profile.view')->with($notification);
    }//profile update page

    public function PasswordView()
    {
    	$id = Auth::user()->id;
    	$user = User::find($id);

    	return view('backend.profile.edit_password',compact('user'));

    }

    public function PasswordUpdate(Request $request){
 		$validatedData = $request->validate([
    		'oldpassword' => 'required',
    		'password' => 'required|confirmed',
            'password_confirmation' => 'required'
    	]);


    	$hashedPassword = Auth::user()->password;
    	if (Hash::check($request->oldpassword,$hashedPassword)) {
    		$user = User::find(Auth::id());
    		$user->password = Hash::make($request->password);
    		$user->save();
    		Auth::logout();
    		return redirect()->route('login');
    	}else{

        $notification = array(
           'message' => 'User faild update password.Try Again',
           'alert-type' => 'error'
        );
    		return redirect()->route('password.view')->with($notification);
    	}


 	} // End Metod 
}
