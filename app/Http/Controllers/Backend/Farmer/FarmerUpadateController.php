<?php

namespace App\Http\Controllers\Backend\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CollectionCentre;
use App\Models\EconomicCentre;
use App\Models\Provice;
use App\Models\District;
use App\Models\City;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Farmer;
use Auth;
use Illuminate\Support\Facades\DB; //query builder in here

class FarmerUpadateController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function FarmerEdit()
    {
    	$id = Auth::user()->id;
        $ecenter = EconomicCentre::get(["centre_name", "id"]);
        $province= Provice::get(["name_en", "id"]);
        $bank = Bank::get(["strBankCode", "strBankName"]);
    	$editData = User::find($id);

    return view('backend.farmer.profile.edit',compact('editData','ecenter','province','bank'));
    }

     public function fetchCollectionCentre(Request $request)
    {
        $data['collection_centres'] = CollectionCentre::where("economic_centre_id",$request->economic_centre_id)->get(["centre_name", "id"]);

        return response()->json($data);
    }

     public function fetchBankBranch(Request $request)
    {
        $data['bank_branches'] = Branch::where("strBankCode",$request->bank_code)->get(["strBranchLocation", "strBranchCode"]);

        return response()->json($data);
    }

    public function FarmerStore(Request $request)
    {    
        $validatedData = $request->validate([

            'mobile' => 'required|min:10',
            'address' => 'required|string|max:255',
            'gender' =>'required',
            'nic' => 'required|min:9|max:12',
            'ecentre' => 'required',
            'ccentre' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'pass_name' => 'required',
            'account_number' => 'required',
            'bank' => 'required',
            'branch' => 'required'

        ]);


    	 $data = User::find(Auth::user()->id);
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
    }

}
