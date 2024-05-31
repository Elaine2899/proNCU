<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class WelcomeController extends Controller

{ 
    
    public function ShowLoginPage(){
        return view(view:"login");
    }

    public function register(Request $request) { 
        $studentid = $request->input('studentid');
        $password = $request->input('password');

        if($studentid && trim($studentid) !== '' && $password && trim($password) !== ''){
            $user = new User();
            $user->studentID = $studentid;
            $user->password = $password;
            $user->userName = "小松果";
            $user->sticker_id = "img1.jpg";
            $user->save();

            Session::put('user_sid', $user->studentID);
            Session::put('user_name', $user->userName);
            Session::put('user_sticker', $user->sticker_id);

            return redirect('/home');
        }
        

    }

    public function login(Request $request) { 
        $studentid = $request->input('studentid');
        $password = $request->input('password');

        $query = "SELECT * FROM users WHERE studentID = ? AND password = ?";
        $result = DB::select($query, [$studentid, $password]);
        

        if (count($result) == 1) {
            $user = $result[0];
            Session::put('user_sid', $user->studentID);
            Session::put('user_name', $user->userName);
            Session::put('user_sticker', $user->sticker_id);

            return redirect('/home');

        } else {
            return redirect()->back()->with('error', '帳號或密碼錯誤！');
        }

    }

    public function logout(){

        Session::flush();
        return redirect('/welcome');

    }
}


            