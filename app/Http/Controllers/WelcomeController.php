<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class WelcomeController extends Controller

{ 
    
    public function ShowLoginPage(){
        return view(view:"login");
    }

    public function register(Request $request) { 
        $request->validate([
            'studentid' => 'required|string|min:4',
            'password' => 'required|string|min:4',
        ], [
            'studentid.required' => '學號為必填欄位！',
            'password.required' => '密碼為必填欄位！',
            'studentid.min' => '學號長度不得少於 4 個字元！',
            'password.min' => '密碼長度不得少於 4 個字元！',
        ]);

        $studentid = $request->input('studentid');
        $password = $request->input('password');

        $user = new User();
        $user->studentID = $studentid;
        $user->password = Hash::make($password);
        $user->userName = "小松果";
        $user->sticker_id = "img1.jpg";
        $user->save();

        Session::put('user_sid', $user->studentID);
        Session::put('user_name', $user->userName);
        Session::put('user_sticker', $user->sticker_id);

        return redirect('/home');
    }

    public function login(Request $request) { 
        $request->validate([
            'studentid' => 'required',
            'password' => 'required',
        ], [
            'studentid.required' => '學號為必填欄位！',
            'password.required' => '密碼為必填欄位！',
        ]);

        $studentid = $request->input('studentid');
        $password = $request->input('password');

        $user = User::where('studentID', $studentid)->first();

        if ($user && Hash::check($password, $user->password)) {
            Session::put('user_sid', $user->studentID);
            Session::put('user_name', $user->userName);
            Session::put('user_sticker', $user->sticker_id);

            return redirect('/home');

        } else {
            return redirect()->back()->with('error', '學號或密碼錯誤！');
        }

    }

    public function logout(){

        Session::flush();
        return redirect('/welcome');

    }
}


            