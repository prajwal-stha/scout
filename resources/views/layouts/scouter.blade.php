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
                <div class="navbar-header pull-left">
                    <a href="{{ url('/') }}" class="navbar-brand"><b>Nepal</b> Scout</a>
                </div>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu front">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset( 'img/user2-160x160.jpg' ) }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->f_name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ asset( 'img/user2-160x160.jpg' ) }}" class="img-circle" alt="User Image">
                                    <p>
                                        {{ Auth::user()->f_name }} {{ Auth::user()->l_name }}
                                        <small>@if (Auth::user()->created_at != null) {{ 'Member since ' . Auth::user()->created_at->toFormattedDateString() }} @endif</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ url('admin/profile', [Auth::user()->id]) }}" class="btn btn-default">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url( '/logout' ) }}" class="btn btn-default"><i class="fa fa-sign-out"></i>Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
               {{--<div class="default-welcome-message">--}}
                   {{--<span>{{ Auth::user()->f_name }} {{ Auth::user()->l_name }}</span> / <a href="{{ url( '/logout' ) }}">Sign out <i class="fa fa-sign-out"></i></a>--}}
               {{--</div>--}}
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">

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

    <script src="{{ asset( 'sweetalert/sweetalert.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset( 'js/demo.js') }}"></script>
    <script src="{{ asset( 'js/app.min.js' ) }}"></script>
    <script src="{{  asset('input-mask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset( 'js/scout.js') }}"></script>

@show
</body>
</html>
