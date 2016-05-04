@extends('layouts.admin')


@section('content')
        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $organizations->count() > 0 ? 'New Form Requests' : 'Grab a cup of coffee. No new form request for now.' }}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                @if($organizations->count() > 0)
                    <div class="box-body">
                        <table id="form-requests" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Organizations</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="form-requests">

                            @foreach( $organizations as $value)
                                <tr>
                                    <td><a class="team-name"
                                           href="{{ url('admin/view-organization', [$value->id]) }}">{{ $value->name }}</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ url('admin/view-organization', [$value->id]) }}"><i
                                                    class="fa fa-eye"></i></a>
                                        <a class="btn btn-primary" target="_blank" href="{{ url('admin/print', [$value->id]) }}"><i class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div><!-- /.box-body -->
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
        $('#form-requests').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    </script>

@stop