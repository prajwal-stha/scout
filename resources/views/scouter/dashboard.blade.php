@extends('layouts.scouter')


@section('content')


    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Units</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Units</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Status</th>
                                </tr>
                                <?php $i = 0;  ?>
                                @foreach($organization as $value)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a href="{{ url('scouter/organization', [$value->id]) }}" data-toggle="tooltip" title="VIEW UNIT">{{ $value->name }}</a></td>
                                        <td>{{ $value->created_at == null ? '-': $value->created_at }}</td>
                                        <td>{{ $value->updated_at == null ? '-': $value->updated_at }}</td>
                                        <td>{!! $value->isSubmitted() ? '<span class="label label-warning">Submitted</span>' : '' !!}
                                            {!! $value->isDeclined() ?  '<span class="label label-danger">Declined</span>' : '' !!}
                                            {!! $value->isSubmitted() && $value->isRegistered() ? '<span class="label label-success">Accepted</span>' : '' !!}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div><!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <a href="{{ url('organizations/create') }}" class="btn btn-sm btn-success pull-left">Add New Unit</a>
                        @if(is_admin())
                            <a href="{{ url('admin') }}" class="btn btn-sm btn-default pull-right" data-toggle="tooltip" title="BACK TO ADMIN PANEL"><i class="fa fa-fw fa-exchange"></i> Admin Panel</a>
                        @endif
                    </div>
                </div><!-- /.box -->

            </div>
        </div>
    </section>

@stop

@section('scripts')

    @parent


@stop