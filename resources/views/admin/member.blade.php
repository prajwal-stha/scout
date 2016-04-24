@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>{{ $organization->name }}</li>
            <li class="active">Committe Members</li>

        </ol>
    </section>

    <section class="content">

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Committee Member Details</strong></h3>
            </div><!-- /.box-header -->

            <div class="box-body">

                <table id="table-admin-member" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="list-admin-member">
                        @foreach($member as $value)
                            <tr>
                                <td>{{ $value->f_name }}</td>
                                <td>{{ $value->m_name }}</td>
                                <td>{{ $value->l_name }}</td>
                                <td>
                                    <a class="updateMember" data-id="{{ $value->id }}">
                                        <i class="fa fa-pencil"></i></a> |
                                    <a class="" data-id="{{ $value->id }}" href="{{ url( 'admin/delete-committee', [$value->id]) }}"><i class="fa fa-trash-o"></i></a>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
                <div class="box-footer">

                    {{ link_to('admin/lead-scouter/'.$organization->id , 'NEXT', array('class' => 'btn btn-default pull-right')) }}
                </div>
            </div>
        </div>

    </section>


@stop


@section('scripts')

    @parent



@stop