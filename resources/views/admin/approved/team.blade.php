@extends('layouts.admin')


@section('content')

    <section class="content">
        <div class="modal" id="approvedteamModal" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert-placeholder"></div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                    {{ Form::open(['url' => 'admin/approved-teams', 'method' => 'PATCH', 'class' => 'update-approved-team-form']) }}
                        <input type="hidden" name="organization_id" value="{{ $organization->original_id }}"
                               id="update-team-org-id">
                        <input type="hidden" name="id" value="" id="update-team-id">

                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('name', 'Name *') }}
                                {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name')) }}
                                <span class="error-message"></span>
                            </div>

                            <div class="form-group scout-selection">
                                {{ Form::label('gender', 'Gender *') }}
                                {{ Form::select('gender', array(
                                        'Male'       => 'Male',
                                        'Female'     => 'Female',
                                        'Other'      => 'Other'
                                    ),null, array('class' => 'form-control', 'id' => 'gender')) }}
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group scout-selection">
                                {{ Form::label('type', 'Type *') }}
                                {{ Form::select('type', array(
                                        'Six'              => 'Six',
                                        'Patrol'           => 'Patrol',
                                        'Venture Patrol'   => 'Venture Patrol',
                                        'Crew'             => 'Crew'
                                    ),null, array('class' => 'form-control', 'id' => 'type')) }}
                                <span class="error-message"></span>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="modal-team-submit">Update</button>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>

        @if(isset($team))
            <div class="modal" id="approvedteamMemberModal" tabindex="-1" role="dialog"
                 aria-labelledby="teamMemberModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="alert-placeholder-member"></div>
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        {{ Form::open(['url' => 'admin/approved-member', 'method' => 'PATCH', 'class' => 'form-horizontal update-approvedteamMember-form']) }}
                        <input type="hidden" name="team_id" value="{{ $teamId or null }}" id="team_id">
                        <input type="hidden" name="id" value="" id="teamMemberId">

                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('f_name', 'Name *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-3">
                                    {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f_name', 'placeholder' => 'First Name')) }}
                                    <span class="error-message"></span>
                                </div>

                                <div class="col-sm-3">
                                    {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm_name', 'placeholder' => 'Middle Name')) }}
                                    <span class="error-message"></span>
                                </div>

                                <div class="col-sm-3">
                                    {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l_name', 'placeholder' => 'Last Name')) }}
                                    <span class="error-message"></span>
                                </div>

                            </div>

                            <div class="form-group">
                                {{ Form::label('dob', 'DOB *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::text('dob', null, array('class' => 'date form-control', 'id' => 'dob', 'placeholder' => 'Date of Birth', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('entry_date', 'Date of Join *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::text('entry_date', null, array('class' => 'date form-control', 'id' => 'entry_date', 'placeholder' => 'Date of Join', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('position', 'Current Badge Position *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9 scout-selection">
                                    {{ Form::select('position',
                                        array(
                                            'alpha'      => 'Alpha',
                                            'beta'       => 'Beta'
                                        ), null, array('class' => 'form-control', 'id' => 'position' )) }}
                                    <span class="error-message"></span>
                                </div>

                            </div>

                            <div class="form-group">
                                {{ Form::label('post', 'Post *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9 scout-selection">
                                    @if(!is_null($team_type))
                                        @if($team_type == 'Six')
                                            {{ Form::select('post', array(
                                               'Membership'      => 'Membership',
                                               'Star'            => 'Star',
                                               'Sun'             => 'Sun',
                                               'Moon'            => 'Moon',
                                            ), null, array('class' => 'form-control', 'id' => 'post' )) }}
                                        @elseif($team_type == 'Patrol')
                                            {{ Form::select('post', array(
                                               'Membership'      => 'Membership',
                                               'B.P. Peak'       => 'B.P. Peak',
                                               'Annapurna'       => 'Annapurna',
                                               'Kangchenjunga'   => 'Kangchenjunga',
                                               'Everest'         => 'Everest',
                                               'President'       => 'President'
                                            ), null, array('class' => 'form-control', 'id' => 'post' )) }}
                                        @elseif($team_type == 'Venture Patrol')
                                            {{ Form::select('post', array(
                                               'Membership'      => 'Membership',
                                               'Pioneer'         => 'Pioneer',
                                               'Explorer'        => 'Explorer',
                                               'Adventure'       => 'Adventure'
                                            ), null, array('class' => 'form-control', 'id' => 'post' )) }}
                                        @elseif($team_type == 'Crew')
                                            {{ Form::select('post', array(
                                               'Membership'       => 'Membership',
                                               'Training'         => 'Training',
                                               'Service'          => 'Service',
                                               'Leadership'       => 'Leadership'
                                            ), null, array('class' => 'form-control', 'id' => 'post' )) }}
                                        @endif
                                    @endif
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('passed_date', 'Passed Date *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::text('passed_date', null, array('class' => 'date form-control', 'id' => 'passed_date', 'placeholder' => 'Passed Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('note', 'Notes', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('note', null, ['class' => 'form-control', 'id' => 'note', 'size' => '30x5', 'placeholder' => 'Notes']) }}
                                    <span class="error-message"></span>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="modal-approvedteamMember-submit">Update
                            </button>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $organization->name }}</h3>
                    </div>
                    @include('partials/admin_approved_nav')
                </div><!-- /. box -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Units : {{ $organization->name }}</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">

                        {{ Form::open(['url' => 'admin/create-approved-team', 'class' => 'add-team-area', 'id' =>'team-create-form']) }}

                        <input type="hidden" name="org_id" id="org_id"
                               value="{{  $organization->original_id }}">
                        <div class="row{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="form-group">
                                {{ Form::label('name', 'Name *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'team-name', 'placeholder' => 'Name')) }}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <div class="form-group scout-selection">
                                {{ Form::label('gender-1', 'Gender *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-8">
                                    {{ Form::select('gender', array(
                                            'Male'       => 'Male',
                                            'Female'     => 'Female',
                                            'Other'      => 'Other'
                                        ),null, array('class' => 'form-control', 'id' => 'gender-1')) }}
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row{{ $errors->has('type') ? ' has-error' : '' }}">
                            <div class="form-group scout-selection">
                                {{ Form::label('type-1', 'Type *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-8">
                                    {{ Form::select('type', array(
                                            'Six'              => 'Six',
                                            'Patrol'           => 'Patrol',
                                            'Venture Patrol'   => 'Venture Patrol',
                                            'Crew'             => 'Crew'
                                        ),null, array('class' => 'form-control', 'id' => 'type-1')) }}
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="add-team-button">

                            <div class="pull-right">

                                <button type="submit" class="btn btn-success" id="team-submit"><i
                                            class="fa fa-plus-circle"></i> Add Unit
                                </button>
                            </div>

                        </div>


                        {{ Form::close() }}

                        @if(isset($team) && $team->count())
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="teams-list">
                                    <thead align="center">
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($team as $value)
                                            <tr>
                                                <td><a class="team-name"
                                                       href="{{ url( 'admin/approved-teams', [$organization->original_id, $value->original_id]) }}">{{ $value->name }}</a>
                                                </td>
                                                <td><a data-toggle="tooltip" title="EDIT" class="btn btn-success approvedUpdateTeam"
                                                       data-id="{{ $value->original_id }}">
                                                        <i class="fa fa-pencil"></i></a>
                                                    <a data-toggle="tooltip" title="DELETE" class="btn btn-danger approvedDeleteTeam"
                                                       data-id="{{ $value->original_id }}"
                                                       href="{{ url( 'admin/delete-approved-teams', [$value->id]) }}"><i
                                                                class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>


            </div>
            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header with-border">

                        @if(isset($team))
                            @if(!is_null($team_name))
                                <h3 class="box-title"> Add Members to: {{ $team_name }}</h3>

                            @endif
                        @endif


                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <div class="box-body">
                        {{ Form::open(['url' => 'admin/create-approved-team-member', 'class' => 'form-horizontal', 'id' =>'approved-member-create-form']) }}

                        @if(isset($team))
                            <input type="hidden" name="team_id" value="{{ $teamId or null }}" id="team_id">
                        @endif
                        <div class="form-group{{ $errors->has('f_name') || $errors->has('m_name') || $errors->has('l_name') ? ' has-error' : '' }}">

                            {{ Form::label('name', 'Name *', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-3">
                                {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'First')) }}

                                @if ($errors->has('f_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm-name', 'placeholder' => 'Middle')) }}

                                @if ($errors->has('m_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('m_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l-name', 'placeholder' => 'Last')) }}

                                @if ($errors->has('l_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('l_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">

                            {{ Form::label('dob', 'DOB *', array( 'class' => 'control-label col-sm-3')) }}

                            <div class="col-sm-9">
                                {{ Form::text('dob', null, array('class' => 'form-control date', 'id' => 'dob1', 'placeholder' => 'Date of Birth', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('entry_date') ? ' has-error' : '' }}">

                            {{ Form::label('entry_date1', 'Date of Join *', array( 'class' => 'control-label col-sm-3')) }}

                            <div class="col-sm-9">
                                {{ Form::text('entry_date', null, array('class' => 'form-control date', 'id' => 'entry_date1', 'placeholder' => 'Date of Join', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                @if ($errors->has('entry_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('entry_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">

                            {{ Form::label('position1', 'Current Badge Position *', array( 'class' => 'control-label col-sm-3')) }}


                            <div class="col-sm-9 scout-selection">
                                {{ Form::select('position', array(
                                    'alpha'      => 'Alpha',
                                    'beta'       => 'Beta'
                                ), null, array('class' => 'form-control', 'id' => 'position1' )) }}
                                @if ($errors->has('position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>


                        </div>

                        @if(isset($team))

                            <div class="form-group{{ $errors->has('post') ? ' has-error' : '' }}">

                                {{ Form::label('post-1', 'Post *', array( 'class' => 'control-label col-sm-3')) }}


                                <div class="col-sm-9 scout-selection">
                                    @if(!is_null($team_type))
                                        @if($team_type == 'Six')
                                            {{ Form::select('post', array(
                                               'Membership'      => 'Membership',
                                               'Star'            => 'Star',
                                               'Sun'             => 'Sun',
                                               'Moon'            => 'Moon',
                                            ), null, array('class' => 'form-control', 'id' => 'post-1' )) }}
                                        @elseif($team_type == 'Patrol')
                                            {{ Form::select('post', array(
                                               'Membership'      => 'Membership',
                                               'B.P. Peak'         => 'B.P. Peak',
                                               'Annapurna'       => 'Annapurna',
                                               'Kangchenjunga'   => 'Kangchenjunga',
                                               'Everest'         => 'Everest',
                                               'President'       => 'President'
                                            ), null, array('class' => 'form-control', 'id' => 'post-1' )) }}
                                        @elseif($team_type == 'Venture Patrol')
                                            {{ Form::select('post', array(
                                               'Membership'      => 'Membership',
                                               'Pioneer'         => 'Pioneer',
                                               'Explorer'        => 'Explorer',
                                               'Adventure'       => 'Adventure'
                                            ), null, array('class' => 'form-control', 'id' => 'post-1' )) }}
                                        @elseif($team_type == 'Crew')
                                            {{ Form::select('post', array(
                                               'membership'       => 'Membership',
                                               'training'         => 'Training',
                                               'service'          => 'Service',
                                               'leadership'       => 'Leadership'
                                            ), null, array('class' => 'form-control', 'id' => 'post-1' )) }}
                                        @endif
                                    @endif

                                    @if ($errors->has('post'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('post') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('passed_date') ? ' has-error' : '' }}">

                            {{ Form::label('passed_date1', 'Passed Date *', array( 'class' => 'control-label col-sm-3')) }}

                            <div class="col-sm-9">
                                {{ Form::text('passed_date', null, array('class' => 'form-control date', 'id' => 'passed_date1', 'placeholder' => 'Passed Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}

                                @if ($errors->has('passed_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passed_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">

                            {{ Form::label('note1', 'Notes', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('note', null, ['class' => 'form-control', 'id' => 'note1', 'size' => '30x5', 'placeholder' => 'Notes']) }}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">

                        <div class="pull-right">
                            <button type="submit" class="btn btn-success" id="create_team_member"><i class="fa fa-plus-circle"></i> Add Member</button>
                            {{ link_to('admin/approved-registration/'.$organization->original_id, 'NEXT', array('class' => 'btn btn-default')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        @if(isset($team_member) && $team_member->count())

            <div class="row">

                <div class="col-md-12">
                    <div class="table-responsive">

                        <table class="table table-bordered table-striped" id="team-member-list">
                            <thead>
                            <tr>
                                <th>Badge Position</th>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Date of Join</th>
                                <th>Passed Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($team_member as $value)
                                <tr>
                                    <td>{{ $value->position }}</td>
                                    <td>{{ $value->f_name. ' ' . $value->l_name }}</td>
                                    <td>{{ $value->dob }}</td>
                                    <td>{{ $value->entry_date }}</td>
                                    <td>{{ $value->passed_date }}</td>
                                    <td><a data-toggle="tooltip" title="UPDATE" class="btn btn-success updateApprovedTeamMember"
                                           data-id="{{ $value->original_id }}">
                                            <i class="fa fa-pencil"></i></a>
                                        <a data-toggle="tooltip" title="DELETE" class="btn btn-danger deleteApprovedTeamMember"
                                           data-id="{{ $value->original_id }}"
                                           href="{{ url( 'admin/delete-approved-member', [$value->original_id]) }}"><i
                                                    class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </section>

@stop


@section('scripts')

    @parent
    <script>
        var update_approved_team_admin_url = "<?php echo url('admin/update-approved-team'); ?>";
        var delete_approved_team_admin_url = "<?php echo url('admin/delete-approved-teams'); ?>";
        var update_approved_teamMember_admin_url = "<?php echo url('admin/approved-member'); ?>";
        var delete_approved_teamMember_admin_url = "<?php echo url('admin/delete-approved-member'); ?>";
        $(".date").inputmask();
        $(".date").datepicker({
            format: 'dd/mm/yyyy',
            viewMode: 'years',
            minViewMode: 'days',
            autoclose: true
        });
    </script>
@stop