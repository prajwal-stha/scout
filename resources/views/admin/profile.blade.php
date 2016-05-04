@extends('layouts.admin')

@section('content')

    <section class="content">
        @if(Session::has('user_update'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('user_update') }}
            </div>

        @endif
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Profile</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    {{ Form::model($user, ['url' => ['admin/profile', $user['id']], 'method' => 'PATCH', 'class' => 'edit-user']) }}

                    <div class="box-body">
                        <div class="form-group{{ $errors->has('f_name') ? ' has-error' : ''}}">
                            {{ Form::label('f_name', 'First Name') }}
                            {{ Form::text('f_name', null, array('class' => 'form-control')) }}
                            @if ($errors->has('f_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('f_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('l_name') ? ' has-error' : ''}}">

                            {{ Form::label('l_name', 'Last Name') }}
                            {{ Form::text('l_name', null, array('class' => 'form-control')) }}

                            @if ($errors->has('l_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('l_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">

                            {{ Form::label('email', 'Email') }}
                            {{ Form::text('email', null, array('class' => 'form-control', 'readonly')) }}

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">

                            {{ Form::label('username', 'Username') }}
                            {{ Form::text('username', null, array('class' => 'form-control', 'readonly')) }}

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">

                            {{ Form::label('password', 'New Password') }}
                            {{ Form::password('password', array('class' => 'form-control')) }}

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ''}}">

                            {{ Form::label('password_confirmation', 'Retype New Password') }}
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif

                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Submit</button>
                    </div>
                    {{ Form::close() }}

                </div><!-- /.box -->

            </div>
        </div>
    </section>

@stop

@section('scripts')

    @parent

@stop