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
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{ Form::open(['url' => 'team/update', 'method' => 'PATCH', 'class' => 'update-team-form']) }}
                    <input type="hidden" name="organization_id" value="" id="update-team-org-id">
                    <input type="hidden" name="id" value="" id="update-team-id">

                    <div class="modal-body">
                        <div class="form-group">
                            {{ Form::label('name', 'Name *') }}
                            {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'team-name')) }}
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="modal-team-submit">Update</button>
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
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{ Form::open(['url' => 'member/update', 'method' => 'PATCH', 'class' => 'form-horizontal update-teamMember-form']) }}
                        <input type="hidden" name="team_id" value="{{ $teamId or null }}" id="team_id">
                        <input type="hidden"  name="id" value="" id="teamMemberId">

                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('f-name', 'Name *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-3">
                                    {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f-name')) }}
                                </div>

                                <div class="col-sm-3">
                                    {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm-name')) }}
                                </div>

                                <div class="col-sm-3">
                                    {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l-name')) }}
                                </div>

                            </div>

                            <div class="form-group">
                                {{ Form::label('dob', 'DOB *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::text('dob', null, array('class' => 'form-control', 'id' => 'dob', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('entry_date', 'Date of Join *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::text('entry_date', null, array('class' => 'form-control', 'id' => 'entry_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('position', 'Current Level *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::select('position',
                                        array(
                                            'alpha'      => 'Alpha',
                                            'beta'       => 'Beta'
                                        ), null, array('class' => 'form-control', 'id' => 'position' )) }}
                                </div>

                            </div>

                            <div class="form-group">
                                {{ Form::label('passed_date', 'Passed Date *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::text('passed_date', null, array('class' => 'form-control', 'id' => 'passed_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('note', 'Notes', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('note', null, ['class' => 'form-control', 'id' => 'note', 'size' => '30x5']) }}
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
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                @include('partials/nav')
            </div><!-- /. box -->


        </div>
        <div class="col-md-9">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Manage Team</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">

                            {{ Form::open(['url' => 'team/create', 'class' => 'form-horizontal', 'id' =>'team-create-form']) }}

                                <input type="hidden" name="org_id" id="org_id" value="{{ Session::get('org_id') }}">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    {{ Form::label('name', 'Name', array( 'class' => 'control-label col-sm-3')) }}
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) }}
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right" id="team-submit">Save</button>
                                </div>
                            {{ Form::close() }}

                            @if(isset($team))

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
                                                <td><a class="team-name" href="{{ url( 'scouter/team', [$value->id]) }}">{{ $value->name }}</a></td>
                                                <td><a class="updateTeam" data-id="{{ $value->id }}">
                                                        <i class="fa fa-pencil"></i></a> |
                                                    <a class="deleteTeam" data-id="{{ $value->id }}" href="{{ url( 'team/remove', [$value->id]) }}"><i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @endif

                        </div>
                            <div class="col-md-8">
                                {{ Form::open(['url' => 'member/create', 'class' => 'form-horizontal', 'id' =>'member-create-form']) }}

                                @if(isset($team))
                                    <input type="hidden" name="team_id" value="{{ $teamId or null }}" id="team_id">
                                @endif
                                <div class="form-group{{ $errors->has('f_name') || $errors->has('m_name') || $errors->has('l_name') ? ' has-error' : '' }}">

                                        {{ Form::label('name', 'Name', array( 'class' => 'control-label col-sm-3')) }}
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

                                        {{ Form::label('dob', 'DOB', array( 'class' => 'control-label col-sm-3')) }}

                                        <div class="col-sm-9">
                                            {{ Form::text('dob', null, array('class' => 'form-control date-picker', 'id' => 'dob1', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}

                                            @if ($errors->has('dob'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('dob') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                    </div>

                                    <div class="form-group{{ $errors->has('entry_date') ? ' has-error' : '' }}">

                                        {{ Form::label('entry_date', 'Date of Join', array( 'class' => 'control-label col-sm-3')) }}

                                        <div class="col-sm-9">
                                            {{ Form::text('entry_date', null, array('class' => 'form-control date-picker', 'id' => 'entry_date1', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                            @if ($errors->has('entry_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('entry_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>


                                    <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">

                                        {{ Form::label('position', 'Current Level', array( 'class' => 'control-label col-sm-3')) }}


                                        <div class="col-sm-9">
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

                                    <div class="form-group{{ $errors->has('passed_date') ? ' has-error' : '' }}">

                                        {{ Form::label('passed_date', 'Passed Date', array( 'class' => 'control-label col-sm-3')) }}

                                        <div class="col-sm-9">
                                            {{ Form::text('passed_date', null, array('class' => 'form-control date-picker', 'id' => 'passed_date1', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}

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
                                            {{ Form::textarea('note', null, ['class' => 'form-control', 'id' => 'note', 'size' => '30x5']) }}
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right" id="create_team_member">Add Member</button>
                                    </div>
                                {{ Form::close() }}

                                </div>

                            </div>
                        </div>

                        @if(isset($team_member) && $team_member->count())

                            <div class="row">
                                <hr>
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped" id="team-member-list">
                                        <thead>
                                            <tr>
                                                <th>Level</th>
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
                                                    <td><a class="updateTeamMember" data-id="{{ $value->id }}">
                                                            <i class="fa fa-pencil"></i></a> |
                                                        <a class="deleteTeamMember" data-id="{{ $value->id }}" href="{{ url( 'member/delete', [$value->id]) }}"><i class="fa fa-trash-o"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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

        $( ".date-picker" ).datepicker({
            format:'dd/mm/yyyy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:2030',
            inline: true,
            dy:true,
        });
    </script>


@stop