<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nepal Scout</title>

    <link rel="shortcut icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico/favicon-16x16.png') }}">


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset( 'bootstrap/css/bootstrap.min.css' ) }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset( 'font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset( 'ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset( 'sweetalert/sweetalert.css' ) }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset( 'css/AdminLTE.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'datepicker/datepicker3.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'css/style.css' ) }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset( 'css/skins/_all-skins.min.css' ) }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ url('/') }}" class="navbar-brand"><b>Nepal</b> Scout</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    {{--<form class="navbar-form navbar-left" role="search">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" class="form-control" id="navbar-search-input" placeholder="Search" name="search">--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div><!-- /.navbar-collapse -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications Menu -->
                        {{--<li class="dropdown notifications-menu">--}}
                            {{--<!-- Menu toggle button -->--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                {{--<i class="fa fa-bell-o"></i>--}}
                                {{--<span class="label label-warning">10</span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<li class="header">You have 10 notifications</li>--}}
                                {{--<li>--}}
                                    {{--<ul class="menu">--}}
                                        {{--<li>--}}
                                            {{--<a href="#">--}}
                                                {{--<i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
                                            {{--</a>--}}
                                        {{--</li><!-- end notification -->--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="footer"><a href="#">View all</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        <li class="dropdown">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->f_name }} {{ Auth::user()->l_name }} <span class="caret"></span></a>

                            </a>
                            <ul class="dropdown-menu" role="menu">

                                <li><a href="{{ url( '/logout' ) }}"><i class="fa fa-sign-out"></i>Sign out</a></li>
                                {{--<li class="divider"></li>--}}
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-custom-menu -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">

            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
            </div>
            <strong>Copyright &copy; {{ Carbon\Carbon::now()->year }} <a href="http://www.nepalscouts.org.np">Nepal Scout</a>.</strong> All rights reserved.
        </div>
    </footer>
</div><!-- ./wrapper -->

@section('scripts')

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset( 'jQuery/jQuery-2.1.4.min.js' ) }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset( 'bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset( 'datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset( 'slimScroll/jquery.slimscroll.min.js' ) }}"></script>
    <!-- FastClick -->
    <script src="{{ asset( 'fastclick/fastclick.min.js' ) }}"></script>
    <!-- AdminLTE App -->
    {{--<script src="{{ asset( 'js/app.min.js' ) }}"></script>--}}

    <script src="{{ asset( 'sweetalert/sweetalert.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset( 'js/demo.js') }}"></script>
    <script src="{{  asset('input-mask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset( 'js/scout.js') }}"></script>

@show
</body>
</html>
