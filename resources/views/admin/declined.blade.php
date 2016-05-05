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

                    @if(Session::has('org_declined'))

                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Great!</h4>
                            {{ Session::get('org_deleted') }}
                        </div>

                    @endif


                    @if(count($organizations) > 0)

                        <div class="box-body">

                            <div class="table-responsive">
                                <table id="table-approved-organizations" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><input name="action_to_all" type="checkbox" class="check-all"></th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Chairman</th>
                                        <th>District</th>
                                        <th>Contact No.</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-approved-organizations">

                                    @foreach($organizations as $value)
                                        <tr>
                                            <td><input class="check-row" name="action_to[]" type="checkbox" value="{{ $value->id }}"></td>
                                            <td>
                                                <a data-toggle="tooltip" title="VIEW" href="{{ url('admin/view-organization', [$value->id]) }}">{{ $value->name }}</a>
                                            </td>
                                            <td>{{ $value->type }}</td>
                                            <td>{{ $value->chairman_f_name . ' ' . $value->chairman_l_name }}</td>
                                            <td>{{ $value->dist_name }}</td>
                                            <td>{{ $value->tel_no }}</td>
                                            <td><a data-toggle="tooltip" title="DELETE" class="btn btn-danger deleteDeclinedOrg" data-id="{{ $value->id }}" href="{{ url( 'admin/delete-declined-org', [$value->id]) }}"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                            </div>

                        @endif
                    </div>
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
        var delete_declined_url = "<?php echo url('admin/delete-declined-org'); ?>";
        var delete_many_declined_url = "<?php echo url('admin/remove-declined'); ?>";

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