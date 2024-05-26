<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CalendarController extends Controller
{
    //
    public function ShowCalendarPage(){
        return view(view:"calendar");
    }


    public function getEvents(){

        $sid = Session::get('user_sid');
        $events = DB::table('events')->where('user_sid', $sid)->get();
        return response()->json($events);

    }

    public function getTodayEvents(Request $request){

        $sid = Session::get('user_sid');
        $query = "SELECT * FROM events WHERE user_sid = ? AND end_time = ?";
        $events = DB::select($query, [$sid, $request->date]);
        return response()->json($events);

    }

    public function addEvent(Request $request)
    {              
        $sid = Session::get('user_sid');
        $events = new Event();
        $events->end_time = $request->date;
        $events->events_name = $request->event;
        $events->user_sid = $sid;
        $events->save();
        return response()->json($events);
    }

    // 删除事件
    public function deleteEvent(Request $request)
    {
        try {
            $sid = Session::get('user_sid');
            if (!$sid) {
                return response()->json(['error' => 'User SID not found in session'], 400);
            }
    
            $deleted = Event::where('end_time', $request->date)
                            ->where('events_name', $request->event)
                            ->where('user_sid', $sid)
                            ->delete();
    
            if ($deleted) {
                return response()->json(['status' => 'Event deleted']);
            } else {
                return response()->json(['error' => 'Event not found or not authorized to delete'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    
    }


}