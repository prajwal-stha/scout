@extends('layouts.scouter')


@section('content')


    @if(Session::has('team_updated'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('team_updated') }}
        </div>

    @endif

    <div class="modal" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
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
    <div class="row">
        <div class="col-md-3">

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Registration</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="{{ url('/') }}"><i class="fa fa-institution"></i> Organization Detail</a></li>
                        <li><a href="{{ url('/scarf') }}"><i class="fa fa-lemon-o"></i> Scarf Detail</a></li>
                        <li><a href="{{ url('/committe') }}"><i class="fa fa-users"></i> Committe Member</a></li>
                        <li><a href="{{ url('scouter/scouter') }}"><i class="fa fa-user-plus"></i> Scouter Detail</a></li>
                        <li class="active"><a href="{{ url('/team') }}"><i class="fa fa-users"></i> Teams</a></li>
                        <li><a href="{{ url('/registration') }}"><i class="fa fa-calculator"></i> Registration Cost Detail</a></li>
                    </ul>
                </div><!-- /.box-body -->
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

                                <div class="form-group">
                                    {{ Form::label('team-name', 'Team Name *', array( 'class' => 'control-label col-sm-4')) }}
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

                                <table class="table table-bordered table-striped">
                                    <thead align="center">
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($team as $value)
                                            <tr>
                                                <td>{{ $value->name }}</td>
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
                                <form class="form-horizontal">

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="email">Name</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="email" placeholder="First" name="f_name" value="{{ old('f_name') }}">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="email" placeholder="Middle" name="m_name" value="{{ old('email') }}">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="email" placeholder="Last" name="l_name" value="{{ old('l_name') }}">
                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">DOB</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                        </div>


                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">Date of Join</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">Current Level</label>

                                        <div class="col-sm-9">
                                            <select class="form-control">
                                                <option>Select</option>
                                            </select>
                                        </div>


                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">Passed Date</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                        </div>


                                    </div>


                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">Notes</label>

                                        <div class="col-sm-9">
                                            <textarea id="organization-start" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right">Add Member</button>
                                    </div>
                                </form>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-md-12">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>Date of Join</th>
                                            <th>Passed Date</th>
                                            <th>Notes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>P.L</td>
                                            <td>John Doe</td>
                                            <td>12/09/1990</td>
                                            <td>13/08/2011</td>
                                            <td>04/07/2013</td>
                                            <td>lorem ipsum</td>
                                            <td><i class="fa fa-pencil"></i> |
                                                <i class="fa fa-trash-o"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div><!-- /.box -->
                </div>

            </div>
        </div>
    </div>

@stop

@section('scripts')

    @parent

    <script src="{{  asset('input-mask/jquery.inputmask.bundle.js') }}"></script>
    <script>
        var update_team_url = "<?php echo url('team/update'); ?>";
        console.log(update_team_url);
        $("[data-mask]").inputmask();
    </script>


@stop