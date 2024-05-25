@extends('layouts/course_dashboard')

@section('other-head')

    <link rel="icon" href="resources/img/squirrel_o.png">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

@endsection

@section('title', '主頁')


@section('upper_body')

    <div class="all-container">
        <div class="top-container">
            <div class="my-container">
                <a href="{{ route('set') }}" class="user-link">
                    <img src="{{asset('img/sticker/img1.jpg')}}" alt="user">
                    <div class="user-name"><br>小菓菓</div>
                </a>
            </div>        

@endsection
        
            
@section('lower_body')    
</div> 
        <div class="bottom-container">
            <div class="reminder-container">
                <p class="reminder-title">今天の事</p>
                <p class="reminder-item">#資料庫管理 線上上課</p>
                <p class="reminder-item">#資料庫管理 作業記得交</p>
            </div>
            <div class="game-container">
                <img src="{{asset('img/surprise-box.png')}}" alt="surprise box">
                <img src="{{asset('img/surprise-box.png')}}" alt="surprise box">
            </div>
        </div>
    </div>

    <script src="{{asset('js/home.js')}}"></script>
@endsection



