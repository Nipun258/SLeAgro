<?php

namespace App\Http\Controllers\Backend\Centre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EconomicCentre;
use App\Models\Provice;
use App\Models\District;
use App\Models\City;
use Validator;
use Response;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Carbon;


class EconomicCenterController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');
    }

    public function EconomicCentreView()
    {  
        
      $ecentre = DB::table('economic_centres')
                        ->Join('provices','economic_centres.province_id','=','provices.id')
                        ->Join('districts','economic_centres.district_id','=','districts.id')
                        ->Join('cities','economic_centres.city_id','=','cities.id')
                        ->whereNull('deleted_at')
                        ->select('economic_centres.id','economic_centres.centre_name','economic_centres.centre_type','provices.name_en AS pname','districts.name_en AS dname','cities.name_en AS cname')
                        ->get();

      $trachEcentre = DB::table('economic_centres')
                        ->Join('provices','economic_centres.province_id','=','provices.id')
                        ->Join('districts','economic_centres.district_id','=','districts.id')
                        ->Join('cities','economic_centres.city_id','=','cities.id')
                        ->where('deleted_at','!=',NULL)
                        ->select('economic_centres.id','economic_centres.centre_name','economic_centres.centre_type','provices.name_en AS pname','districts.name_en AS dname','cities.name_en AS cname')
                        ->get();


      return view('backend.centre.economic_centre.view',compact('ecentre','trachEcentre'));

    }

    public function EconomicCentreAdd()
    {   
    	$data['province'] = Provice::get(["name_en", "id"]);
        return view('backend.centre.economic_centre.add',$data);
    }

    public function fetchDistrict(Request $request)
    {
        $data['districts'] = District::where("province_id",$request->province_id)->get(["name_en", "id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("district_id",$request->district_id)->get(["name_en", "id"]);
        return response()->json($data);
    }

    public function EconomicCentreStore(Request $request)
    {
        $validatedData = $request->validate([
            'centre_name' => 'required|string|max:255',
            'centre_type' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
        ]);

        $data = new EconomicCentre();
        $data->centre_name = $request->centre_name;
        $data->centre_type = $request->centre_type;
        $data->province_id = $request->province;
        $data->district_id = $request->district;
        $data->city_id = $request->city;
        $data->save();
        
        $notification = array(
           'message' => 'Economic Centre Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('ecomomic.centre.view')->with($notification);
    }

    public function EconomicCentreEdit($id)
    {
        $editData = EconomicCentre::find($id);
        $province = Provice::get(["name_en", "id"]);
        return view('backend.centre.economic_centre.edit',compact('editData','province'));
    }

    public function EconomicCentreUpdate(Request $request,$id){
       
        $validatedData = $request->validate([
            'centre_name' => 'required|string|max:255',
            'centre_type' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
        ]);

        $data = EconomicCentre::find($id);
        $data->centre_name = $request->centre_name;
        $data->centre_type = $request->centre_type;
        $data->province_id = $request->province;
        $data->district_id = $request->district;
        $data->city_id = $request->city;
        $data->save();
        
        $notification = array(
           'message' => 'Economic Centre Updated Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('ecomomic.centre.view')->with($notification);
    }

    public function EconomicCentreSoftDelete($id){

        $ecentre = EconomicCentre::find($id);
        $ecentre->delete();

        $notification = array(
           'message' => 'Economic Centre Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('ecomomic.centre.view')->with($notification);
    }

    public function EconomicCentreRestore($id){

        $ecentre = EconomicCentre::withTrashed()->find($id)->restore();

        $notification = array(
           'message' => 'Economic Centre Restore Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('ecomomic.centre.view')->with($notification);
    }

    public function EconomicCentreDelete($id){

        $ecentre = EconomicCentre::onlyTrashed()->find($id)->forceDelete();
        
        $notification = array(
           'message' => 'Economic Centre Permantly Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('ecomomic.centre.view')->with($notification);
    }


}
