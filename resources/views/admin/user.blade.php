@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Registered Users</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    @if(count($user) > 0)
                        <div class="box-body">

                            <div class="table-responsive">
                                <table id="table-registerd-users" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>User Name</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-registered-users">

                                        @foreach($user as $value)
                                            <tr>
                                                <td>{{ $value->f_name }}</td>
                                                <td>{{ $value->l_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->username }}</td>
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

