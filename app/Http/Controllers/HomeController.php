<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function ShowHomePage(){
        return view(view:"home");
    }


    public function ShowSet(){
        return view(view:"set");
    }


}

?>