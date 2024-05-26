@extends('layouts/header')

@section('head')
    
    <link rel="icon" href="resources/img/squirrel_o.png">
    <link rel="stylesheet" href="{{asset('css/setting.css')}}">

@endsection

@section('title', '設定')

@section('main')

    <h1>個人化設定</h1>
    <div class="setting-content">
        <h1>個人設定</h1>
        <form method="POST" action="{{ route('change.user.data') }}">
        @csrf
            <div class="photo">
                <h2>選擇大頭貼</h2>
                <div class="all-img">
                    <div class="top-img">
                        <input type="radio" id="img1" name="user-img" value="img1.jpg" class="img-option" />
                        <label for="img1"><img src="{{asset('img/sticker/img1.jpg')}}" alt="Image 1" width="100">新手村勇者</label>

                        <input type="radio" id="img2" name="user-img" value="img2.jpg" class="img-option" />
                        <label for="img2"><img src="{{asset('img/sticker/img2.jpg')}}" alt="Image 2" width="100">選課之神加護者</label>

                        <input type="radio" id="img3" name="user-img" value="img3.jpg" class="img-option" />
                        <label for="img3"><img src="{{asset('img/sticker/img3.jpg')}}" alt="Image 3" width="100">俄羅斯第一壯妹</label>

                        <input type="radio" id="img4" name="user-img" value="img4.jpg" class="img-option" />
                        <label for="img4"><img src="{{asset('img/sticker/img4.jpg')}}" alt="Image 4" width="100">學分富翁</label>
                    </div>
                    <div class="buttom-img">
                        <input type="radio" id="img5" name="user-img" value="img5.jpg" class="img-option" />
                        <label for="img5"><img src="{{asset('img/sticker/img5.jpg')}}" alt="Image 5" width="100">學分奴隸</label>

                        <input type="radio" id="img6" name="user-img" value="img6.jpg" class="img-option" />
                        <label for="img6"><img src="{{asset('img/sticker/img6.jpg')}}" alt="Image 6" width="100">貪吃松鼠大王</label>

                        <input type="radio" id="img7" name="user-img" value="img7.jpg" class="img-option" />
                        <label for="img7"><img src="{{asset('img/sticker/img7.jpg')}}" alt="Image 7" width="100">鼠屆第一男高音</label>

                        <input type="radio" id="img8" name="user-img" value="img8.jpg" class="img-option" />
                        <label for="img8"><img src="{{asset('img/sticker/img8.jpg')}}" alt="Image 8" width="100">鼠屆帕華洛帝aka怕滑落鼠</label>
                    </div>
                </div>
            </div>
            <div class="name">
                <h2>用戶名稱</h2>
                <input type="text" name="user-name"/>
            </div>
            <div class="sb-container"><button type="submit">確定</button></div>
        </form>
    </div>
    
    <!-- <script src="{{asset('js/set.js')}}"></script> -->

@endsection 