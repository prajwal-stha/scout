@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Declined Organizations</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    @if(count($organizations) > 0)
                        <table id="table-approved-organizations" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Registration No.</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Chairman</th>
                                <th>District</th>
                                <th>Contact No.</th>
                            </tr>
                            </thead>
                            <tbody id="list-approved-organizations">

                            @foreach($organizations as $value)
                                <tr>
                                    <td>{{ $value->registration_no }}</td>
                                    <td><a href="{{ url('admin/view-organization', [$value->id]) }}">{{ $value->name }}</a></td>
                                    <td>{{ $value->type }}</td>
                                    <td>{{ $value->chairman_f_name . ' ' . $value->chairman_l_name }}</td>
                                    <td>{{ $value->dist_name }}</td>
                                    <td>{{ $value->tel_no }}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
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

        $('#table-approved-organizations').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    </script>

@stop