<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nepal Scout | Reset Password</title>

    <link rel="shortcut icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico/favicon-16x16.png') }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset( 'bootstrap/css/bootstrap.min.css' ) }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset( 'font-awesome/css/font-awesome.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset( 'iCheck/square/blue.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset( 'css/AdminLTE.css') }}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">

    <!-- Main Content -->

    <div class="login-box reset-password">

        <div class="login-logo">
            <a class="logo-circle-stroke" href="{{ url('/') }}"><img src="{{ asset('img/logo.jpg') }}" alt="Nepal Scout"></a>
        </div><!-- /.login-logo -->


        <div class="login-box-msg style-normal">Reset Password</div>
        <div class="login-box-body">

            @if (session('status'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {{--<label class="col-md-12">E-Mail Address</label>--}}

                    <div class="col-md-12">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        <a href="{{ url('/login') }}">Back</a>
                    </div>

                </div>


            </form>
        </div>
    </div>

    <script src="{{ asset( 'jQuery/jQuery-2.1.4.min.js' ) }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset( 'bootstrap/js/bootstrap.min.js' ) }}"></script>
</body>
</html>

