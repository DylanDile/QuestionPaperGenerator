<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/favi.ico')}}">
    <title>TTGenerator</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}">
    <!--[if lt IE 9]>
    <script src="{{asset('frontend/assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/respond.min.js')}}"></script>
    <![endif]-->
    @yield('styles')
</head>

<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="{{route('home')}}" class="logo">
                <img src="{{asset('frontend/assets/img/clock.png')}}" width="20" height="20" alt="">&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;<span><strong><h2>TTGen</h2></strong></span>
            </a>
        </div>
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{asset('frontend/assets/img/user.jpg')}}" width="24"
                                 alt="Admin">
                            <span class="status online"></span>
                        </span>
                    <span>{{auth()->user()->name}}</span>
                </a>
                <div class="dropdown-menu">
                    <i class="status-orange">Role: 
                         @if(auth()->user()->isAdmin)
                           @php
                            echo "Admin";
                            @endphp
                         @else
                            @php
                            echo "Student";
                            @endphp
                         @endif                         
                    </i>
                    <a class="dropdown-item custom-badge badge-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    {{-- Start lists --}}
                    <li class="menu-title">Main</li>
                    <li class="active">
                        <a href="{{ route('home') }}"><i class="fa fa-dashboard text-warning"></i> <span>Dashboard</span></a>
                    </li>
                    @if(auth()->user()->isAdmin)
                    <li class="submenu">
                        <a href="#"><i class="fa fa-tasks text-warning"></i> <span>Add Questions</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('admin.addMutlipleChoiceQuestion') }}"><i class="fa fa-file-excel-o text-warning"></i><span>Multiple Choice</span></a>
                            </li>        
                             <li><a href="{{ route('admin.addStructuredQuestion') }}"><i class="fa fa-file-excel-o text-warning"></i><span>Structured Questions</span></a>
                            </li>                      
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-flag-o text-warning"></i> <span> View Questions </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('questions.multipleChoice') }}"><i class="fa fa-bars text-warning"></i> <span>&nbsp;Multiple Choice</span></a>
                            </li>
                            <li><a href="{{ route('questions.structured') }}"><i class="fa fa-bars text-warning"></i> <span>&nbsp;Structured</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-flag-o text-warning"></i> <span> Generate Question Ppr </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('admin.genMultipleChoice') }}"><i class="fa fa-bars text-warning"></i> <span>&nbsp;Generate Paper</span></a>
                            </li>
                            <li><a href="{{ route('admin.viewGeneratedPapers') }}"><i class="fa fa-bars text-warning"></i> <span>&nbsp;Generated Papers</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li class="submenu">
                        <a href="#"><i class="fa fa-flag-o text-warning"></i> <span>Tests </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('student.skills.test') }}"><i class="fa fa-bars text-warning"></i> <span>&nbsp;Skills Test</span></a>
                            </li>
                            <li><a href="{{ route('student.test.results') }}"><i class="fa fa-bars text-warning"></i> <span>&nbsp;Test Results</span></a>
                            </li>
                        </ul>
                    </li>

                    {{-- End lists --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="page-wrapper">         
        <div class="content">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="{{asset('frontend/assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('frontend/assets/js/Chart.bundle.js')}}"></script>
<script src="{{asset('frontend/assets/js/chart.js')}}"></script>
<script src="{{asset('frontend/assets/js/app.js')}}"></script>
@yield('javascripts')
</body>
</html>
