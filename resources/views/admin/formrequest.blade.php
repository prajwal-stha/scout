@extends('layouts.admin')


@section('content')

    <section class="content-header">
        <h1>
            Form Requests
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Form Requests</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Form Requests</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    @if(isset($organizations))
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
                                        <td><a class="team-name" href="{{ url('admin/view-organization', [$value->id]) }}">{{ $value->name }}</a> </td>
                                        <td>
                                            <a href="{{ url('admin/view-organization', [$value->id]) }}"><i class="fa fa-eye"></i></a>  |
                                            <i class="fa fa-print"></i>
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