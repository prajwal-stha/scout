@extends('layouts.scouter')


@section('content')

    @if(Session::has('team_updated'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('team_updated') }}
        </div>
    @endif

    @if(Session::has('member_deleted'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('member_deleted') }}
        </div>
    @endif

    @if(Session::has('team_member_updated'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('team_member_updated') }}
        </div>
    @endif


    @if(Session::has('team_not_filled'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i>Error!!</h4>
            {{ Session::get('team_not_filled') }}
        </div>
    @endif

    @if ($errors->has(0))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="modal" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="alert-placeholder"></div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


                {{ Form::open(['url' => 'team/update', 'method' => 'PATCH', 'class' => 'update-team-form']) }}
                    <input type="hidden" name="organization_id" value="" id="update-team-org-id">
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
                        <button type="submit" class="btn btn-primary" id="modal-team-submit">Update</button>
                    </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>

    @if(isset($team))

        <div class="modal" id="teamMemberModal" tabindex="-1" role="dialog" aria-labelledby="teamMemberModalLabel">
            <div class="modal-dialog" role="document">
                <div class="alert-placeholder-member"></div>
                <div class="modal-content">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                    {{ Form::open(['url' => 'member/update', 'method' => 'PATCH', 'class' => 'form-horizontal update-teamMember-form']) }}
                    <input type="hidden" name="team_id" value="{{ $teamId or null }}" id="team_id">
                    <input type="hidden" name="id" value="" id="teamMemberId">

                    <div class="modal-body">
                        <div class="form-group">
                            {{ Form::label('f_name', 'Name *', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-3">
                                {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f_name', 'placeholder'  => 'First Name')) }}
                                <span class="error-message"></span>
                            </div>

                            <div class="col-sm-3">
                                {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm_name', 'placeholder' => 'Middle Name')  ) }}
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
                                {{ Form::text('dob', null, array('class' => 'form-control', 'id' => 'dob', 'placeholder' => 'Date of Birth', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('entry_date', 'Date of Join *', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-9">
                                {{ Form::text('entry_date', null, array('class' => 'form-control', 'id' => 'entry_date', 'placeholder' => 'Date of Join', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
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
                                {{ Form::text('passed_date', null, array('class' => 'form-control', 'id' => 'passed_date', 'placeholder' => 'Passed Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('note', 'Notes', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('note', null, ['class' => 'form-control', 'id' => 'note', 'placeholder' => 'Notes', 'size' => '30x5']) }}
                                <span class="error-message"></span>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="modal-teamMember-submit">Update</button>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Registration</h3>
                </div>
                @include('partials/nav')
            </div><!-- /. box -->


        </div>
        <div class="col-md-9">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Manage Unit</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">

                    {{ Form::open(['url' => 'team/create', 'class' => 'add-team-area', 'id' =>'team-create-form']) }}

                    <input type="hidden" name="org_id" id="org_id" value="{{ $org_id or null }}">
                    <div class="row{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            {{ Form::label('team-name', 'Name *', array( 'class' => 'control-label col-sm-3')) }}
                            {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'team-name', 'placeholder' => 'Name')) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="col-md-4 col-sm-4 col-xs-12 scout-selection">
                            {{ Form::label('team-gender', 'Gender *', array( 'class' => 'control-label col-sm-3')) }}
                            {{ Form::select('gender', array(
                                    'Male'       => 'Male',
                                    'Female'     => 'Female',
                                    'Other'      => 'Other'
                                ),null, array('class' => 'form-control', 'id' => 'team-gender')) }}
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 scout-selection">
                            {{ Form::label('team-type', 'Type *', array( 'class' => 'control-label col-sm-3')) }}
                            {{ Form::select('type', array(
                                    'Six'              => 'Six',
                                    'Patrol'           => 'Patrol',
                                    'Venture Patrol'   => 'Venture Patrol',
                                    'Crew'             => 'Crew'
                                ),null, array('class' => 'form-control', 'id' => 'team-type')) }}
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="pt15">

                        <div class="pull-right">

                            <button type="submit" class="btn btn-success" id="team-submit"><i
                                        class="fa fa-plus-circle"></i> Add Unit
                            </button>
                        </div>

                    </div>


                    {{ Form::close() }}

                    @if(isset($team))
                        <div class="table-responsive">

                            <table class="table table-bordered table-striped" id="teams-list">
                                <thead align="center">
                                <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($team as $value)
                                    <tr>
                                        <td><a class="team-name"
                                               href="{{ url( 'scouter/team', [$value->id]) }}">{{ $value->name }}</a>
                                        </td>
                                        <td>{{ $value->gender }}</td>
                                        <td>{{ $value->type }}</td>
                                        <td><a class="btn btn-success updateTeam" data-id="{{ $value->id }}">
                                                <i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger deleteTeam" data-id="{{ $value->id }}"
                                               href="{{ url( 'team/remove', [$value->id]) }}"><i
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
                <div class="box-body">
                    {{ Form::open(['url' => 'member/create', 'class' => 'form-horizontal', 'id' =>'member-create-form']) }}

                        @if(isset($team))
                            <input type="hidden" name="team_id" value="{{ $teamId or null }}" id="team_id">
                            @if(!is_null($team_name))
                                <h3 class="box-subtitle border-bottom"> Add Members to: {{ $team_name }}</h3>

                            @endif
                        @endif
                        <div class="form-group{{ $errors->has('f_name') || $errors->has('m_name') || $errors->has('l_name') ? ' has-error' : '' }}">

                            {{ Form::label('name', 'Name *', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-3">
                                {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'name', 'placeholder' => 'First Name')) }}

                                @if ($errors->has('f_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm-name', 'placeholder' => 'Middle Name')) }}

                                @if ($errors->has('m_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('m_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l-name', 'placeholder' => 'Last Name')) }}

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
                                {{ Form::text('dob', null, array('class' => 'form-control date-picker', 'id' => 'dob1', 'placeholder' => 'Date of Birth', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>


                        </div>

                        <div class="form-group{{ $errors->has('entry_date') ? ' has-error' : '' }}">

                            {{ Form::label('entry_date', 'Date of Join *', array( 'class' => 'control-label col-sm-3')) }}

                            <div class="col-sm-9">
                                {{ Form::text('entry_date', null, array('class' => 'form-control date-picker', 'id' => 'entry_date1', 'placeholder' => 'Date of Join', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                @if ($errors->has('entry_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('entry_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">

                            {{ Form::label('position', 'Current Badge Position *', array( 'class' => 'control-label col-sm-3')) }}


                            <div class="col-sm-9 scout-selection">
                                {{ Form::select('position', array(
                                    'alpha'      => 'Alpha',
                                    'beta'       => 'Beta'
                                ), null, array('class' => 'form-control', 'id' => 'position' )) }}
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

                            {{ Form::label('passed_date', 'Passed Date *', array( 'class' => 'control-label col-sm-3')) }}

                            <div class="col-sm-9">
                                {{ Form::text('passed_date', null, array('class' => 'form-control date-picker', 'id' => 'passed_date1', 'placeholder' => 'Passed Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}

                                @if ($errors->has('passed_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passed_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">

                            {{ Form::label('note', 'Notes', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('note', null, ['class' => 'form-control', 'id' => 'note', 'placeholder' => 'Notes', 'size' => '30x5']) }}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success" id="create_team_member"><i class="fa fa-plus-circle"></i> Add Member</button>
                            {{ link_to('scouter/registration', 'NEXT', array('class' => 'btn btn-default')) }}
                        </div>
                    </div>
                {{ Form::close() }}

                @if(isset($team_member) && $team_member->count())

                    <div class="row">
                        {{--<hr>--}}
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
                                        <th>Post</th>
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
                                            <td>{{ $value->post }}</td>
                                            <td><a data-toggle="tooltip" title="EDIT" class="btn btn-success updateTeamMember" data-id="{{ $value->id }}">
                                                    <i class="fa fa-pencil"></i></a>
                                                <a data-toggle="tooltip" title="DELETE" class="btn btn-danger deleteTeamMember" data-id="{{ $value->id }}"
                                                   href="{{ url( 'member/delete', [$value->id]) }}"><i
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

            </div><!-- /.box -->
        </div>

    </div>
    </div>
    </div>

@stop

@section('scripts')

    @parent
    <script>
        var index_team_url = "<?php echo url('scouter/team'); ?>";
        var update_team_url = "<?php echo url('team/update'); ?>";
        var delete_team_url = "<?php echo url('team/remove'); ?>";
        var update_teamMember_url = "<?php echo url('member/update'); ?>";
        var delete_teamMember_url = "<?php echo url('member/delete'); ?>";
        $("#dob1").inputmask();
        $("#entry_date1").inputmask();
        $("#passed_date1").inputmask();
        $("#dob").inputmask();
        $("#entry_date").inputmask();
        $("#passed_date").inputmask();

        $(".date-picker").datepicker({
            format: 'dd/mm/yyyy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:2030',
            inline: true,
            dy: true,
        });
    </script>


@stop