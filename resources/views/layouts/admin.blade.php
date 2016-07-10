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

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset( 'css/skins/_all-skins.min.css' ) }}">
    <!-- iCheck -->
    {{--<link rel="stylesheet" href="{{ asset( 'iCheck/all.css' ) }}">--}}

    {{--<link rel="stylesheet" href="{{ asset( 'iCheck/flat/blue.css' ) }}">--}}
    <link rel="stylesheet" href="{{ asset( 'css/style.css' ) }}">



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
            <span class="logo-lg">Nepal Scout</span>

        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            {{ Form::open(['url' => 'admin/search', 'method' => 'POST', 'class' => 'main-search col-sm-3 no-padding pull-left']) }}
            <div class="input-group{{ $errors->has('q') ? ' has-error' : '' }}">
                <input type="text" id="search-organization" name="q" class="form-control" placeholder="Search Organization" value="{{ old('q') }}" autocomplete="off">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-success"><i class="fa fa-search"></i></button>
                </span>
            </div>
            {{ Form::close() }}

            <a class="btn btn-success btn-outline btn-advance-search" href="{{ url('admin/search') }}"> Advanced Search</a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

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
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li{!! Request::path() == 'admin/form' ? ' class="active"': '' !!}>
                    <a href="{{ $unregistered_registration_no > 0 ? url('admin/form') : 'javascript: void(0)' }}">
                        <i class="fa fa-envelope-o"></i> <span>Form Requests</span>
                        @if($unregistered_registration_no > 0)
                            <small class="label pull-right bg-yellow">{{ $unregistered_registration_no }}</small>
                        @endif

                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-institution"></i> <span>Organizations</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('admin/approved-organizations') }}">Approved Organizations</a></li>
                        <li><a href="{{ url('admin/declined-organizations') }}">Declined Organizations</a></li>
                    </ul>
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

                <li{!! Request::path() == 'term' ? ' class="active"': '' !!}>
                    <a href="{{ url('term') }}">
                        <i class="fa fa-tasks"></i> <span>Terms & Conditions</span>
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


</div><!-- ./wrapper -->
@section('scripts')
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset( 'jQuery/jQuery-2.1.4.min.js' ) }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset( 'jQueryUI/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);

        var searchTermsUrl = "{{ url('admin/search-terms') }}";

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

    <script src="{{ asset( 'sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset( 'bootstrap/js/bootstrap3-typeahead.min.js') }}"></script>

    <script src="{{  asset('input-mask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset( 'js/jquery.validate.js') }}"></script>

    <script src="{{ asset( 'js/admin.js') }}"></script>


@show
</body>
</html>