@extends('layouts/header')

@section('head')

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('css/course_table.css')}}"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <script src= "{{asset('js/course_table.js')}}"></script>

@endsection

@section('title', '我的課表')

@section('main')

 <!--選擇學期-->
 <div class="row justify-content-center">
      <div class="col-md-2" style="text-align: center; margin: 30px;">
        <p>112-2</p>
        <!-- <select id="semester" class="form-select form-select-sm" aria-label="Small select example">
            <option value="0" selected>請選擇學期</option>
            <option value="112-2">112-2</option>
            <option value="113-1">113-1</option>
        </select> -->
      </div>
    </div>

    <!-- 課表部分 -->
    <div class="row justify-content-center mt-3">
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">ㄧ</th>
                        <th scope="col">二</th>
                        <th scope="col">三</th>
                        <th scope="col">四</th>
                        <th scope="col">五</th>
                        <th scope="col">六</th>
                        <th scope="col">日</th>
                    </tr>
                </thead>
                <tbody id = "course_grid">
                    <!-- 這裡可以動態填入課程資料 -->
                </tbody>
            </table>
        </div>
    </div>


    <script> //按移除課程會從課表上消失
      document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll('.cancel-btn');
        
        buttons.forEach(button => {
          button.addEventListener('click', function() {
            const cell = button.parentElement;
            const courseName = cell.innerHTML.split('<br>')[0].trim();
            
            const cells = document.querySelectorAll('td');
            cells.forEach(td => {
              if (td.innerHTML.includes(courseName)) {
                td.innerHTML = '';
              }
            });
          });
        });
      });
    </script>

@endsection