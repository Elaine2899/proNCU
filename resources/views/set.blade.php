@extends('layouts/header')

@section('head')
    
    <link rel="icon" href="resources/img/squirrel_o.png">
    <link rel="stylesheet" href="{{asset('css/set.css')}}">

@endsection

@section('title', '設定')

@section('main')

    <h1>個人化設定</h1>
    <form action="homepage.html" method="post">
        <div class="photo">
            <h2>選擇你的大頭貼</h2>
            <div>
                <input type="radio" id="img1" name="user-img" value="img1.jpg" class="img-option" />
                <label for="img1"><img src="{{asset('img/sticker/img1.jpg')}}" alt="Image 1" width="100"></label>

                <input type="radio" id="img2" name="user-img" value="img2.jpg" class="img-option" />
                <label for="img2"><img src="{{asset('img/sticker/img2.jpg')}}" alt="Image 2" width="100"></label>

                <input type="radio" id="img3" name="user-img" value="img3.jpg" class="img-option" />
                <label for="img3"><img src="{{asset('img/sticker/img3.jpg')}}" alt="Image 3" width="100"></label>

                <input type="radio" id="img4" name="user-img" value="img4.jpg" class="img-option" />
                <label for="img4"><img src="{{asset('img/sticker/img4.jpg')}}" alt="Image 4" width="100"></label>

                <input type="radio" id="img5" name="user-img" value="img5.jpg" class="img-option" />
                <label for="img5"><img src=".{{asset('img/sticker/img5.jpg')}}" alt="Image 5" width="100"></label>

                <input type="radio" id="img6" name="user-img" value="img6.jpg" class="img-option" />
                <label for="img6"><img src="{{asset('img/sticker/img6.jpg')}}" alt="Image 6" width="100"></label>

                <input type="radio" id="img7" name="user-img" value="img7.jpg" class="img-option" />
                <label for="img7"><img src="{{asset('img/sticker/img7.jpg')}}" alt="Image 7" width="100"></label>

                <input type="radio" id="img8" name="user-img" value="img8.jpg" class="img-option" />
                <label for="img8"><img src="{{asset('img/sticker/img8.jpg')}}" alt="Image 8" width="100"></label>
            </div>
        </div>
        <div class="name">
            <h2>設定你的用戶名稱</h2>
            <input type="text" name="user-name" required />
        </div>
        <button type="submit">確定</button>
    </form>

    <script src="{{asset('js/set.js')}}"></script>

@endsection 