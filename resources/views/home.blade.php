@extends('layouts/course_dashboard')

@section('other-head')

    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="icon" href="resources/img/squirrel_o.png">
    
@endsection

@section('title', '主頁')


@section('upper_body')

    <?php 
    
        $user_name = Session::get('user_name');
        $user_sticker = Session::get('user_sticker');
        $user_sid = Session::get('user_sid');
        if($user_sticker === 'img1.jpg'){
            Session::put('user_nickname', '新手村勇者');
        }
        else if($user_sticker === 'img2.jpg'){
            Session::put('user_nickname', '選課之神加護者');
        }
        else if($user_sticker === 'img3.jpg'){
            Session::put('user_nickname', '俄羅斯第一壯妹');
        }
        else if($user_sticker === 'img4.jpg'){
            Session::put('user_nickname', '學分富翁');
        }
        else if($user_sticker === 'img5.jpg'){
            Session::put('user_nickname', '學分奴隸');
        }
        else if($user_sticker === 'img6.jpg'){
            Session::put('user_nickname', '貪吃松鼠大王');
        }
        else if($user_sticker === 'img7.jpg'){
            Session::put('user_nickname', '鼠屆第一男高音');
        }
        else{
            Session::put('user_nickname', '鼠屆帕華洛帝aka怕滑落鼠');
        }
        $user_nickname = Session::get('user_nickname');

        if($user_name === '小松果'){
           $user_notice = '請點擊右上角更改暱稱及頭像🥳';
        }
        else{
            $user_notice = '';
        }
    
    ?>

    <div class="all-container">
        <div class="top-container">
            <div class="my-container">
                <a href="{{ route('set') }}" class="user-link">
                    <img src="{{asset('img/sticker/' . $user_sticker)}}" alt="user">
                    <div class="user-name"><br>{{ "歡迎~  " .$user_nickname }}<br>{{ $user_notice }}</div>
                    <div class="user-sid"><br>{{ $user_sid }}</div>
                </a>
            </div>   
                 

@endsection
        
            
@section('lower_body')    
</div> 
        <div class="bottom-container">
            <div id = "reminder-container" class="reminder-container">
                <h5 class="reminder-title">今天の事</h5>
                
            </div>
            <div class="game-container">
                <a Target="_blank" href="{{ route('Game2') }}">
                    <img src="{{asset('img/surprise-box.png')}}" alt="surprise box">
                </a>
                <a Target="_blank" href="{{ route('eatSquirrel') }}">
                    <img src="{{asset('img/surprise-box.png')}}" alt="surprise box">
                </a>
            </div>
        </div>
    </div>

    <script src="{{asset('js/home.js')}}"></script>
@endsection



