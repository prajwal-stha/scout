@extends('layouts.admin')


@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $registered_users or 0 }}</h3>
                        <p>Registered Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $approved_organizations }}</h3>
                        <p>Approved Organizations</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-institution"></i>
                    </div>
                    <a href="{{ url('admin/approved-organizations') }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $declined_organizations }}</h3>
                        <p>Declined Organizations</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-institution"></i>
                    </div>
                    <a href="{{ url('admin/declined-organizations') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->

        <div class="row">
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Approved Organizations</h3>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="table-approved-user-org" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Organization</th>
                                </tr>
                                </thead>
                                <tbody id="list-user-orgs">

                                    @foreach($users as $user)
                                        @if(count($user->core_organizations) > 0)

                                            <tr>
                                                <td><a data-toggle="tooltip" title="VIEW USER" class="" href="{{ url('admin/profile', [$user->id]) }}">{{ $user->f_name }} {{ $user->l_name }}</a></td>
                                                <td>
                                                    <?php $i = 0; ?>

                                                    @foreach($user->core_organizations as $organization)
                                                        <?php
                                                            $i++;
                                                            $count = count($user->core_organizations); ?>

                                                        <a data-toggle="tooltip" title="VIEW ORG" href="{{ url('admin/view-approved-organization', [$organization->original_id]) }}">{{ $organization->name }} {{ $i != $count ? ', ' : '' }}</a>

                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rates</h3>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="table-rates" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Rate</th>
                                </tr>
                                </thead>
                                <tbody id="list-rates">

                                <tr>
                                    <th>Unit Registration / Registration</th>
                                    <td>{{ 'Rs. '. $rates->registration_rate }}</td>
                                </tr>

                                <tr>
                                    <th>Scouter (Male / Female)</th>
                                    <td>{{ 'Rs. '. $rates->scouter_rate }}</td>
                                </tr>

                                <tr>
                                    <th>Scout</th>
                                    <td>{{ 'Rs. '. $rates->team_rate }}</td>
                                </tr>

                                <tr>
                                    <th>Organization Commitee Member</th>
                                    <td>{{ 'Rs. '. $rates->committee_members_rate }}</td>
                                </tr>

                                <tr>
                                    <th>Disaster Management Trust</th>
                                    <td>{{ 'Rs. '. $rates->disaster_mgmt_trust_rate }}</td>
                                </tr>

                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>
            </div>


            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Declined Organizations</h3>
                    </div>
                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="table-user-org" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Organization</th>
                                </tr>
                                </thead>
                                <tbody id="list-user-orgs">

                                    @foreach($users as $user)
                                        @if(count($user->organizations->where('is_declined', 1)) > 0 )

                                            <tr>
                                                <td><a data-toggle="tooltip" title="VIEW USER" class="" href="{{ url('admin/profile', [$user->id]) }}">{{ $user->f_name }} {{ $user->l_name }}</a></td>
                                                <td>
                                                    <?php $i = 0; ?>
                                                    @foreach($user->organizations->where('is_declined', 1) as $organization)
                                                        <?php
                                                        $i++;
                                                        $count = count($user->organizations->where('is_declined', 1)); ?>
                                                        <a data-toggle="tooltip" title="VIEW ORG" href="{{ url('admin/view-organization', [$organization->id]) }}">{{ $organization->name }}{{ $i != $count ? ', ' : '' }}</a>

                                                    @endforeach

                                                </td>
                                            </tr>

                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->

@stop

@section('scripts')
    @parent

    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>

        $('#table-approved-user-org').DataTable({
            "paging": true,
            "pageLength": 8,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $('#table-user-org').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    </script>

@stop