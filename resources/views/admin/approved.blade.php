@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Organizations</li>
        </ol>
    </section>



    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ Request::path() == 'admin/declined-organizations' ? 'Declined Organizations' : 'All Organizations' }}</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
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
                                <td><a href="{{ url('admin/view-approved-organization', [$value->id]) }}">{{ $value->name }}</a></td>
                                <td>{{ $value->type }}</td>
                                <td>{{ $value->chairman_f_name . ' ' . $value->chairman_l_name }}</td>
                                <td>{{ $value->dist_name }}</td>
                                <td>{{ $value->tel_no }}</td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div><!-- /.box -->
            </div>
        </div>

    </section>



@stop


@section('scripts')
    @parent

@stop