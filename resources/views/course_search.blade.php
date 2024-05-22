@extends('layouts/header')

@section('head')

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>


    <script src="{{asset('js/co.js')}}"></script>
    <!-- <script src="./course_search_v1.2_toast.js"></script> -->
    <link rel="stylesheet" href="{{asset('css/course_search.css')}}">

@endsection

@section('title', '選課')


@section('main')

    <!-- 開課單位 -->
    <div class="course-container">
        <div class="d-flex justify-content-start">
            <div class="course_search_title"><p><b>開課單位</b></p></div>
        </div>
        <div class="d-flex justify-content-evenly">
            <div class="col-5">
                <select id="college-dropdown" class="form-select form-select-sm">
                    <option selected>不指定開課單位</option>
                </select>
            </div>
            <div class="col-5">
                <select id="department-dropdown" class="form-select form-select-sm">
                    <option selected>不指定系所</option>
                </select>
            </div>
        </div>
    </div>
    <!-- 依關鍵字查詢 -->
    <div class="course-container">
        <div class="course_search_title"><p><b>依關鍵字查詢</b></p></div>

        <div class="d-flex justify-content-evenly">
            <div class="col-5">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">課程名稱</span>
                    <input type="text" class="form-control course-name-filter" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
            <div class="col-5">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">授課教師</span>
                    <input type="text" class="form-control teacher-filter" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
        </div>
    
        <div class="d-flex justify-content-evenly">
            <div class="col-5">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">課程代號</span>
                    <input type="text" class="form-control class-no-filter" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
            <div class="col-5">
                <div class="input-group mb-3 input-group-sm">
                    <button type="button" class="btn" id="liveToastBtn">修課時段</button>
                    <input id="selectedPeriods" class="form-control" placeholder="選擇修課時段" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
            <!-- 吐司 -->
            <div class="toast-container">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body">
                            選擇修課時段
                            <small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;星期-節次</small>
                            <!-- 關閉toast -->
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                            <!-- 這是 toast 主要內容的下方邊界，用來製造一個上邊界 -->
                            <div class="mt-2 pt-2 border-top">
                                <!--  這是一個容器，用來放置勾選框 -->
                                <div id="checkboxContainer" class="form-check form-check-inline"></div>
                            </div>
                            <button class="btn btn-secondary btn-sm" type="submit" onclick="showSelectedPeriods()" onclick="confirmSelection()">確認</button>
                        </div>
                </div>
            </div>
            
        </div>
    </div>

    <!--課程-->
    <p style="display: block; text-align: center;">搜尋結果，共有<span id="total-count"></span>筆符合</p>

    <hr>

    <nav>
        <ul class="pagination justify-content-center"></ul>
    </nav>

    <!-- 課程列表 -->
    <div id="course-list" class="course-container">
        <div id="course-nav" class="row rowtitle">
            <div class="col"><strong>課號</strong></div>
            <div class="col"><strong>課程名稱</strong></div>
            <div class="col"><strong>課別</strong></div>
            <div class="col"><strong>學分</strong></div>
            <div class="col"><strong>授課老師</strong></div>
            <div class="col"><strong>上課時段</strong></div>
            <div class="col"><strong>加入課表</strong></div>
        </div>
    </div>

    <br><br>
    <!-- 導航 + 頁碼按鈕 -->
    <nav>
        <ul class="pagination justify-content-center"></ul>
    </nav>

@endsection 