@extends('layouts/header')

@section('head')

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/course_dashboard.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection

@section('title', '學分儀錶板')

@section('main')

     <!--圓形圖-->
     <div class="container">
        <div class="row">
            <div class="col-5 p-4 justify-content-center align-items-center d-flex" style="position: relative;">
                <h3 id="dashBoard_h3" style="margin: 0;" class="text-center">已修得總學分 <br>77 / 128</h3>
                <canvas class="align-self-center" style="z-index: 1;" id="myDonutChart" width="300" height="300"></canvas>
            </div>
            <!--分布bars-->
            <div class="col-7 vstack gap-3 align-self-center" style="padding: 4rem;">
                <div >
                <div class="progress-parts">
                    <p>必修</p>
                    <div class="progress" role="progressbar"  aria-valuenow="44" aria-valuemin="0" aria-valuemax="86">
                        <div class="progress-bar bg-secondary" style="width: 52%">44/86</div>
                    </div>
                </div></div>
            
                <div >
                <div class="progress-parts">
                    <p>系選修</p>  
                    <div class="progress" role="progressbar"  aria-valuenow="9" aria-valuemin="0" aria-valuemax="16">
                        <div class="progress-bar bg-secondary " style="width: 56%">9/16</div>
                    </div>
                </div></div>
                
                <div>
                    <div class="progress-parts">
                        <p>通識</p>  
                        <div class="progress" role="progressbar"  aria-valuenow="10" aria-valuemin="0" aria-valuemax="14">
                            <div class="progress-bar bg-secondary " style="width: 71%">10/14</div>
                        </div>
                    </div></div>
                
                <div>
                    <div class="progress-parts">
                    <p>外系選修</p>  
                        <div class="progress" role="progressbar" aria-valuenow="9" aria-valuemin="0" aria-valuemax="12">
                            <div class="progress-bar bg-secondary" style="width: 75%">9/12</div>
                        </div>
                    </div>
                </div>
            
                <div>
                    <div class="progress-parts">
                    <p>體育</p>  
                        <div class="progress" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5">
                            <div class="progress-bar bg-secondary" style="width: 60%">3/5</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--下拉選累計學期-->
    <div class="container justify-content-center d-flex p-4">
        <select class="form-select form-select-sm align-self-center" style="width: 20em;">
            <option selected>計算至112-2學期</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
    
    <script>
        var ctx = document.getElementById('myDonutChart').getContext('2d');
        var myDonutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                
                datasets: [{
                    label: 'Completion',
                    data: [60, 40], // 完成度為 60%
                    backgroundColor: [
                        'rgb(110,109,74,0.8)',
                        'rgb(65,72,51,0.3)',
                    ],
                    borderColor: [
                        'rgb(110,109,74,0.8)',
                        'rgb(65,72,51,0.3)',
                    ],
                    
                    borderWidth: 1,
                    
                }]
            },
            options: {
                cutout: '90%', // 中間空白部分的大小
            },
            plugins: {
                    tooltip: {
                        enabled: false
                    },
                    legend: {
                        display: false
                    }
            }
        });

    </script>

    <!--歷年課程-->
    <h4 class="dashBoard_class_h4" style="display: block; text-align: center; color: #ede0d4; background-color: #656d4a; padding: 10px; width: 95%;">歷年課程</h4>
    
    <div class="courses">
        <div class="section" id="必修">
            <h4 class="dashBoard_class_h4">必修</h4>
            <div class="row dashBoard_class_row rowtitle">
                    <div class="col"><strong>課號</strong></div>
                    <div class="col"><strong>課程名稱</strong></div>
                    <div class="col"><strong>學分</strong></div>
                    <div class="col"><strong>授課老師</strong></div>
                    <div class="col"><strong>修課學期</strong></div>
                    <div class="col"><strong>更改課別</strong></div>
            </div>
            <div class="row dashBoard_class_row" id="001">
                    <div class="col">001</div>
                    <div class="col">經濟學</div>
                    <div class="col">3</div>
                    <div class="col">張李治華</div>
                    <div class="col">112-1</div>
                    <div class="col">--</div>
            </div>
            <div class="row dashBoard_class_row" id="002">
                    <div class="col">002</div>
                    <div class="col">資料庫管理</div>
                    <div class="col">3</div>
                    <div class="col">喬治</div>
                    <div class="col">112-2</div>
                    <div class="col">--</div>
            </div>               
        </div>
        <div class="section" id="系選修">
            <h4 class="dashBoard_class_h4">系選修</h4>
            <div class="row dashBoard_class_row" id="003">
                    <div class="col">003</div>
                    <div class="col">python</div>
                    <div class="col">2</div>
                    <div class="col">邱信瑜</div>
                    <div class="col">112-1</div>
                    <div class="col">--</div>
            </div>
        </div>
        <div class="section" id="通識">         
            <h4 class="dashBoard_class_h4">通識</h4>
            <div class="row dashBoard_class_row" id="004">
                <div class="col">004</div>
                <div class="col">普通心理學</div>
                <div class="col">2</div>
                <div class="col">謝宜慧</div>
                <div class="col">111-2</div>
                <div class="col">    
                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">更改課別</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" onclick="moveRow(event, '通識')">通識</a></li>
                                <li><a class="dropdown-item" onclick="moveRow(event, '外系選修')">外系選修</a></li>
                            </ul>
                    </div>
                </div>
            </div>    
            <div class="row dashBoard_class_row" id="005">
                <div class="col">005</div>
                <div class="col">認識地球</div>
                <div class="col">2</div>
                <div class="col">顏宏元</div>
                <div class="col">112-2</div>
                <div class="col">
                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">更改課別</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" onclick="moveRow(event, '通識')">通識</a></li>
                                <li><a class="dropdown-item" onclick="moveRow(event, '外系選修')">外系選修</a></li>
                            </ul>
                    </div>
                </div>
            </div>    
        </div>
        <div class="section" id="外系選修">
            <h4 class="dashBoard_class_h4">外系選修</h4>
            <div class="row dashBoard_class_row" id="006">
                <div class="col">006</div>
                <div class="col">日文(一)A</div>
                <div class="col">3</div>
                <div class="col">洪韶翎</div>
                <div class="col">111-2</div>
                <div class="col">--</div>
            </div>
            <div class="row dashBoard_class_row" id="007">
                <div class="col">007</div>
                <div class="col">日文(一)A</div>
                <div class="col">3</div>
                <div class="col">洪韶翎</div>
                <div class="col">111-2</div>
                <div class="col">--</div>
            </div>
        </div>
        <div class="section" id="體育">
            <h4 class="dashBoard_class_h4">體育</h4>
            <div class="row dashBoard_class_row" id="00">
                <div class="col">00</div>
                <div class="col">大一體育</div>
                <div class="col">0</div>
                <div class="col">余宏群</div>
                <div class="col">111-1</div>
                <div class="col">--</div>
            </div>
        </div>
    </div>



    <script> //更改課別
        function moveRow(event, newCategory) {
            event.preventDefault();
    
            // 獲取事件目標的最接近的 row 元素
            const row = event.target.closest('.row');
            const newCategorySection = document.getElementById(newCategory);
    
            if (!row) {
                console.error("Row element not found");
                return;
            }
    
            if (!newCategorySection) {
                console.error(`New category section with id ${newCategory} not found`);
                return;
            }
    
            newCategorySection.appendChild(row);
        }
    </script>    

@endsection