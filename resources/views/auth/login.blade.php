<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nepal Scout | Log in</title>

    <link rel="shortcut icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico/favicon-16x16.png') }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset( 'bootstrap/css/bootstrap.min.css' ) }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset( 'font-awesome/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset( 'css/AdminLTE.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset( 'iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a class="logo-circle-stroke" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.jpg') }}" alt="Nepal Scout">
        </a>
    </div><!-- /.login-logo -->

    <div class="login-box-msg">Welcome <span class="color-green">back!</span> <span class="small-text">Please login to your account</span></div>
    <div class="login-box-body">
        @if(session('confirmed'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('confirmed') }}
            </div>
        @endif
        @if(session('not_verified'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                {{ session('not_verified') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('error') }}
            </div>
        @endif
        @if(session('verified'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('verified') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="User Name" name="username" value="{{ old('username') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-6 text-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i>  Sign In</button>
                </div><!-- /.col -->
            </div>
        </form>

        <div class="login-footer-style text-center">
            <div class="row">
                <div class="col-xs-6 text-left">
                    <a href="{{ url('/password/reset') }}">I forgot my password</a>
                </div>
                <div class="col-xs-6 text-right">
                    <strong><a href="{{ url('/register') }}">Register</a></strong>
                </div>
            </div>


        </div>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset( 'jQuery/jQuery-2.1.4.min.js' ) }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset( 'bootstrap/js/bootstrap.min.js' ) }}"></script>
<!-- iCheck -->
<script src="{{ asset( 'iCheck/icheck.min.js' ) }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
