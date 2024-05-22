@extends('layouts/header')

@section('head')

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/course_table.css')}}">

@endsection

@section('title', '我的課表')

@section('main')

    <!--navbar-->
    <nav class="nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link" href="course_1.html">課程查詢</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="course_dashBoard.html">學分儀表板</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="course_table.html">我的課表</a>
        
    </nav>

    <!--選擇學期-->
    <div class="row justify-content-center">
      <div class="col-md-2" style="text-align: center; margin: 30px;">
        <p>選擇查詢學期</p>
        <select class="form-select form-select-sm" aria-label="Small select example">
            <option selected>112-2學期</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">"</option>
        </select>
      </div>
    </div>

  <!--課表-->
  <div class="row justify-content-center">
    <div class="col-10">
    <table class="table table-bordered">
        <table class="table">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">日</th>
                <th scope="col">一</th>
                <th scope="col">二</th>
                <th scope="col">三</th>
                <th scope="col">四</th>
                <th scope="col">五</th>
                <th scope="col">六</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td></td>
                <td></td>
                <td></td>
                <td>經濟學<br>張李治華<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td>統計學<br>邱信瑜<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td></td>
                <td></td>
                <td></td>
                <td>經濟學<br>張李治華<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td>統計學<br>邱信瑜<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td></td>
                <td></td>
                <td></td>
                <td>經濟學<br>張李治華<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td>統計學<br>邱信瑜<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">z</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td></td>
                <td></td>
                <td></td>
                <td>爵士舞<br>沈淑貞<br>YH-韻律<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">6</th>
                <td></td>
                <td>網頁程式設計<br>簡宇泰<br>I1-405-1<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td>企業資料通訊<br>李俊傑<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td>爵士舞<br>沈淑貞<br>YH-韻律<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td>資料庫管理<br>柯士文<br>I-204<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">7</th>
                <td></td>
                <td>網頁程式設計<br>簡宇泰<br>I1-405-1<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td>企業資料通訊<br>李俊傑<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td>資料庫管理<br>柯士文<br>I-204<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">8</th>
                <td></td>
                <td>網頁程式設計<br>簡宇泰<br>I1-405-1<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td>企業資料通訊<br>李俊傑<br>I1-017<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td>資料庫管理<br>柯士文<br>I-204<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">9</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">A</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>認識地球<br>顏宏元<br>TR-A203<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">B</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>認識地球<br>顏宏元<br>TR-A203<button class="btn btn-danger btn-sm cancel-btn">移除課程</button></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">C</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
    </table>
    </div>
  </div>


@endsection