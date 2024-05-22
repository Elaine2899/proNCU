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

}