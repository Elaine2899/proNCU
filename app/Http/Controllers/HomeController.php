<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function ShowHomePage(){
        return view(view:"home");
    }


    public function ShowSet(){
        return view(view:"set");
    }

    public function ShoweatSquirrel(){
        return view(view:"eatSquirrel");
    }

    public function ChangeUserData(Request $request){
        $sid = Session::get('user_sid');

        // 查找特定的使用者记录
        $user = User::where('studentID', $sid)
        ->first();

        if ($user) {

            if($request->input('user-name') && trim($request->input('user-name')) !== ''){
                $user->userName = $request->input('user-name');
                $user->save();
                Session::put('user_name', $user->userName);
            }
            
            if($request->input('user-img') && trim($request->input('user-img')) !== ''){
                $user->sticker_id = $request->input('user-img');
                $user->save();
                Session::put('user_sticker', $user->sticker_id);
            }  
            return redirect('/home');       
        } 

    }


}

?>