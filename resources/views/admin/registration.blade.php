@extends('layouts.admin')


@section('content')

    @if(Session::has('organization_deleted'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('organization_deleted') }}
        </div>

    @endif

    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>{{ $organization->name }}</li>
            <li class="active">Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert-placeholder"></div>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{ Form::model($organization, ['url' => ['admin/register', $organization->id], 'method' => 'PATCH', 'class' => 'register-form']) }}
                        <input type="hidden" name="organization_id" value="{{ $organization->id }}" id="organization_id">


                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('registration_no', 'Registration No. *') }}
                                {{ Form::text('registration_no', null, array('class' => 'form-control', 'id' => 'registration_no')) }}
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-register-submit">Register</button>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Registration Cost Detail</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

                <table id="table-registration-detail" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Number</th>
                        <th>Rate</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody id="list-registration-detail">

                    <tr>
                        <th>Unit Registration/Registration</th>
                        <td>-</td>
                        <td>{{ 'Rs. '. $rates->registration_rate }}</td>
                        <td>{{ 'Rs. '. $rates->registration_rate }}</td>
                    </tr>

                    <tr>
                        <th>Scouter</th>
                        <td>{{ $scouter }}</td>
                        <td>{{ 'Rs. '. $rates->scouter_rate }}</td>
                        <td>{{ 'Rs. ' . ($scouter * $rates->scouter_rate) }}</td>
                    </tr>

                    <tr>
                        <th>Scout</th>
                        <td>{{ $scout }}</td>
                        <td>{{ 'Rs. '. $rates->team_rate }}</td>
                        <td>{{ 'Rs. '. ($scout * $rates->team_rate) }}</td>
                    </tr>

                    <tr>
                        <th>Organization Commitee Member</th>
                        <td>{{ $member }}</td>
                        <td>{{ 'Rs. ' . $rates->committee_members_rate }}</td>
                        <td>{{ 'Rs. ' . ($member * $rates->committee_members_rate) }}</td>
                    </tr>

                    <tr>
                        <th>Disaster Management Trust</th>
                        <td>{{ $total }}</td>
                        <td>{{ 'Rs. ' . $rates->disaster_mgmt_trust_rate }}</td>
                        <td>{{ 'Rs. ' . ($total * $rates->disaster_mgmt_trust_rate) }}</td>
                    </tr>

                    </tbody>

                </table>

            </div>
            <div class="box-footer">

                    <button type="submit" class="btn btn-primary register-modal"><i class="fa fa-check-square-o"></i> Approve</button>
                    @if($organization->is_declined == false)
                        {{ Form::open(['url' => ['admin/decline', $organization->id], 'method' => 'PATCH', 'class' => 'decline-organization']) }}
                            <input type="hidden" name="organization_id" value="{{ $organization->id }}">
                            <button type="submit" data-id="{{ $organization->id }}" class="btn btn-primary decline-button"><i class="fa fa-user-times"></i> Decline</button>
                        {{ Form::close() }}
                    @endif

                    {{ link_to('scouter/print', 'PRINT', array('class' => 'btn btn-default pull-right')) }}

            </div>
        </div>

    </section>


@stop

@section( 'scripts' )

    @parent
    <script>
        var decline_url = "<?php echo url('admin/decline'); ?>";
    </script>



@stop