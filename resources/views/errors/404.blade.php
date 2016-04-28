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


<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-green"> 404</h2>
                <div class="error-content">
                    <h3><i class="fa fa-warning text-red"></i> Oops! Page not found.</h3>
                    <p>
                        We could not find the page you were looking for.
                        Meanwhile, you may <a href="{{ url('/') }}">return to homepage</a> or try using the search form.
                    </p>
                    {{ Form::open(['url' => 'admin/search', 'method' => 'POST', 'class' => 'search-form']) }}
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                            </div>
                        </div><!-- /.input-group -->
                    {{ Form::close() }}
                </div><!-- /.error-content -->
            </div><!-- /.error-page -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <script src="{{ asset( 'jQuery/jQuery-2.1.4.min.js' ) }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset( 'bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset( 'datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset( 'slimScroll/jquery.slimscroll.min.js' ) }}"></script>
    <!-- FastClick -->
    <script src="{{ asset( 'fastclick/fastclick.min.js' ) }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset( 'js/app.min.js' ) }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset( 'js/demo.js') }}"></script>

    <script src="{{ asset( 'js/scout.js') }}"></script>


</body>
</html>