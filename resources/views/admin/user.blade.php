@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Users</h3>
                    </div><!-- /.box-header -->

                    @if(Session::has('user_created'))

                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Great!</h4>
                            {{ Session::get('user_created') }}
                        </div>

                    @endif

                    @if(Session::has('user_deleted'))

                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Great!</h4>
                            {{ Session::get('user_deleted') }}
                        </div>

                    @endif


                    @if(count($user) > 0)
                        <div class="box-body">

                            <div class="table-responsive">
                                <table id="table-registerd-users" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Name</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-registered-users">

                                        @foreach($user as $value)
                                            <tr>
                                                <td><a data-toggle="tooltip" title="VIEW" href="{{ url('admin/profile', [$value->id]) }}">{{ $value->f_name }} {{ $value->l_name }}</a></td>
                                                <td>{{ $value->email }}</td>
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

