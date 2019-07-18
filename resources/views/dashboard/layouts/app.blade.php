<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{config('app.name')}} | @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/material-dashboard.css')}}?v=2.1.0" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('css/cryptofont.min.css')}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css"/>
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="black"
         data-image="{{asset('assets/img/sidebar-3.jpg')}}">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="{{route('index')}}" class="simple-text logo-mini">
                {{config('app.short_name')}}
            </a>
            <a href="{{route('index')}}" class="simple-text logo-normal">
                {{config('app.name')}}
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="{{Auth::user()->getGravatarAttribute()}}"/>
                </div>
                <div class="user-info">
                    <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                {{Auth::user()->getFullNameAttribute()}}
                <b class="caret"></b>
              </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('dashboard.user.profile.index')}}">
                                    <span class="sidebar-mini"> <i class="fa fa-user"></i> </span>
                                    <span class="sidebar-normal"> Profilim </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('dashboard.user.settings.index')}}">
                                    <span class="sidebar-mini"> <i class="fa fa-cog"></i> </span>
                                    <span class="sidebar-normal"> Ayarlar </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="logout()" href="#">
                                    <span class="sidebar-mini"> <i class="fa fa-sign-out"></i> </span>
                                    <span class="sidebar-normal"> Çıkış </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item {{ (\URL::current() == route('dashboard.index')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('dashboard.index')}}">
                        <i class="material-icons">dashboard</i>
                        <p> Anasayfa</p>
                    </a>
                </li>
                <li class="nav-item {{ (\Request::segment(2) == 'exchange') ? 'active' : '' }}">
                    <a class="nav-link {{ (\Request::segment(2) == 'exchange') ? 'collapsed' : '' }}" aria-expanded="{{ (\Request::segment(2) == 'exchange') ? 'true' : 'false' }}" data-toggle="collapse" href="#exchangeMenu">
                        <i class="fa fa-exchange"></i>
                        <p> Borsalar
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (\Request::segment(2) == 'exchange') ? 'show' : '' }}" id="exchangeMenu">
                        <ul class="nav">
                            @foreach(Template::getExchangeMenu() as $exchangeMenuGroups)
                            <li class="nav-item {{ (\Request::segment(4) == $exchangeMenuGroups[0]->currency_selling_short_name) ? 'active' : '' }}">
                                <a class="nav-link {{ (\Request::segment(4) == $exchangeMenuGroups[0]->currency_selling_short_name) ? 'collapsed' : '' }}" aria-expanded="{{ (\Request::segment(4) == $exchangeMenuGroups[0]->currency_selling_short_name) ? 'true' : 'false' }}" data-toggle="collapse" href="#exchangeMenu{{$exchangeMenuGroups[0]->currency_selling_short_name}}">
                                    <span class="sidebar-mini"> <i class="{{$exchangeMenuGroups[0]->currency_selling_icon}}"></i> </span>
                                    <span class="sidebar-normal"> {{$exchangeMenuGroups[0]->currency_selling_long_name}}
                                        <b class="caret"></b>
                                    </span>
                                </a>
                                <div class="collapse {{ (\Request::segment(4) == $exchangeMenuGroups[0]->currency_selling_short_name) ? 'show' : '' }}" id="exchangeMenu{{$exchangeMenuGroups[0]->currency_selling_short_name}}">
                                    <ul class="nav">
                                        @foreach($exchangeMenuGroups as $exchangeMenuGroup)
                                        <li class="nav-item {{ (\URL::current() == route('dashboard.exchange.index',['currency_buying_name'=>$exchangeMenuGroup->currency_buying_name,'currency_selling_name'=>$exchangeMenuGroup->currency_selling_name])) ? 'active' : '' }}">
                                            <a class="nav-link" href="{{route('dashboard.exchange.index',['currency_buying_name'=>$exchangeMenuGroup->currency_buying_name,'currency_selling_name'=>$exchangeMenuGroup->currency_selling_name])}}">
                                                <span class="sidebar-mini"> <i class="{{$exchangeMenuGroup->currency_buying_icon}}"></i> </span>
                                                <span class="sidebar-normal"> {{$exchangeMenuGroup->currency_buying_name.' / '.$exchangeMenuGroup->currency_selling_name}} </span>
                                            </a>
                                        </li>
                                            @endforeach
                                    </ul>
                                </div>

                            </li>
                                @endforeach
                        </ul>
                    </div>


                </li>
                <li class="nav-item {{ (\Request::segment(3) == 'balance') ? 'active' : '' }}">
                    <a class="nav-link {{ (\Request::segment(3) == 'balance') ? 'collapsed' : '' }}" aria-expanded="{{ (\Request::segment(3) == 'balance') ? 'true' : 'false' }}" data-toggle="collapse" href="#balanceMenu">
                        <i class="material-icons">attach_money</i>
                        <p> Varlık Yönetimi
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (\Request::segment(3) == 'balance') ? 'show' : '' }}" id="balanceMenu">
                        <ul class="nav">
                            <li class="nav-item {{ (\URL::current() == route('dashboard.user.balance.local.index')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('dashboard.user.balance.local.index')}}">
                                    <span class="sidebar-mini"> <i class="fa fa-money"></i> </span>
                                    <span class="sidebar-normal"> Yerel Varlık Yönetimi </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (\URL::current() == route('dashboard.user.balance.crypto.index')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('dashboard.user.balance.crypto.index')}}">
                                    <span class="sidebar-mini">  <i class="material-icons">memory</i> </span>
                                    <span class="sidebar-normal"> Kripto Varlık Yönetimi </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (\Request::segment(3) == 'activity') ? 'active' : '' }}">
                    <a class="nav-link {{ (\Request::segment(3) == 'activity') ? 'collapsed' : '' }}" aria-expanded="{{ (\Request::segment(3) == 'activity') ? 'true' : 'false' }}" data-toggle="collapse" href="#activityMenu">
                        <i class="material-icons">accessibility</i>
                        <p> Faliyetlerim
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (\Request::segment(3) == 'activity') ? 'show' : '' }}" id="activityMenu">
                        <ul class="nav">
                            <li class="nav-item {{ (\URL::current() == route('dashboard.user.activity.account.index')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('dashboard.user.activity.account.index')}}">
                                    <span class="sidebar-mini">   <i class="material-icons">assignment</i> </span>
                                    <span class="sidebar-normal"> Hesap Faliyetlerim </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (\URL::current() == route('dashboard.user.activity.financial.index')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('dashboard.user.activity.financial.index')}}">
                                    <span class="sidebar-mini"> <i class="material-icons">account_balance_wallet</i> </span>
                                    <span class="sidebar-normal"> Finansal Faliyetlerim </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (\URL::current() == route('dashboard.user.profile.index')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('dashboard.user.profile.index')}}">
                        <i class="fa fa-user"></i>
                        <p> Profilim </p>
                    </a>
                </li>
                <li class="nav-item {{ (\URL::current() == route('dashboard.user.settings.index')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('dashboard.user.settings.index')}}">
                        <i class="fa fa-cog"></i>
                        <p> Ayarlar </p>
                    </a>
                </li>
                <li class="nav-item {{ (\Request::segment(3) == 'ticket') ? 'active' : '' }}">
                    <a class="nav-link {{ (\Request::segment(3) == 'ticket') ? 'collapsed' : '' }}" aria-expanded="{{ (\Request::segment(3) == 'ticket') ? 'true' : 'false' }}" data-toggle="collapse" href="#ticketMenu">
                        <i class="fa fa-ticket"></i>
                        <p> Destek
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (\Request::segment(3) == 'ticket') ? 'show' : '' }}" id="ticketMenu">
                        <ul class="nav">
                            <li class="nav-item {{ (\URL::current() == route('dashboard.user.ticket.create')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('dashboard.user.ticket.create')}}">
                                    <span class="sidebar-mini">   <i class="material-icons">open_in_new</i> </span>
                                    <span class="sidebar-normal"> Destek Talebi Oluştur </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (\URL::current() == route('dashboard.user.ticket.index')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('dashboard.user.ticket.index')}}">
                                    <span class="sidebar-mini"> <i class="material-icons">event_note</i> </span>
                                    <span class="sidebar-normal"> Destek Taleplerim </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <div class="user"></div>
                <li class="nav-item {{ (\URL::current() == route('announcement.index')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('announcement.index')}}">
                        <i class="fa fa-bullhorn"></i>
                        <p> Duyurular </p>
                    </a>
                </li>
                <li class="nav-item {{ (\URL::current() == route('blog.index')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('blog.index')}}">
                        <i class="fa fa-rss"></i>
                        <p> Blog </p>
                    </a>
                </li>
                <li class="nav-item {{ (\URL::current() == route('support.index')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('support.index')}}">
                        <i class="fa fa-clipboard"></i>
                        <p> Destek </p>
                    </a>
                </li>
                <li class="nav-item {{ (\URL::current() == route('contact.index')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('contact.index')}}">
                        <i class="fa fa-address-card"></i>
                        <p> İletişim </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">@yield('title')</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="material-icons">dashboard</i>
                                <p class="d-lg-none d-md-block">
                                    Stats
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p class="d-lg-none d-md-block">
                                    Some Actions
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Mike John responded to your email</a>
                                <a class="dropdown-item" href="#">You have 5 new tasks</a>
                                <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                                <a class="dropdown-item" href="#">Another Notification</a>
                                <a class="dropdown-item" href="#">Another One</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Hesap
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="{{route('dashboard.user.profile.index')}}">Profilim</a>
                                <a class="dropdown-item" href="{{route('dashboard.user.settings.index')}}">Ayarlar</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="logout()" href="#">Çıkış</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            @yield('content')
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="{{route('dashboard.index')}}">
                                {{config('app.name')}}
                            </a>
                        </li>
                        <li>
                            <a href="https://creative-tim.com/presentation">
                                Duyurular
                            </a>
                        </li>
                        <li>
                            <a href="{{route('blog.index')}}">
                                Destek
                            </a>
                        </li>
                        <li>
                            <a href="{{route('blog.index')}}">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="{{route('blog.index')}}">
                                İletişim
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, {{__('home.copyright')}} <a href="{{route('dashboard.index')}}" target="_blank">{{config('app.name')}}</a>
                </div>
            </div>
        </footer>
    </div>
