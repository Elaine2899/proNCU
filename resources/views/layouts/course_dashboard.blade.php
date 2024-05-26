@extends('layouts/header')

@section('head')

<link rel="stylesheet" href="{{asset('css/course_dashboard.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('other-head')

@endsection

<title>Pro^2 NCU - @yield('title')</title>

@section('main')



@yield('upper_body')

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

<script src="{{asset('js/home_dashboard.js')}}"></script>
            
@yield('lower_body')



@endsection