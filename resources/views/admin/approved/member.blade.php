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

        @if(Session::has('committee_member_deleted'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('committee_member_deleted') }}
            </div>

        @endif

        @if(Session::has('member_created'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('member_created') }}
            </div>

        @endif

        <div class="modal" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert-placeholder"></div>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{ Form::open(['url' => 'admin/approved-committee', 'method' => 'PATCH', 'class' => 'update-member-form']) }}
                        <input type="hidden" name="organization_id" value="" id="update-member-org-id">
                        <input type="hidden" name="id" value="" id="update-member-id">

                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('f_name', 'First Name *') }}
                                {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f_name')) }}
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                {{ Form::label('m_name', 'Middle Name') }}
                                {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm_name')) }}
                                <span class="error-message"></span>
                            </div>

                            <div class="form-group">
                                {{ Form::label('l_name', 'Last Name *') }}
                                {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l_name')) }}
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-member-submit">Update</button>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $organization->name }}</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    @include('partials/admin_approved_nav')
                </div><!-- /. box -->

            </div>
            <div class="col-md-8">



                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Committee Member Details</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        {{ Form::open(['url' => 'admin/approved-committee', 'class' => 'form-horizontal', 'id' =>'member-create-form']) }}
                        <input type="hidden" name="organization_id" id="org_id" value="{{ $organization->original_id }}">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('f_name') ? ' has-error' : '' }}">
                                {{ Form::label('f-name', 'First Name *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f-name')) }}
                                    @if ($errors->has('f_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('m_name') ? ' has-error' : '' }}">
                                {{ Form::label('m-name', 'Middle Name', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm-name')) }}
                                    @if ($errors->has('m_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('m_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('l_name') ? ' has-error' : '' }}">
                                {{ Form::label('l-name', 'Last Name *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l-name')) }}
                                    @if ($errors->has('l_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('l_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="box-footer">

                                <button type="submit" class="btn btn-primary pull-left" id="member-submit"><i class="fa fa-refresh"></i> Save</button>
                                {{ link_to('admin/approved-lead-scouter/'.$organization->original_id , 'NEXT', array('class' => 'btn btn-default pull-right')) }}

                            </div>

                            {{ Form::close() }}
                            @if($member->count() > 0)

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
                                                    <a class="adminUpdateApprovedMember" data-id="{{ $value->original_id }}">
                                                        <i class="fa fa-pencil"></i></a> |
                                                    <a class="adminDeleteApprovedCommittee" data-id="{{ $value->original_id }}" href="{{ url( 'admin/delete-approved-committee', [$value->original_id]) }}"><i class="fa fa-trash-o"></i></a>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


@stop


@section('scripts')

    @parent
    <script>
        var delete_approved_member_admin_url =  "<?php echo url('admin/delete-approved-committee'); ?>";
        var update_approved_member_admin_url = "<?php echo url('admin/approved-committee-member'); ?>";

    </script>





@stop