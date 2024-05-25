@extends('layouts/header')

@section('head')

<link rel="stylesheet" href="{{asset('css/course_dashboard.css')}}">
@yield('other-head')

@endsection

<title>Pro^2 NCU - @yield('title')</title>

@section('main')



@yield('upper_body')

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
@yield('lower_body')



@endsection