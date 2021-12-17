<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use Redirect,Response;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CalenderController extends Controller
{
    public function calendarIndex()
    {   
        Log::info('CalendarController -> getAll started');
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');

         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Events::whereDate('start', '>=', $start)
                        ->whereDate('end',   '<=', $end)
                        ->where('user_id',Auth::user()->id)
                        ->get(['id','title','start', 'end','event_type']);

         return Response::json($data);
         
        }
        //Log::info('CalendarController -> calendar Event Count - ' . $data->count());
        Log::info('CalendarController -> getAll ended');
        return view('backend.calendar.index');
    }

    public function calendarCreate(Request $request)
    {  
        $insertArr = [ 'user_id' => Auth::user()->id,
                       'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end,
                       'event_type' => 1,
                       'created_at' => Carbon::now()
                    ];
        $event = Events::insert($insertArr);   
        return Response::json($event);
    }

    public function calendarCreateNormal(Request $request)
    {  
       Log::info('CalendarController -> NewEventCreation started');
       $validatedData = $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        Events::insert([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'event_type' => 1,
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'New Event Added Successfully',
           'alert-type' => 'success'
        );

       Log::info('CalendarController -> Craete New Normal Event Name With - ' . $request->title .' Event Start date '.$request->start.' and End '.$request->end);
       Log::info('CalendarController -> NewEventCreation ended');

        return redirect()->route('calendar')->with($notification);
    }
     
 
    public function calendarUpdate(Request $request)
    {   
        Log::info('CalendarController -> EventUpdate started');
        $where = array('id' => $request->id);
        $updateArr = ['user_id' => Auth::user()->id,'title' => $request->title,'start' => $request->start, 'end' => $request->end,'updated_at' => Carbon::now()];
        $event  = Events::where($where)->update($updateArr);
        Log::info('CalendarController -> Edit Normal Event Name With - ' . $request->title .' Event Start date '.$request->start.' and End '.$request->end);
       Log::info('CalendarController -> EventUpdate ended');
        return Response::json($event);
    } 
 
 
    public function calendarDelete(Request $request)
    {  
        Log::info('CalendarController -> EventDelete started');
        $event = Events::where('id',$request->id)->delete();
        Log::alert('CalendarController -> Delete Normal Event Id With - ' . $request->id);
       Log::info('CalendarController -> EventDelete ended');
        return Response::json($event);
    } 

}
