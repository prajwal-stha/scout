@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Users</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    {{ Form::open(['url' => 'admin/add-users', 'class' => 'form-horizontal' ,'id' =>'user-create-form'])  }}

                    <div class="box-body">
                        <div class="form-group{{ $errors->has('f_name') ? ' has-error' : ''}}">
                            {{ Form::label('f_name', 'First Name *', array('class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-9">
                                {{ Form::text('f_name', null, array('class' => 'form-control')) }}
                                @if ($errors->has('f_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('l_name') ? ' has-error' : ''}}">

                            {{ Form::label('l_name', 'Last Name *', array('class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-9">
                                {{ Form::text('l_name', null, array('class' => 'form-control')) }}

                                @if ($errors->has('l_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('l_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">

                            {{ Form::label('email', 'Email *', array('class' => 'control-label col-sm-3')) }}

                            <div class="col-sm-9">
                                {{ Form::text('email', null, array('class' => 'form-control')) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">

                            {{ Form::label('username', 'User Name *', array('class' => 'control-label col-sm-3') ) }}

                            <div class="col-sm-9">
                                {{ Form::text('username', null, array('class' => 'form-control')) }}

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">

                            {{ Form::label('password', 'Password *', array('class' => 'control-label col-sm-3') ) }}

                            <div class="col-sm-9">
                                {{ Form::password('password', array('class' => 'form-control')) }}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ''}}">

                            {{ Form::label('password_confirmation', 'Retype Password *', array('class' => 'control-label col-sm-3')) }}

                            <div class="col-sm-9">
                                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('level') ? ' has-error' : ''}}">

                        {{ Form::label('level', 'Role *', array('class' => 'control-label col-sm-3')) }}
                            <div class="scout-selection col-sm-9">
                                {{ Form::select('level',array(
                                        '0'       => 'Public',
                                        '1'       => 'Administrator',

                                    ), null, array('class' => 'form-control', 'id' => 'user-level')) }}

                                @if ($errors->has('chairman_gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>


                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" id="create-submit">Submit</button>
                            </div>
                        </div>
                    </form>


                </div><!-- /.box -->
            </div>

        </div>

    </section>


@stop


@section('scripts')


    @parent
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>

        $('#table-registerd-users').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    </script>

@stop

