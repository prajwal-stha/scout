@extends('layouts.admin')


@section('content')

    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>{{ $organization->name }}</li>
            <li class="active">Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

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
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Approve</button>
                {{ link_to('scouter/print', 'PRINT', array('class' => 'btn btn-default pull-right')) }}
            </div>
        </div>

    </section>


@stop

@section( 'scripts' )

    @parent



@stop