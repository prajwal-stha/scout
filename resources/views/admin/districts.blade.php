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
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('districts_created'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Great!</strong> {{ Session::get('districts_created') }}<br><br>
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
                    <form role="form" action="{{  url('districts/create-districts') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">District Name</label>
                                <input type="text" class="form-control" id="district-name" placeholder="District Name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">District Code</label>
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

                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">All Districts</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ url('districts/delete-many-districts') }}" method="post">
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
                                    @if (isset($districts))
                                        @foreach($districts as $value)
                                            <tr>
                                                <td class="check-row"><input name="action_to[]" type="checkbox" value="{{ $value->district_code }}"></td>
                                                <td>{{ $value->district_code }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td><a href="{{ url('districts/edit-districts', [$value->district_code]) }}" data-toggle="tooltip" title="UPDATE"><i class="fa fa-pencil"></i></a> |
                                                <a href="{{ url( 'districts/delete-districts', [$value->district_code]) }}" onclick="return confirm('Are you sure you want to remove this record?');" data-toggle="tooltip" title="DELETE"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>

                            </table>

                            <div class="btn-toolbar list-toolbar">
                                <button class="btn btn-danger" name="mass-delete" type="submit" id="delete-submit">Delete</button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
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
                if ($(this).is(':checked')) {
                    $(this).each(function () {
                        $('td').css('color', '#61708F');
                        return;
                    });
                }
                $('#delete_districts').css('display', 'inline-block');

            } else {
                $('.check-row input[type=checkbox]').prop('checked', false);
                $('#delete_districts').css('display', 'none');
            }
        });
        $('.check-row input[type=checkbox]').on('click', function () {
            if ($(this).is(':checked')) {
                $(this).each(function () {
                    $('td').css('color', '#61708F');
                });
            }
        });

//        $('#create-submit').on('submit', function(e){
//            e.preventDefault();
//            var name = $('#district-name').val();
//            var code = $('#district-code').val();
//
//            $.ajax({
//                type: "POST",
//                url: host+'/districts/create-districts',
//                data: {name:name, district_code:code },
//                success: function( msg ) {
//                    alert( msg );
//                }
//            });
//
//        });
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

    </script>
@stop

