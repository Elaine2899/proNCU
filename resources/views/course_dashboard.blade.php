@extends('layouts/header')

@section('head')

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/course_dashboard.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('title', '學分儀錶板')

@section('main')

    <!-- 圓形圖和進度條 -->
    <div class="container">
        <div class="row">
            <!-- 圓形圖 -->
            <div class="col-5 p-4 justify-content-center align-items-center d-flex" style="position: relative;">
                <h3 id="dashBoard_h3" style="margin: 0;" class="text-center">已修得總學分 <br></h3>
                <canvas id="myDonutChart" class="align-self-center" style="z-index: 1;" width="300" height="300"></canvas>
            </div>
            
            <!-- 進度條 -->
            <div class="col-7 vstack gap-3 align-self-center" style="padding: 4rem;">
                <div id="progress-required">
                    <div class="progress-parts">
                        <p>必修</p>
                        <div class="progress" role="progressbar">
                            <div class="progress-bar bg-secondary" id="必修-bar"></div>
                        </div>
                    </div>
                </div>
    
                <div id="progress-dept-elective">
                    <div class="progress-parts">
                        <p>系選修</p>  
                        <div class="progress" role="progressbar">
                            <div class="progress-bar bg-secondary" id="系選修-bar"></div>
                        </div>
                    </div>
                </div>
    
                <div id="progress-general">
                    <div class="progress-parts">
                        <p>通識</p>  
                        <div class="progress" role="progressbar">
                            <div class="progress-bar bg-secondary" id="通識-bar"></div>
                        </div>
                    </div>
                </div>
    
                <div id="progress-non-dept-elective">
                    <div class="progress-parts">
                        <p>外系選修</p>  
                        <div class="progress" role="progressbar">
                            <div class="progress-bar bg-secondary" id="外系選修-bar"></div>
                        </div>
                    </div>
                </div>
    
                <div id="progress-pe">
                    <div class="progress-parts">
                        <p>體育</p>  
                        <div class="progress" role="progressbar">
                            <div class="progress-bar bg-secondary" id="體育-bar"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- 下拉選累計學期 -->
    <div class="container justify-content-center d-flex p-4">
        <select class="form-select form-select-sm align-self-center" style="width: 20em;">
            <option selected>計算至112-2學期</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>

    <!-- 歷年課程 -->
    <h4 class="dashBoard_class_h4" style="display: block; text-align: center; color: #ede0d4; background-color: #656d4a; padding: 10px; width: 95%;">歷年課程</h4>
    
    <div id="course-list">
        <!-- 課程列表會在這裡生成 -->
    </div>
    
    <script src="{{asset('js/course_dashboard.js')}}"></script>

@endsection