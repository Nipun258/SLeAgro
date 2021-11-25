<?php

namespace App\Http\Controllers\Backend\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\BuyerBooking;
use App\Models\VegitableBookList;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\BuyerBookingMail;
use Illuminate\Support\Facades\Mail;
use App\Rules\ArrayAtLeastOneRequired;

class BuyerBookingController extends Controller
{
    public function __construct(){
      
      $this->middleware('auth');

    }

    public function BuyerBookingView(){

        
        $mybooking  = DB::table('appointments')
                        ->Join('users','appointments.user_id','=','users.id')
                        ->Join('economic_centres','appointments.ecentre_id','=','economic_centres.id')
                        ->where('appointments.ecentre_id', Auth::user()->ecentre_id)
                        ->where('appointments.status',1)
                        ->where('appointments.date','=', date("Y-m-d", strtotime('tomorrow')))
                        ->select('users.name','economic_centres.centre_name','appointments.date','appointments.id')
                        ->orderBy('date', 'desc')
                        ->get();

        return view('backend.booking.buyer_book.index',compact('mybooking'));
    }

    public function BookingProductView($id)
    {   

        $vagArray=array();

        $vegitables_data = DB::table('vegitables')
                        ->select('vegitables.id','vegitables.name','vegitables.image','vegitables.catagory')
                        ->get();

        foreach ($vegitables_data as $veg) {

            $vegID=$veg->id;
            $totalStock=$this->GetTotalStock($vegID);
            $bookingStock=$this->GetBookingStock($vegID);
            $availbleStock = $totalStock - $bookingStock;

            $vagArray[]=array(
                        'id' =>$veg->id,
                        'name' =>$veg->name,  
                        'quntity' =>$availbleStock
                    );
            
         }

        $vegitables_summary = json_encode($vagArray);

        //dd($vegitables_summary);

        $date = DB::table('appointments')
                ->where('id', $id)
                ->select('appointments.date')
                ->get();

        $date=json_decode($date,true);
        $date=$date[0]["date"];

        $app_id = $id;

        return view('backend.booking.buyer_book.check',compact('vegitables_summary','date','app_id'));
    }

    public function BookingBuyerApp(Request $request){
       
        $validatedData = $request->validate([
            'cus_order' => new ArrayAtLeastOneRequired(),
        ]);

        $check = $this->CheckBookingTimeInterval();

        if($check){
            $notification = array(
           'message' => 'You already made an appointment.please wait to make next appointmentss',
           'alert-type' => 'warning'
        );

        return redirect()->route('buyer.booking.view')->with($notification);
        }

        $booking = BuyerBooking::create([
             'user_id' => auth()->user()->id,
             // 'booking_id' => $request->appointmentId,
             'ccentre_id' => auth()->user()->ccentre_id,
             'ecentre_id' => auth()->user()->ecentre_id,
             'date' => $request->date,
         ]);

        $booking_id = DB::table('buyer_bookings')
                      ->latest('id')
                      ->select('id')
                      ->get();

        $booking_id=json_decode($booking_id,true);
        $booking_id=$booking_id[0]["id"];


        //dd($booking_id);

        $vegitable_list = count($request->cus_order);

          for($i=0; $i < $vegitable_list; $i++) {

            if($request->cus_order[$i]!='0' && $request->cus_order[$i]!='null' && $request->cus_order[$i]!='' && $request->cus_order[$i] <= $request->quntity[$i]){
            $vegitable_inventory = new VegitableBookList();
            $vegitable_inventory->booking_id = $booking_id;
            $vegitable_inventory->veg_id = $request->veg_id[$i];
            $vegitable_inventory->quntity = $request->cus_order[$i];
            $vegitable_inventory->date = $request->date;
            $vegitable_inventory->save();
            }

          }

        $ename = DB::table('economic_centres')
                ->where('id', auth()->user()->ecentre_id)
                ->select('economic_centres.centre_name')
                ->get();

        $ename=json_decode($ename,true);
        $ename=$ename[0]["centre_name"];
        
        $data1 = [
               'name' => auth()->user()->name,
               'date' => $request->date,
               'location' => $ename
            ];
    
       $mail = new BuyerBookingMail($data1);
    
       Mail::to(auth()->user()->email)->send($mail);

         
        $notification = array(
           'message' => 'Vegitable booking added successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('buyer.booking.view')->with($notification);

    }

    public function CheckBookingTimeInterval()
    {
        return BuyerBooking::orderby('id','desc')
               ->where('user_id',auth()->user()->id)
               ->whereDate('created_at',date('Y-m-d'))
               ->exists(); 
    }

    public function BuyerBookingList()
    {
           $mybooking  = DB::table('buyer_bookings')
                        ->Join('users','buyer_bookings.user_id','=','users.id')
                        ->Join('economic_centres','buyer_bookings.ecentre_id','=','economic_centres.id')
                        ->where('users.id', Auth::user()->id)
                        ->select('users.name','economic_centres.centre_name','buyer_bookings.date','buyer_bookings.created_at','buyer_bookings.status')
                        ->orderBy('date', 'desc')
                        ->get();
            //dd($mybooking);
        return view('backend.booking.buyer_book.list',compact('mybooking'));
    }

    public function GetTotalStock($vegID){
        

        $orders = DB::table('inventories')
                  ->Join('economic_centres','economic_centres.id','=','inventories.ecentre_id')
                  ->where('inventories.date','=', date("Y-m-d"))
                  ->where('inventories.veg_id','=',$vegID)
                  ->whereIn('inventories.status',[0,2])
                  ->where('inventories.ecentre_id',Auth::user()->ecentre_id)
                  ->select(DB::raw('SUM(inventories.quntity) as count'))
                  ->get();

            foreach ($orders as  $order) 
            {

              $totalcount = $order->count;
             
            }

        return $totalcount;
    }

    public function GetBookingStock($vegID){
        

        $pre_orders = DB::table('vegitable_book_lists')
                     ->Join('buyer_bookings','buyer_bookings.id','=','vegitable_book_lists.booking_id')
                     ->Join('economic_centres','economic_centres.id','=','buyer_bookings.ecentre_id')
                     ->where('buyer_bookings.date','=', date("Y-m-d", strtotime('tomorrow')))
                     ->where('buyer_bookings.ecentre_id',Auth::user()->ecentre_id)
                     ->where('vegitable_book_lists.veg_id','=',$vegID)
                     ->select(DB::raw('SUM(vegitable_book_lists.quntity) as count'))
                     ->get();

            foreach ($pre_orders as  $order) 
            {

              $bookcount = $order->count;
             
            }

        return $bookcount;
    }

}
