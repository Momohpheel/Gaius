<!DOCTYPE html>
<html>
<head>
    <title>McU Clinic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.13/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="{{url('css/main.css')}}">
    <link rel="stylesheet" href="{{url('css/sb-admin-2.css')}}" >
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.13/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.13/dist/js/uikit-icons.min.js"></script>


    <style type="text/css">
    body {
        --ck-z-default: 100;
        --ck-z-modal: calc( var(--ck-z-default) + 999 );
    }
    </style>
    @yield('head')
</head>
<body>
<div >

    <nav class="uk-navbar-container uk-visible@m" uk-navbar style="position: relative; z-index: 980; padding-top:10px;">
        <div class="uk-navbar-right" style="padding-right: 15px">
            <ul class="uk-navbar-nav">
                        <form action="/student/logout" method="post">
                            @csrf
                            <input class="uk-button uk-button-primary" type="submit" value="Logout">
                        </form>
            </ul>
        </div>
    </nav>
    <nav class="uk-navbar uk-navbar-container uk-margin uk-hidden@m" style="margin-top: 0px !important;margin-bottom: 0px">
         {{-- <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="#"><img src="/assets/images/mcl-logo.png" alt="" style="width: 140px"></a>
        </div> --}}
        <div class="uk-navbar-left">
            <a class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #offcanvas-nav-primary" style="color: #000"></a>
        </div>
        <div class="uk-navbar-center">

            <ul class="uk-navbar-nav">
                <li class="uk-active">
                    <a class="uk-navbar-item uk-logo" href="{{url('/')}}"  style="font-size: 30px"><img src="{{asset('img/logo1.png')}}" alt="" style="width: 140px"></a>
                </li>

            </ul>

        </div>

        <div class="uk-navbar-right" style="padding-right: 15px">
            <ul class="uk-navbar-nav">
                      <form action="/admin/logout" method="post">
                            @csrf
                            <input class="uk-button uk-button-primary" type="submit" value="Logout">
                        </form>

                 

            </ul>

        </div>
    </nav>
    <div id="offcanvas-nav-primary" uk-offcanvas="mode: push; overlay: true">
        <div class="uk-offcanvas-bar uk-flex uk-flex-column">

            <button class="uk-offcanvas-close" type="button" uk-close></button>
            <ul class="uk-nav uk-nav-default">
                <li class="uk-parent">
                    <ul class="uk-nav-sub">
                        <li style="background-color: #154D34;"><a href="{{url('/student/dashboard')}}"><ion-icon name="pie-chart-sharp"></ion-icon> <span class="side-menu-text">Dashboard</span></a></li>
                        <li><a href="{{url('/student/schedule-appointment')}}"><ion-icon name="cube-outline"></ion-icon>  <span class="side-menu-text">Schedule Appointment</span></a></li>
                        <li><a href="{{url('/student/appointments')}}"><ion-icon name="list"></ion-icon>  <span class="side-menu-text">Appointments</span></a></li>
                        <li><a href="{{url('/student/profile')}}"><ion-icon name="people"></ion-icon>  <span class="side-menu-text">Profile</span></a></li>
                       
                        {{-- --}}
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<div>
    <div uk-grid>
        <div class="uk-visible@m">
            <div class="side-menu">
                <ul class="uk-nav uk-nav-default">
                    <li class="uk-parent">
                        <ul class="uk-nav-sub">
                            <li style="background-color: #154D34;"><a href="{{url('/student/dashboard')}}"><ion-icon name="pie-chart-sharp"></ion-icon> <span class="side-menu-text">Dashboard</span></a></li>
                            <li><a href="{{url('/student/schedule-appointment')}}"><ion-icon name="cube-outline"></ion-icon>  <span class="side-menu-text">Schedule Appointment</span></a></li>
                            <li><a href="{{url('/student/appointments')}}"><ion-icon name="list"></ion-icon>  <span class="side-menu-text">Appointments</span></a></li>
                            <li><a href="{{url('/student/profile')}}"><ion-icon name="people"></ion-icon>  <span class="side-menu-text">Profile</span></a></li>
                       
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <div class="uk-visible@m" style="margin-left: 260px;width: 100%;min-height: 80vh;overflow-y: auto; ">
            <div style="padding-bottom: 20px" class="uk-container">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="uk-hidden@m" >
        <div class="uk-container">
            <br>
            <br>
            <div>
                @yield('content')
            </div>

        </div>
    </div>
    <br>
    <br>
    <div style="text-align: center;">© 2023 McUClinic</div>
    <br>
    <br>
</div>


<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
@yield('foot')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
