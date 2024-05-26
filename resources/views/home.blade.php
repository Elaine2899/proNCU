@extends('layouts/course_dashboard')

@section('other-head')

    <link rel="icon" href="resources/img/squirrel_o.png">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

@endsection

@section('title', '主頁')


@section('upper_body')

    <?php 
    
        $user_name = Session::get('user_name');
        $user_sticker = Session::get('user_sticker');
    
    ?>

    <div class="all-container">
        <div class="top-container">
            <div class="my-container">
                <a href="{{ route('set') }}" class="user-link">
                    <img src="{{asset('img/sticker/' . $user_sticker)}}" alt="user">
                    <div class="user-name"><br>{{ $user_name }}</div>
                </a>
            </div>        

@endsection
        
            
@section('lower_body')    
</div> 
        <div class="bottom-container">
            <div id = "reminder-container" class="reminder-container">
                <p class="reminder-title">今天の事</p>
                
            </div>
            <div class="game-container">

                <img src="{{asset('img/surprise-box.png')}}" alt="surprise box">
                <a Target="_blank" href="{{ route('eatSquirrel') }}">
                    <img src="{{asset('img/surprise-box.png')}}" alt="surprise box">
                </a>
            </div>
        </div>
    </div>

    <script src="{{asset('js/home_new.js')}}"></script>
@endsection