</div>
<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title"> Sidebar Filters</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                    <div class="badge-colors ml-auto mr-auto">
                        <span class="badge filter badge-purple" data-color="purple"></span>
                        <span class="badge filter badge-azure" data-color="azure"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-warning" data-color="orange"></span>
                        <span class="badge filter badge-danger" data-color="danger"></span>
                        <span class="badge filter badge-rose active" data-color="rose"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Sidebar Background</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="ml-auto mr-auto">
                        <span class="badge filter badge-black active" data-background-color="black"></span>
                        <span class="badge filter badge-white" data-background-color="white"></span>
                        <span class="badge filter badge-red" data-background-color="red"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Sidebar Mini</p>
                    <label class="ml-auto">
                        <div class="togglebutton switch-sidebar-mini">
                            <label>
                                <input type="checkbox">
                                <span class="toggle"></span>
                            </label>
                        </div>
                    </label>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Sidebar Images</p>
                    <label class="switch-mini ml-auto">
                        <div class="togglebutton switch-sidebar-image">
                            <label>
                                <input type="checkbox" checked="">
                                <span class="toggle"></span>
                            </label>
                        </div>
                    </label>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Images</li>
            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="{{asset('assets/img/sidebar-1.jpg')}}" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="{{asset('assets/img/sidebar-2.jpg')}}" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="{{asset('assets/img/sidebar-3.jpg')}}" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="{{asset('assets/img/sidebar-4.jpg')}}" alt="">
                </a>
            </li>
            <li class="button-container">
                <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank"
                   class="btn btn-rose btn-block btn-fill">Buy Now</a>
                <a href="https://demos.creative-tim.com/material-dashboard-pro/docs/2.1/getting-started/introduction.html"
                   target="_blank" class="btn btn-default btn-block">
                    Documentation
                </a>
                <a href="https://www.creative-tim.com/product/material-dashboard" target="_blank"
                   class="btn btn-info btn-block">
                    Get Free Demo!
                </a>
            </li>
            <li class="button-container github-star">
                <a class="github-button" href="https://github.com/creativetimofficial/ct-material-dashboard-pro"
                   data-icon="octicon-star" data-size="large" data-show-count="true"
                   aria-label="Star ntkme/github-buttons on GitHub">Star</a>
            </li>
            <li class="header-title">Thank you for 95 shares!</li>
            <li class="button-container text-center">
                <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45
                </button>
                <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50
                </button>
                <br>
                <br>
            </li>
        </ul>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!-- Plugin for the momentJs  -->
