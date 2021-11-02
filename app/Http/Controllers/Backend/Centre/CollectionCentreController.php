<?php

namespace App\Http\Controllers\Backend\Centre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollectionCentre;
use App\Models\EconomicCentre;
use App\Models\Provice;
use App\Models\District;
use App\Models\City;
use Auth;
use Illuminate\Support\Facades\DB;

class CollectionCentreController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');
    }

    public function CollectionCentreView()
    {  
        
      $allData  = DB::table('collection_centres')
                        ->Join('provices','collection_centres.province_id','=','provices.id')
                        ->Join('districts','collection_centres.district_id','=','districts.id')
                        ->Join('cities','collection_centres.city_id','=','cities.id')
                        ->Join('economic_centres','collection_centres.economic_centre_id','=','economic_centres.id')
                        ->select('collection_centres.id','collection_centres.centre_name AS ccentre','economic_centres.centre_name AS ecentre','provices.name_en AS pname','districts.name_en AS dname','cities.name_en AS cname')
                        ->get();
      /*********************************************************************************/
      $id = Auth::user()->id;

      $ecenter = DB::table('users')
                ->select('economic_centres.centre_name as name')
                ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                ->where('users.id',3)
                ->get();

        if ($ecenter->count() != 0)  {
            
            $ecenter =json_decode($ecenter,true);
            $ecenter=$ecenter[0]['name'];

        }
         
      return view('backend.centre.collection_centre.view',compact('allData','ecenter'));
    }

    public function CollectionCentreAdd()
    {   
      $province = Provice::get(["name_en", "id"]);
      $ecenter = EconomicCentre::get(["centre_name", "id"]);

      $id = Auth::user()->id;

      $ecenter1 = DB::table('users')
                ->select('economic_centres.centre_name as name')
                ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                ->where('users.id',3)
                ->get();

        if ($ecenter1->count() != 0)  {
            
            $ecenter1 =json_decode($ecenter1,true);
            $ecenter1=$ecenter1[0]['name'];

        }

      return view('backend.centre.collection_centre.add',compact('province','ecenter','ecenter1'));
    }

    // public function fetchDistrict(Request $request)
    // {
    //     $data['districts'] = District::where("province_id",$request->province_id)->get(["name_en", "id"]);
    //     return response()->json($data);
    // }

    // public function fetchCity(Request $request)
    // {
    //     $data['cities'] = City::where("district_id",$request->district_id)->get(["name_en", "id"]);
    //     return response()->json($data);
    // }

    public function CollectionCentreStore(Request $request)
    {
        $validatedData = $request->validate([
            'centre_name' => 'required|string|max:255',
            'ecenter' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
        ]);

        $data = new CollectionCentre();
        $data->centre_name = $request->centre_name;
        $data->economic_centre_id = $request->ecenter;
        $data->province_id = $request->province;
        $data->district_id = $request->district;
        $data->city_id = $request->city;
        $data->save();
        
        $notification = array(
           'message' => 'Collection Centre Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('collection.centre.view')->with($notification);
    }

    public function CollectionCentreEdit($id)
    {
        $editData = CollectionCentre::find($id);
        $ecenter = EconomicCentre::get(["centre_name", "id"]);
        $province = Provice::get(["name_en", "id"]);

        $id = Auth::user()->id;

      $ecenter1 = DB::table('users')
                ->select('economic_centres.centre_name as name')
                ->Join('economic_centres','economic_centres.id','=','users.ecentre_id')
                ->where('users.id',3)
                ->get();

        if ($ecenter1->count() != 0)  {
            
            $ecenter1 =json_decode($ecenter1,true);
            $ecenter1=$ecenter1[0]['name'];

        }

        return view('backend.centre.collection_centre.edit',compact('editData','province','ecenter','ecenter1'));
    }

    public function CollectionCentreUpdate(Request $request,$id){
       
        $validatedData = $request->validate([
            'centre_name' => 'required|string|max:255',
            'ecenter' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
        ]);

        $data = CollectionCentre::find($id);
        $data->centre_name = $request->centre_name;
        $data->economic_centre_id = $request->ecenter;
        $data->province_id = $request->province;
        $data->district_id = $request->district;
        $data->city_id = $request->city;
        $data->save();
        
        $notification = array(
           'message' => 'Collection Centre Updated Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('collection.centre.view')->with($notification);
    }

    public function CollectionCentreDelete($id){

        $ccentre = CollectionCentre::find($id);
        $ccentre->delete();

        $notification = array(
           'message' => 'Collection Centre Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('collection.centre.view')->with($notification);
    }

}
