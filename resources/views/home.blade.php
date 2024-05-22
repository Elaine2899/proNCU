@extends('layouts/header')

@section('head')

    <link rel="icon" href="resources/img/squirrel_o.png">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

@endsection

@section('title', 'Homepage')


@section('main')

<div class="my-container">
        <a href="{{ route('set') }}">
            <img src="" alt="user">
            <div class="user name"><br>user name</div>
        </a>
    </div>

    <div class="dashboard-container">
        <h2><b>儀錶板</b></h2>
    </div>

    <div class="reminder-container">
        <h2><b>今天の事</b></h2>
    </div>

    <div class="game-container">
        <h2><b>驚喜box</b></h2>
    </div>

    <script src="{{asset('js/home.js')}}"></script>

@endsection 
