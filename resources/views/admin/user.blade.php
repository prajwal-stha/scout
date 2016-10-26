@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="row">

            @if(Session::has('user_created'))
                <div class="col-md-12">

                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Great!</h4>
                        {{ Session::get('user_created') }}
                    </div>
                </div>

            @endif

            @if(Session::has('user_deleted'))
                <div class="col-md-12">

                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Success!</h4>
                        {{ Session::get('user_deleted') }}
                    </div>

                </div>

            @endif
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Users</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    {{ Form::open(['url' => 'admin/add-users','id' =>'user-create-form'])  }}

                        <div class="box-body">
                            <div class="form-group{{ $errors->has('f_name') ? ' has-error' : ''}}">
                                {{ Form::label('f_name', 'First Name *') }}

                                {{ Form::text('f_name', null, array('class' => 'form-control')) }}
                                @if ($errors->has('f_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                @endif


                            </div>

                            <div class="form-group{{ $errors->has('l_name') ? ' has-error' : ''}}">

                                {{ Form::label('l_name', 'Last Name *') }}

                                {{ Form::text('l_name', null, array('class' => 'form-control')) }}

                                @if ($errors->has('l_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('l_name') }}</strong>
                                        </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">

                                {{ Form::label('email', 'Email *') }}


                                {{ Form::text('email', null, array('class' => 'form-control')) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif


                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">

                                {{ Form::label('username', 'User Name *' ) }}


                                {{ Form::text('username', null, array('class' => 'form-control')) }}

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif


                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">

                                {{ Form::label('password', 'Password *') }}


                                {{ Form::password('password', array('class' => 'form-control')) }}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ''}}">

                                {{ Form::label('password_confirmation', 'Retype Password *' ) }}


                                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif


                            </div>

                            <div class="form-group{{ $errors->has('level') ? ' has-error' : ''}}">

                                {{ Form::label('level', 'Role *') }}
                                <div class="scout-selection ">
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
                    {{ Form::close() }}


                </div><!-- /.box -->
            </div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Users</h3>
                    </div><!-- /.box-header -->


                    @if(count($user) > 0)
                        <div class="box-body">

                            <div class="table-responsive">
                                <table id="table-registerd-users" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-registered-users">

                                        @foreach($user as $value)
                                            <tr>
                                                <td><a data-toggle="tooltip" title="View Profile" href="{{ url('admin/profile', [$value->id]) }}">{{ $value->f_name }} {{ $value->l_name }}</a></td>
                                                <td>{{ $value->username }}</td>
                                                <td>{{ $value->isAdmin() ? 'Administrator' : 'Public' }}</td>
                                                <td>{!! $value->isVerified() ? '<span class="label label-success">Verified</span>' : '<span class="label label-warning">Pending</span>' !!}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>

                        </div>
                    @endif

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

