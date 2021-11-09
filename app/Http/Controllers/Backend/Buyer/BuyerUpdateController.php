<?php

namespace App\Http\Controllers\Backend\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollectionCentre;
use App\Models\EconomicCentre;
use App\Models\Buyer;
use App\Models\Provice;
use App\Models\User;
use Auth;

class BuyerUpdateController extends Controller
{
    public function __construct() {

        $this->middleware('auth');

    }

    public function BuyerSetup() {

        $id = Auth::user()->id;
        $ecenter = EconomicCentre::get(["centre_name", "id"]);
        $province = Provice::get(["name_en", "id"]);
        $editData = User::find($id);

        return view('backend.buyer.profile.setup', compact('editData', 'ecenter', 'province'));
    }

    public function fetchCollectionCentre(Request $request) {
        $data['collection_centres'] = CollectionCentre::where("economic_centre_id", $request->economic_centre_id)->get(["centre_name", "id"]);

        return response()->json($data);
    }

    public function BuyerEdit() {

        $id = Auth::user()->id;
        $ecenter = EconomicCentre::get(["centre_name", "id"]);
        $province = Provice::get(["name_en", "id"]);
        $buyer = Buyer::where('user_id', '=', $id)->first();
        $editData = User::find($id);

        return view('backend.buyer.profile.edit', compact('editData', 'ecenter', 'province','buyer'));
    }

    public function BuyerStore(Request $request) {
        
        $validatedData = $request->validate([

            'mobile' => 'required|min:10',
            'address' => 'required|string|max:255',
            'gender' => 'required',
            'nic' => 'required|min:9|max:12',
            'type_id' => 'required',
            'ecentre' => 'required',
            'ccentre' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required'

        ]);

        $data = User::find(Auth::user()->id);
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;
        $data->ccentre_id = $request->ccentre;
        $data->ecentre_id = $request->ecentre;
        $data->save();

        /*******************************************/

        
        $buyer1 = Buyer::where('user_id', '=', Auth::user()->id)->first();

        if (empty($buyer1)) {
            
            $buyer = new Buyer();
            $buyer->user_id = Auth::user()->id;
            $buyer->nic = $request->nic;
            $buyer->type_id = $request->type_id;
            $buyer->province_id = $request->province;
            $buyer->district_id = $request->district;
            $buyer->city_id = $request->city;    
            $buyer->save();

        }else{

            $buyer = Buyer::where('user_id', '=', Auth::user()->id)->first();
            $buyer->nic = $request->nic;
            $buyer->type_id = $request->type_id;
            $buyer->province_id = $request->province;
            $buyer->district_id = $request->district;
            $buyer->city_id = $request->city;
            $buyer->save();
        }



        $notification = array(
            'message' => 'Buyer Detials Setup Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('profile.view')->with($notification);
    }

    public function BuyerUpdate(Request $request) {
        
        $validatedData = $request->validate([

            'mobile' => 'required|min:10',
            'address' => 'required|string|max:255',
            'gender' => 'required',
            'nic' => 'required|min:9|max:12',
            'type_id' => 'required',
            'ecentre' => 'required',
            'ccentre' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required'

        ]);

        $data = User::find(Auth::user()->id);
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;
        $data->ccentre_id = $request->ccentre;
        $data->ecentre_id = $request->ecentre;

        $data->save();

        /*******************************************/

            $buyer = Buyer::where('user_id', '=', Auth::user()->id)->first();
            $buyer->nic = $request->nic;
            $buyer->type_id = $request->type_id;
            $buyer->province_id = $request->province;
            $buyer->district_id = $request->district;
            $buyer->city_id = $request->city;
            $buyer->save();



        $notification = array(
            'message' => 'Buyer Detials Update Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('profile.view')->with($notification);
    }

}
