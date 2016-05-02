@extends('layouts.admin')

@section('content')

    <section class="content">

        @if(Session::has('rate_created'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('rate_created') }}
            </div>

        @endif

        @if(Session::has('rates_updated'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('rates_updated') }}
            </div>

        @endif
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Subscription Rates</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    @if($rates)

                        {{ Form::model($rates, ['url' => ['rate/edit', $rates['id']], 'method' => 'PATCH', 'class' => 'rate-form']) }}

                    @else

                        {{ Form::open(['url' => 'rate/create'], ['class' => 'rate-form']) }}

                    @endif

                        <div class="box-body">
                            <div class="form-group{{ $errors->has('registration_rate') ? ' has-error' : ''}}">
                                {{ Form::label('registration_rate', 'Registration Fees') }}
                                {{ Form::text('registration_rate', null, array('class' => 'form-control money')) }}
                                @if ($errors->has('registration_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registration_rate') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('scouter_rate') ? ' has-error' : ''}}">

                                {{ Form::label('scouter_rate', 'Scouter Registration Fees') }}
                                {{ Form::text('scouter_rate', null, array('class' => 'form-control money')) }}

                                @if ($errors->has('scouter_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('scouter_rate') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('team_rate') ? ' has-error' : ''}}">

                                {{ Form::label('team_rate', 'Member Registration Fees') }}
                                {{ Form::text('team_rate', null, array('class' => 'form-control money')) }}

                                @if ($errors->has('team_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team_rate') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('committee_members_rate') ? ' has-error' : ''}}">

                                {{ Form::label('committee_members_rate', 'Committee Registration Fees') }}
                                {{ Form::text('committee_members_rate', null, array('class' => 'form-control money')) }}

                                @if ($errors->has('committee_members_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('committee_members_rate') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{ $errors->has('disaster_mgmt_trust_rate') ? ' has-error' : ''}}">

                                {{ Form::label('disaster_mgmt_trust_rate', 'Disaster Management Trust') }}
                                {{ Form::text('disaster_mgmt_trust_rate', null, array('class' => 'form-control money')) }}

                                @if ($errors->has('disaster_mgmt_trust_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('disaster_mgmt_trust_rate') }}</strong>
                                    </span>
                                @endif

                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    {{ Form::close() }}

                </div><!-- /.box -->

            </div>
        </div>
    </section>

@stop

@section('scripts')

    @parent
    <script src="{{  asset('input-mask/jquery.inputmask.bundle.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".money").inputmask("decimal", {
                radixPoint: ".",
                groupSeparator: ",",
                digits: 10,
                autoGroup: true,
                prefix: 'Rs. ',
                rightAlign: false,
                autoUnmask: true,
                removeMaskOnSubmit: true
            });

        });
    </script>

@stop