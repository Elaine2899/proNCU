<!doctype html>
<html lang="zh-TW">

<head>
    <link rel="icon" href="resources/img/squirrel_o.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @yield('head')

    <meta charset="utf-8">

    <title>Pro^2 NCU - @yield('title')</title>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{asset('img/squirrel_o.png')}}" alt="squirrel"> Pro<sup>2</sup> NCU
            </a>
            <div class="container d-flex align-items-center ml-auto header_container">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">課程</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('course_search') }}">課程查詢</a>
                        <a class="dropdown-item" href="{{ route('course_dashboard') }}">學分儀錶板</a>
                        <a class="dropdown-item" href="{{ route('course_table') }}">我的課表</a>
                    </div>
                <a class="header-calendar" href="{{ route('calendar') }}">行事曆</a>
                <a class="setting" href="{{ route('set') }} ">
                    <img src="{{asset('img/setting.png')}}" alt="setting">
                </a>
            </div>
        </nav>
    </header>
    
    <main>

    @yield('main')

    </main>
</body>

</html>