<script src="{{asset('assets/js/plugins/moment.min.js')}}"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{asset('assets/js/plugins/sweetalert2.js')}}"></script>
<!-- Forms Validations Plugin -->
<script src="{{asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('assets/js/plugins/bootstrap-tagsinput.js')}}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{asset('assets/js/plugins/jquery-jvectormap.js')}}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('assets/js/plugins/nouislider.min.js')}}"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{asset('assets/js/plugins/arrive.min.js')}}"></script>
<!-- Chartist JS -->
<script src="{{asset('assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/material-dashboard.js')}}?v=2.1.0" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/demo/demo.js')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/plugins/dropzone.js')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="https://browser.sentry-cdn.com/4.6.4/bundle.min.js" crossorigin="anonymous"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
<!--  SocketIO Plugin    -->
<script src="{{asset('assets/js/plugins/socket.io.js')}}"></script>


<script>
    Sentry.init({ dsn: '{{env('SENTRY_VIEW_DSN')}}' });

    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function (event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function () {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function () {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function () {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function () {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function () {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

        md.initVectorMap();

    });
</script>
<script>

    function logout() {
        $.ajax({
            type: "POST",
            url: '{{route('logout')}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            datatype: 'json',
            success: function (data) {
                $.notify({
                    icon: "add_alert",
                    message: "{{__('auth.logout_message')}}"

                }, {
                    type: 'success',
                    timer: 3000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
                window.location.href = "{{route('index')}}";
            },
            error: function (data) {
                var data = eval('(' + data.responseText + ')');

                for (datos in data['errors']) {
                    $.notify({
                        icon: "add_alert",
                        message: data['errors'][datos],

                    }, {
                        type: 'warning',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });
                }
                toastr['error']('İşlem sırasında hata.');
            },
        });

    };
</script>

@yield('css')
@yield('script')

</body>

</html>
