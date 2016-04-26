<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title or '404 Error Page' }}</title>

    <link rel="shortcut icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico/favicon-16x16.png') }}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset( 'bootstrap/css/bootstrap.min.css' ) }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset( 'font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset( 'ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset( 'sweetalert/sweetalert.css' ) }}">

    <link rel="stylesheet" href="{{ asset( 'datepicker/datepicker3.css' ) }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset( 'css/AdminLTE.css' ) }}">


    <link rel="stylesheet" href="{{ asset( 'css/style.css' ) }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset( 'css/skins/_all-skins.min.css' ) }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset( 'iCheck/flat/blue.css' ) }}">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('admin') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>NS</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Nepal</b> Scout</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset( 'img/user2-160x160.jpg' ) }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->f_name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset( 'img/user2-160x160.jpg' ) }}" class="img-circle" alt="User Image">
                                <p>
                                    {{ Auth::user()->f_name }} {{ Auth::user()->l_name  }}
                                    <small>@if (Auth::user()->created_at != null) {{ 'Member since ' . Auth::user()->created_at->toFormattedDateString() }} @endif</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url( '/logout' ) }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i>Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            {{--<div class="user-panel">--}}
                {{--<div class="pull-left image">--}}
                    {{--<img src="{{ asset( 'img/user2-160x160.jpg' ) }}" class="img-circle" alt="User Image">--}}
                {{--</div>--}}
                {{--<div class="pull-left info">--}}
                    {{--<p>Alexander Pierce</p>--}}
                    {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li{!! Request::path() == 'admin/form' ? ' class="active"': '' !!}>
                    <a href=" {{ url('admin/form') }}">
                        <i class="fa fa-envelope"></i> <span>Form Requests</span>
                        @if($unregistered_registration_no > 0)
                            <small class="label pull-right bg-yellow">{{ $unregistered_registration_no }}</small>
                        @endif

                    </a>
                </li>

                <li{!! Request::path() == 'rate' ? ' class="active"' : '' !!}>
                    <a href="{{ url('rate') }}">
                        <i class="fa fa-calculator"></i> <span>Rates</span>
                    </a>
                </li>

                <li{!! Request::path() == 'districts' ? ' class="active"': '' !!}>
                    <a href="{{ url('districts') }}">
                        <i class="fa fa-compass"></i> <span>Districts</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')

    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>Copyright &copy; {{ Carbon\Carbon::now()->year }} <a href="http://www.nepalscouts.org.np">Nepal Scout</a>.</strong> All rights reserved.
    </footer>

</div><!-- ./wrapper -->
@section('scripts')
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset( 'jQuery/jQuery-2.1.4.min.js' ) }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset( 'jQueryUI/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset( 'bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset( 'datepicker/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset( 'sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset( 'slimScroll/jquery.slimscroll.min.js' ) }}"></script>
    <!-- FastClick -->
    <script src="{{ asset( 'fastclick/fastclick.min.js' ) }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset( 'js/app.min.js' ) }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{--<script src="{{ asset( 'js/pages/dashboard.js' ) }}"></script>--}}
    <!-- AdminLTE for demo purposes -->
    {{--<script src="{{ asset( 'js/demo.js') }}"></script>--}}
    <script src="{{ asset( 'sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{  asset('input-mask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset( 'js/jquery.validate.js') }}"></script>
    <script src="{{ asset( 'js/admin.js') }}"></script>

@show
</body>
</html>