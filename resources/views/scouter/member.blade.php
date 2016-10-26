@extends('layouts.scouter')


@section('content')
    @if(Session::has('checkCriteria'))

        <div class="alert alert-success alert-dismissable scout">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4 style="display: inline; "><i class="icon fa fa-info"></i></h4>
            <p style="display: inline; ">{{ Session::pull('checkCriteria') }}</p>
            <a href="{{ url('scouter/registration', [$organization->id]) }}" class="btn bg-maroon btn-flat margin">Submit for Review</a>

        </div>

    @endif

    <div class="modal" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="alert-placeholder"></div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


                {{ Form::open(['url' => 'organizations/update-member', 'method' => 'PATCH', 'class' => 'update-member-form']) }}
                    <input type="hidden" name="organization_id" value="" id="update-member-org-id">
                    <input type="hidden" name="id" value="" id="update-member-id">

                    <div class="modal-body">
                        <div class="form-group">
                            {{ Form::label('f_name', 'First Name *') }}
                            {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f_name', 'placeholder'  => 'First Name')) }}
                            <span class="error-message"></span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('m_name', 'Middle Name') }}
                            {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm_name', 'placeholder'  => 'Middle Name')) }}
                            <span class="error-message"></span>
                        </div>

                        <div class="form-group">
                            {{ Form::label('l_name', 'Last Name *') }}
                            {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l_name', 'placeholder'  => 'Last Name')) }}
                            <span class="error-message"></span>
                        </div>
                        <div class="form-group scout-selection">
                            {{ Form::label('gender', 'Gender *') }}
                            {{ Form::select('gender',array(
                                    'Male'       => 'Male',
                                    'Female'     => 'Female',
                                    'Other'      => 'Other'
                                ), null, array('class' => 'form-control', 'id' => 'gender')) }}
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
                    <h3 class="box-title">Committee Member Detail {{ isset($organization) ? ': '. $organization->name : '' }}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                @if(Session::has('member_created'))

                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Great!</h4>
                        {{ Session::get('member_created') }}
                    </div>

                @endif


                @if(Session::has('member_not_filled'))

                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Error!!</h4>
                        {{ Session::get('member_not_filled') }}
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


                @if(isset($org_id))
                    @if(!$organization->isSubmitted() && !$organization->isRegistered())

                        {{ Form::open(['url' => 'organizations/member', 'class' => 'form-horizontal', 'id' =>'member-create-form']) }}
                        <input type="hidden" name="organization_id" id="org_id" value="{{ $org_id or null }}">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('f_name') ? ' has-error' : '' }}">
                                {{ Form::label('f-name', 'First Name *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f-name', 'placeholder'  => 'First Name')) }}
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
                                    {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm-name', 'placeholder'  => 'Middle Name')) }}
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
                                    {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l-name', 'placeholder'  => 'Last Name')) }}
                                    @if ($errors->has('l_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('l_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                {{ Form::label('member-gender', 'Gender *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-4 scout-selection">
                                    {{ Form::select('gender',array(
                                            'Male'       => 'Male',
                                            'Female'     => 'Female',
                                            'Other'      => 'Other'
                                        ), null, array('class' => 'form-control', 'id' => 'member-gender')) }}

                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="box-footer border-bottom">

                            <div class="pull-right">
                                <button type="submit" class="btn btn-success" id="member-submit">Save</button>
                                <a href="{{ url('scouter/lead-scouter', [$org_id]) }}" class="btn btn-default">NEXT</a>

                            </div>

                        </div>

                        {{ Form::close() }}
                    @endif
                @else
                    {{ Form::open(['url' => 'organizations/member', 'class' => 'form-horizontal', 'id' =>'member-create-form']) }}
                        <input type="hidden" name="organization_id" id="org_id" value="{{ $org_id or null }}">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('f_name') ? ' has-error' : '' }}">
                                {{ Form::label('f-name', 'First Name *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f-name', 'placeholder'  => 'First Name')) }}
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
                                    {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm-name', 'placeholder'  => 'Middle Name')) }}
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
                                    {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l-name', 'placeholder'  => 'Last Name')) }}
                                    @if ($errors->has('l_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('l_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                {{ Form::label('member-gender', 'Gender *', array( 'class' => 'control-label col-sm-3')) }}
                                <div class="col-sm-4 scout-selection">
                                    {{ Form::select('gender',array(
                                            'Male'       => 'Male',
                                            'Female'     => 'Female',
                                            'Other'      => 'Other'
                                        ), null, array('class' => 'form-control', 'id' => 'member-gender')) }}

                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="box-footer border-bottom">

                            <div class="pull-right">
                                @if(!$organization->isSubmitted() && !$organization->isRegistered())
                                    <button type="submit" class="btn btn-success" id="member-submit">Save</button>
                                @endif
                                {{ link_to('scouter/lead-scouter', 'NEXT', array('class' => 'btn btn-default')) }}
                            </div>

                        </div>

                    {{ Form::close() }}
                @endif

                @if(!empty($member))

                    <div class="box-body">
                        <form action="{{ url('organizations/remove') }}" method="post" id="remove_many_members">
                            {{ csrf_field() }}
                            <table id="table-member" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    @if(isset($org_id))
                                        @if(!$organization->isSubmitted() && !$organization->isRegistered())

                                            <th><input name="action_to_all" type="checkbox" class="check-all"></th>
                                        @endif
                                    @else
                                        <th><input name="action_to_all" type="checkbox" class="check-all"></th>
                                    @endif

                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    @if(isset($org_id))
                                        @if(!$organization->isSubmitted() && !$organization->isRegistered())

                                            <th>Action</th>
                                        @endif
                                    @else
                                        <th>Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody id="list-member">
                                @foreach($member as $value)
                                    <tr>
                                        @if(isset($org_id))
                                            @if(!$organization->isSubmitted() && !$organization->isRegistered())

                                                <td><input class="check-row" name="action_to[]" type="checkbox"
                                                           value="{{ $value->id }}"></td>
                                            @endif
                                        @else
                                            <td><input class="check-row" name="action_to[]" type="checkbox"
                                                       value="{{ $value->id }}"></td>
                                        @endif
                                        <td>{{ $value->f_name }}</td>
                                        <td>{{ $value->m_name }}</td>
                                        <td>{{ $value->l_name }}</td>
                                        @if(isset($org_id))
                                            @if(!$organization->isSubmitted() && !$organization->isRegistered())

                                                <td>
                                                    <a data-toggle="tooltip" title="EDIT" class="btn btn-success updateMember" data-id="{{ $value->id }}">
                                                        <i class="fa fa-pencil"></i></a>
                                                    <a data-toggle="tooltip" title="DELETE" class="btn btn-danger deleteMember" data-id="{{ $value->id }}"
                                                       href="{{ url( 'organizations/delete-member', [$value->id]) }}"><i
                                                                class="fa fa-trash-o"></i></a>
                                                </td>
                                            @endif
                                        @else
                                            <td>
                                                <a data-toggle="tooltip" title="EDIT" class="btn btn-success updateMember" data-id="{{ $value->id }}">
                                                    <i class="fa fa-pencil"></i></a>
                                                <a data-toggle="tooltip" title="DELETE" class="btn btn-danger deleteMember" data-id="{{ $value->id }}"
                                                   href="{{ url( 'organizations/delete-member', [$value->id]) }}"><i
                                                            class="fa fa-trash-o"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                            @if(isset($org_id))
                                @if(!$organization->isSubmitted() && !$organization->isRegistered())

                                    <div class="btn-toolbar list-toolbar">
                                        <button class="btn btn-danger" name="mass-delete" type="submit" id="delete-submit">
                                            <i class="fa fa-trash-o"></i>Delete
                                        </button>
                                    </div>
                                @endif

                            @else
                                <div class="btn-toolbar list-toolbar">
                                    <button class="btn btn-danger" name="mass-delete" type="submit" id="delete-submit">
                                        <i class="fa fa-trash-o"></i>Delete
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                    @if(isset($org_id))
                        @if($organization->isSubmitted() && $organization->isRegistered())
                            <div class="box-footer">
                                <div class="pull-right">
                                    <a href="{{ url('scouter/lead-scouter', [$org_id]) }}" class="btn btn-default">NEXT</a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif

            </div><!-- /.box -->

        </div>

    </div>
@stop

@section('scripts')

    @parent
    <script>
        var index_member_url = "<?php echo isset($organization) ? url('scouter/committe', $organization->id) : url('scouter/committe'); ?>";
        console.log(index_member_url);
        var update_member_url = "<?php echo url('organizations/update-member'); ?>";
        var delete_member_url = "<?php echo url('organizations/delete-member'); ?>";
    </script>


@stop