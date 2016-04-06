@extends('layouts.admin')

@section('content')

    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Districts</li>
        </ol>
    </section>


    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if (count($errors) > 0)

            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Whoops!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('msg'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('msg') }}
            </div>
        @endif

        @if(Session::has('districts_deleted'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('districts_deleted') }}
            </div>

        @endif
        <div class="row">
            <div class="col-md-5">
                <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add Districts</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('districts/create') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                                <label for="district-name">District Name</label>
                                <input type="text" class="form-control" id="district-name" placeholder="District Name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group{{ $errors->has('district_code') ? ' has-error' : ''}}">
                                <label for="district-code">District Code</label>
                                <input type="text" class="form-control" id="district-code" placeholder="District Code" name="district_code" value="{{ old('district_code') }}">
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="create-submit">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div>

            <div class="col-md-7">
                @if (isset($districts))

                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">All Districts</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ url('districts/remove') }}" method="post" id="remove_many_districts">
                                {{ csrf_field() }}
                                <table id="list-districts" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><input name="action_to_all" type="checkbox" class="check-all"></th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($districts as $value)
                                            <tr>
                                                <td class="check-row"><input name="action_to[]" type="checkbox" value="{{ $value->id }}"></td>
                                                <td>{{ $value->district_code }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td><a href="{{ url('districts/update', [$value->id]) }}" data-toggle="tooltip" title="UPDATE"><i class="fa fa-pencil"></i></a> |
                                                <a onclick="confirmRemove(event);" href="{{ url( 'districts/delete', [$value->id]) }}" data-toggle="tooltip" title="DELETE"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                                <div class="btn-toolbar list-toolbar">
                                    <button class="btn btn-danger" name="mass-delete" type="submit" id="delete-submit">Delete</button>
                                </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                @endif
            </div>
        </div>

    </section>
@stop

@section('scripts')
    @parent
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>

        $('#list-districts').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        $('.check-all').on('click', function () {
            if ($(this).is(':checked')) {
                $('.check-row input[type=checkbox]').prop('checked', true);
                $(this).each(function () {
                    if ($(this).is(':checked')) {
                        $('#delete-submit').css('display', 'inline-block');
                    }
                });

            } else {
                $('.check-row input[type=checkbox]').prop('checked', false);
                $(this).each(function(){
                    if($(this).not(':checked')) {
                        $('#delete-submit').css('display', 'none');
                    }
                });
            }
        });

        $('.check-row input[type=checkbox]').on('click', function () {

            $(this).each(function() {

                if($(this).is(':checked')) {

                    $('#delete-submit').css('display', 'inline-block');

                } else {

                    $('#delete-submit').css('display', 'none');
                }

            });


        });

        $('#create-submit').on('submit', function(e) {
            e.preventDefault();
            console.log('attempting');
            $.post(
                $(this).prop('action'),
                {
                    "_token": $(this).find('input[name=_token]').val(),
                    "name": $('#district-name').val(),
                    "code": $('#district-code').val()
                },
                function (data) {
                    console.log(data);
                },
                'json'
            );
            return false;
        });
        $('#delete-submit').on('click', function(event){
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "The record has been deleted.", "success");
                    $('#remove_many_districts').submit();

                } else {
                    swal("Cancelled", "The record is safe.)", "error");
                }
            });
        });
        function confirmRemove(event){
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "The record has been deleted.", "success");
                } else {
                    swal("Cancelled", "The record is safe.)", "error");
                }
            });
        }
    </script>
@stop

