@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Districts</li>
        </ol>
    </section>


    <section class="content">

        <!-- Small boxes (Stat box) -->
        {{--@if (count($errors) > 0)--}}

            {{--<div class="alert alert-danger alert-dismissable">--}}
                {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
                {{--<h4><i class="icon fa fa-ban"></i> Whoops!</h4>--}}
                {{--<ul>--}}
                    {{--@foreach ($errors->all() as $error)--}}
                        {{--<li>{{ $error }}</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}

        {{--@endif--}}

        @if(Session::has('district_updated'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('district_updated') }}
            </div>

        @endif
        <div class="modal" id="districtModal" tabindex="-1" role="dialog" aria-labelledby="districtModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div id="modal-alert-placeholder"></div>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ url('districts/update') }}" method="post" id="district-update-form">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="" id="update-district-id">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">District Name</label>
                                <input type="text" class="form-control" id="name" placeholder="District Name" name="name" value="">
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="district_code">District Code</label>
                                <input type="text" class="form-control" id="district_code" placeholder="District Code" name="district_code" value="">
                                <span class="error-message"></span>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="alert-placeholder"></div>

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
                    <form role="form" action="{{ url('districts/create') }}" method="post" id="district-create-form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div id="form-name" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="create-district-name">District Name</label>
                                <input type="text" class="form-control" id="create-district-name" placeholder="District Name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div id="form-code" class="form-group{{ $errors->has('district_code') ? ' has-error' : '' }}">
                                <label for="create-district-code">District Code</label>
                                <input type="text" class="form-control" id="create-district-code" placeholder="District Code" name="district_code" value="{{ old('district_code') }}">
                                @if ($errors->has('district_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('district_code') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="create-submit"><i class="fa fa-refresh"></i> Submit</button>
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

                        <div class="box-body table-list-districts">
                            @include('partials.districts')
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

        var update_district_url = "<?php echo url('districts/update'); ?>";
        var delete_district_url = "<?php echo url('districts/delete'); ?>";
        var remove_district_url = "<?php echo url('districts/remove'); ?>";
        var index_district_url = "<?php echo url('districts'); ?>";

        $('#table-districts').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    </script>

@stop

