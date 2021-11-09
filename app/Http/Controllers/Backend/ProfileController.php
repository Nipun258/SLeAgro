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
        /****************************************************/
        $city = DB::table('farmers')
                ->select('cities.name_en as name')
                ->Join('cities','cities.id','=','farmers.city_id')
                ->Join('users','users.id','=','farmers.user_id')
                ->where('users.id',$id)
                ->get(); 

        if ($city->count() != 0)  {
            
            $city =json_decode($city,true);
            $city= $city[0]['name'];

        }       
        /*******************************************************/
        $discrict = DB::table('farmers')
                ->select('districts.name_en as name')
                ->Join('districts','districts.id','=','farmers.district_id')
                ->Join('users','users.id','=','farmers.user_id')
                ->where('users.id',$id)
                ->get(); 

        if ($discrict->count() != 0)  {
            
            $discrict =json_decode($discrict,true);
            $discrict= $discrict[0]['name'];

        }  
        /**********************************************************/

        $province = DB::table('farmers')
                ->select('provices.name_en as name')
                ->Join('provices','provices.id','=','farmers.province_id')
                ->Join('users','users.id','=','farmers.user_id')
                ->where('users.id',$id)
                ->get(); 

        if ($province->count() != 0)  {
            
            $province =json_decode($province,true);
            $province= $province[0]['name'];

        }
        /**********************************************************/

        $bank = DB::table('farmers')
                ->select('bank.strBankName as name')
                ->Join('bank','bank.strBankCode','=','farmers.bank_id')
                ->Join('users','users.id','=','farmers.user_id')
                ->where('users.id',$id)
                ->get(); 
        
        if ($bank->count() != 0)  {
            
            $bank =json_decode($bank,true);
            $bank= $bank[0]['name'];

        }
        /*************************************************/

        $branch = DB::table('farmers')
                ->select('branch.strBranchLocation as name')
                ->Join('branch','branch.strBranchCode','=','farmers.branch_id')
                ->Join('users','users.id','=','farmers.user_id')
                ->where('users.id',$id)
                ->get(); 
        
        if ($branch->count() != 0)  {
            
            $branch =json_decode($branch,true);
            $branch= $branch[0]['name'];

        }
        /*************************************************/
        $pass_name = DB::table('farmers')
                ->select('farmers.pass_name as name')
                ->Join('users','users.id','=','farmers.user_id')
                ->where('users.id',$id)
                ->get(); 
        
        if ($pass_name->count() != 0)  {
            
            $pass_name =json_decode($pass_name,true);
            $pass_name = $pass_name[0]['name'];

        }
       /****************************************************/
        $acc_num = DB::table('farmers')
                ->select('farmers.account_number as acc')
                ->Join('users','users.id','=','farmers.user_id')
                ->where('users.id',$id)
                ->get(); 
        
        if ($acc_num->count() != 0)  {
            
            $acc_num =json_decode($acc_num,true);
            $acc_num = $acc_num[0]['acc'];

        }

        /****************************************************/

        $buyer_city = DB::table('buyers')
                ->select('cities.name_en as name')
                ->Join('cities','cities.id','=','buyers.city_id')
                ->Join('users','users.id','=','buyers.user_id')
                ->where('users.id',$id)
                ->get(); 

        if ($buyer_city->count() != 0)  {
            
            $buyer_city =json_decode($buyer_city,true);
            $buyer_city= $buyer_city[0]['name'];

        }       
        /*******************************************************/
        $buyer_discrict = DB::table('buyers')
                ->select('districts.name_en as name')
                ->Join('districts','districts.id','=','buyers.district_id')
                ->Join('users','users.id','=','buyers.user_id')
                ->where('users.id',$id)
                ->get(); 

        if ($buyer_discrict->count() != 0)  {
            
            $buyer_discrict =json_decode($buyer_discrict,true);
            $buyer_discrict= $buyer_discrict[0]['name'];

        }  
        /**********************************************************/

        $buyer_province = DB::table('buyers')
                ->select('provices.name_en as name')
                ->Join('provices','provices.id','=','buyers.province_id')
                ->Join('users','users.id','=','buyers.user_id')
                ->where('users.id',$id)
                ->get(); 

        if ($buyer_province->count() != 0)  {
            
            $buyer_province =json_decode($buyer_province,true);
            $buyer_province= $buyer_province[0]['name'];

        }
        /*************************************************************/
        
        $buyer_type = DB::table('buyers')
                ->select('buyers.type_id as type')
                ->Join('users','users.id','=','buyers.user_id')
                ->where('users.id',$id)
                ->get(); 
        
        if ($buyer_type->count() != 0)  {
            
            $buyer_type =json_decode($buyer_type,true);
            $buyer_type = $buyer_type[0]['type'];

        }
        /***********************************************************/
    	$user = User::find($id);

    	return view('backend.profile.view',compact('user','ccenter','ecenter','city','discrict','province','bank','branch','pass_name','acc_num','buyer_city','buyer_discrict','buyer_province','buyer_type'));
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

         if (!empty($request->ccenter)) {
             $data->ccentre_id = $request->ccenter;
         }
         if (!empty($request->ecenter)) {
             $data->ecentre_id = $request->ecenter;
         }
         

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
