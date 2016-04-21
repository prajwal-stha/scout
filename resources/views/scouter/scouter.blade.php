@extends('layouts.scouter')


@section('content')

    @if(Session::has('scouter_created'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('scouter_created') }}
        </div>

    @endif

    @if(Session::has('lead_created'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('lead_created') }}
        </div>

    @endif

    @if(Session::has('scouter_updated'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('scouter_updated') }}
        </div>

    @endif


    @if(Session::has('lead_scouter_updated'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Great!</h4>
            {{ Session::get('lead_scouter_updated') }}
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
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="{{ url('/') }}"><i class="fa fa-institution"></i> Organization Detail</a></li>
                        <li><a href="{{ url('/scarf') }}"><i class="fa fa-lemon-o"></i> Scarf Detail</a></li>
                        <li><a href="{{ url('/committe') }}"><i class="fa fa-users"></i> Committe Member</a></li>
                        <li class="active"><a href="{{ url('scouter/scouter') }}"><i class="fa fa-user-plus"></i> Scouter Detail</a></li>
                        <li><a href="{{ url('/team') }}"><i class="fa fa-users"></i> Teams</a></li>
                        <li><a href="{{ url('/registration') }}"><i class="fa fa-calculator"></i> Registration Cost Detail</a></li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->


        </div>
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Scouter Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    @if(isset($leadScouter))

                        {{ Form::model($leadScouter, ['url' => ['scouter/edit-lead', $leadScouter['id']], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' =>'create-lead-scouter-form']) }}

                    @else

                        {{ Form::open(['url' => 'scouter/create-lead-scouter', 'class' => 'form-horizontal', 'id' =>'create-lead-scouter-form']) }}

                    @endif
                        <input type="hidden" name="org_id" id="org_id" value="{{ Session::get('org_id') }}">
                    <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('lead-scouter', 'Lead Scouter *', array( 'class' => 'control-label col-sm-4')) }}
                                    <div class="col-sm-8">
                                        {{ Form::select('name', formatNameOption($member), null, array('class' => 'form-control')) }}
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">

                                <div class="form-group">
                                    {{ Form::label('lead_email', 'Email *', array( 'class' => 'control-label col-sm-6')) }}

                                    <div class="col-sm-6">
                                        {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'lead_email')) }}
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">

                                    {{ Form::label('lead_perm_letter_no', 'Permission Letter No. / Date', array( 'class' => 'control-label col-sm-6')) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('permission', null, array('class' => 'form-control', 'id' => 'lead_perm_letter_no')) }}
                                        @if ($errors->has('permission'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('permission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('permission_date', null, array('class' => 'form-control date', 'id' => 'lead_perm_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                        @if ($errors->has('permission_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('permission_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                </div>

                                <div class="form-group">

                                    {{ Form::label('lead_btc_no', 'B.T.C / P.T.C No. / Date', array( 'class' => 'control-label col-sm-6')) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('btc_no', null, array('class' => 'form-control', 'id' => 'lead_btc_no')) }}

                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('btc_date', null, array('class' => 'form-control date', 'id' => 'lead_btc_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    </div>

                                </div>

                                <div class="form-group">

                                    {{ Form::label('lead_advance_no', 'Advance Certificate / Date', array( 'class' => 'control-label col-sm-6')) }}

                                    <div class="col-sm-3">
                                        {{ Form::text('advance_no', null, array('class' => 'form-control', 'id' => 'lead_advance_no')) }}

                                    </div>
                                    <div class="col-sm-3">

                                        {{ Form::text('advance_date', null, array('class' => 'form-control date', 'id' => 'lead_advance_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}

                                    </div>

                                </div>

                                <div class="form-group">

                                    {{ Form::label('lead_alt_no', 'ALT No. / Date', array( 'class' => 'control-label col-sm-6')) }}

                                    <div class="col-sm-3">

                                        {{ Form::text('alt_no', null, array('class' => 'form-control', 'id' => 'lead_alt_no')) }}

                                    </div>
                                    <div class="col-sm-3">

                                        {{ Form::text('alt_date', null, array('class' => 'form-control date', 'id' => 'lead_alt_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}

                                    </div>

                                </div>

                                <div class="form-group">

                                    {{ Form::label('lead_lt_no', 'LT No. / Date', array( 'class' => 'control-label col-sm-6')) }}

                                    <div class="col-sm-3">
                                        {{ Form::text('lt_no', null, array('class' => 'form-control', 'id' => 'lead_lt_no')) }}

                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('lt_date', null, array('class' => 'form-control date', 'id' => 'lead_lt_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right btn-lg">Save</button>
                        </div>

                    {{ Form::close() }}

                    @if(isset($scouter) && $scouter->count())

                        {{ Form::model($scouter, ['url' => ['scouter/edit', $scouter->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' =>'create-scouter-form']) }}


                    @else

                        {{ Form::open(['url' => 'scouter/create', 'class' => 'form-horizontal' ,'id' =>'create-scouter-form'])  }}

                    @endif

                        <input type="hidden" name="org_id" id="org_id" value="{{ Session::get('org_id') }}">


                        <div class="row">
                            <hr>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('asst-lead-scouter', 'Assistant Lead Scouter', array( 'class' => 'control-label col-sm-4')) }}
                                    <div class="col-sm-8">
                                        {{ Form::select('name', formatNameOption($member), null, array('class' => 'form-control')) }}
                                        @if ($errors->has('asst_lead_scouter'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">

                                <div class="form-group">
                                    {{ Form::label('email', 'Email', array( 'class' => 'control-label col-sm-6')) }}

                                    <div class="col-sm-6">
                                        {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'email')) }}
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">

                                    {{ Form::label('perm_letter_no', 'Permission Letter No. / Date', array( 'class' => 'control-label col-sm-6')) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('permission', null, array('class' => 'form-control', 'id' => 'perm_letter_no')) }}
                                        @if ($errors->has('permission'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('permission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('permission_date', null, array('class' => 'form-control date', 'id' => 'perm_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                        @if ($errors->has('permission_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('permission_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                </div>

                                <div class="form-group">

                                    {{ Form::label('btc_no', 'B.T.C / P.T.C No. / Date', array( 'class' => 'control-label col-sm-6')) }}
                                    <div class="col-sm-3">
                                        {{ Form::text('btc_no', null, array('class' => 'form-control', 'id' => 'btc_no')) }}

                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('btc_date', null, array('class' => 'form-control date', 'id' => 'btc_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    </div>


                                </div>

                                <div class="form-group">

                                    {{ Form::label('advance_no', 'Advance Certificate / Date', array( 'class' => 'control-label col-sm-6')) }}

                                    <div class="col-sm-3">
                                        {{ Form::text('advance_no', null, array('class' => 'form-control', 'id' => 'advance_no')) }}

                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('advance_date', null, array('class' => 'form-control date', 'id' => 'advance_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}


                                    </div>

                                </div>

                                <div class="form-group">

                                    {{ Form::label('alt_no', 'ALT No. / Date', array( 'class' => 'control-label col-sm-6')) }}

                                    <div class="col-sm-3">
                                        {{ Form::text('alt_no', null, array('class' => 'form-control', 'id' => 'alt_no')) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('alt_date', null, array('class' => 'form-control date', 'id' => 'alt_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    </div>

                                </div>

                                <div class="form-group">

                                    {{ Form::label('lt_no', 'LT No. / Date', array( 'class' => 'control-label col-sm-6')) }}

                                    <div class="col-sm-3">
                                        {{ Form::text('lt_no', null, array('class' => 'form-control', 'id' => 'lt_no')) }}

                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::text('lt_date', null, array('class' => 'form-control date', 'id' => 'lt_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right btn-lg">Save</button>
                        </div>
                    {{ Form::close() }}
                    </div>

                </div><!-- /.box -->

            </div>
        </div>
    </div>

@stop

@section('scripts')

    @parent
    <script>
        $(".date").inputmask();
        $( "#alt_date, #lt_date, #advance_date, #btc_date, #perm_date, #lead_alt_date, #lead_lt_date, #lead_advance_date, #lead_btc_date, #lead_perm_date" ).datepicker({
            format:'dd/mm/yyyy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:2030',
            inline: true,
            dy:true,
        });





    </script>


@stop