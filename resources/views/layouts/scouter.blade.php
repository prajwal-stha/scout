<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nepal Scout</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset( 'bootstrap/css/bootstrap.min.css' ) }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset( 'font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset( 'ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset( 'css/AdminLTE.css' ) }}">
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
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ url('/scouter') }}" class="navbar-brand"><b>Nepal</b>Scout</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                        </div>
                    </form>
                </div><!-- /.navbar-collapse --
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <ol class="breadcrumb">
                    <li><a href="{{ url('/scouter') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Organization</li>
                </ol>
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
    <!-- SlimScroll -->
    <script src="{{ asset( 'slimScroll/jquery.slimscroll.min.js' ) }}"></script>
    <!-- FastClick -->
    <script src="{{ asset( 'fastclick/fastclick.min.js' ) }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset( 'js/app.min.js' ) }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset( 'js/demo.js') }}"></script>

@show
</body>
</html>
