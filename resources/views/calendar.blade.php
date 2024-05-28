@extends('layouts/header')

@section('head')

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/calendar.css')}}">



@endsection

@section('title', '行事曆')

@section('main')

<div class="calendar">
        <div class="month-header d-flex justify-content-between align-items-center">
            <div id="month-year" class="text-center flex-grow-1"></div>
            <div class="month-changers d-flex">
                <div class="month-change" id="prev-month">&lt;</div>
                &nbsp;&nbsp;&nbsp;
                <div class="month-change" id="next-month">&gt;</div>
            </div>
        </div>
        <div class="weekdays">
            <div>週一</div>
            <div>週二</div>
            <div>週三</div>
            <div>週四</div>
            <div>週五</div>
            <div>週六</div>
            <div>週日</div>
        </div>
        <hr>
        <div class="days-grid" id="days-grid">
            <div>
                <div class="day-content"></div>
                <div class="events-container">
                    <!-- 事件動態添加到這裡 -->
                </div>
            </div>
            <!-- 重複上面的結構來表示其他日期 -->
        </div>
    </div>
    <!-- Event Modal -->
    <div id="eventModal"
        style="display:none; position: fixed; left: 50%; top: 50%; transform: translate(-50%, -50%); background: #EDE0D4; padding: 40px; border-radius: 10px; z-index: 1000; width: 400px; box-shadow: 0 0 15px #414833;">
        <button onclick="closeModal()" style="position: absolute; right: 10px; top: 10px;">&times;</button>
        <h3 style="padding-right: 30px; font-size: 25px;">加入事件</h3>
        <div id="eventList" style="margin-bottom: 20px;"></div>
        <input type="text" id="newEventText" placeholder="輸入" style="width: 100%; margin-bottom: 10px;" />
        <!-- <button onclick="addNewEvent()">加入</button> -->
    </div>
    </div>

<script src= "{{asset('js/calendar.js')}}"></script>

@endsection