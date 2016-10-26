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
            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Assistant Scout Master Detail {{ isset($organization) ? ': '. $organization->name : '' }}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

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

                @if(Session::has('scouter_not_filled'))

                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Great!</h4>
                        {{ Session::get('scouter_not_filled') }}
                    </div>

                @endif

                @if(Session::has('lead_scouter_updated'))

                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Great!</h4>
                        {{ Session::get('lead_scouter_updated') }}
                    </div>

                @endif

                <div class="box-body">

                    {{--Lead scouter form end --}}
                    @if(isset($scouter) && $scouter->count())

                        {{ Form::model($scouter, ['url' => ['scouter/scouter', $scouter->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' =>'create-scouter-form']) }}


                    @else

                        {{ Form::open(['url' => 'scouter/create', 'class' => 'form-horizontal' ,'id' =>'create-scouter-form'])  }}

                    @endif

                    <input type="hidden" name="org_id" id="org_id" value="{{ $org_id or null }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('name')? ' has-error' : '' }}">
                                {{ Form::label('asst-lead-scouter', 'Assistant Scout Master', array( 'class' => 'control-label col-sm-6')) }}
                                <div class="col-sm-6 scout-selection">
                                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">

                            <div class="form-group{{ $errors->has('email')? ' has-error' : '' }}">
                                {{ Form::label('email', 'Email', array( 'class' => 'control-label col-sm-6')) }}

                                <div class="col-sm-6">
                                    {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'email', 'placeholder'  => 'Email')) }}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('permission') || $errors->has('permission_date') ? ' has-error' : '' }}">

                                {{ Form::label('perm_letter_no', 'Permission Letter No. / Date', array( 'class' => 'control-label col-sm-6')) }}
                                <div class="col-sm-3">
                                    {{ Form::text('permission', null, array('class' => 'form-control', 'id' => 'perm_letter_no', 'placeholder' => 'Permission Letter No.')) }}
                                    @if ($errors->has('permission'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('permission') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('permission_date', null, array('class' => 'form-control date', 'id' => 'perm_date', 'placeholder' => 'Date','data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    @if ($errors->has('permission_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('permission_date') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            </div>

                            <div class="form-group{{ $errors->has('btc_no') || $errors->has('btc_date') ? ' has-error' : '' }}">

                                {{ Form::label('btc_no', 'B.T.C / P.T.C No. / Date', array( 'class' => 'control-label col-sm-6')) }}
                                <div class="col-sm-3">

                                    {{ Form::text('btc_no', null, array('class' => 'form-control', 'id' => 'btc_no', 'placeholder'  => 'B.T.C / P.T.C No.')) }}

                                    @if ($errors->has('btc_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('btc_no') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('btc_date', null, array('class' => 'form-control date', 'id' => 'btc_date', 'placeholder' => 'Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    @if ($errors->has('btc_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('btc_date') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            </div>

                            <div class="form-group{{ $errors->has('advance_no') || $errors->has('advance_date') ? ' has-error' : '' }}">

                                {{ Form::label('advance_no', 'Advance Certificate / Date', array( 'class' => 'control-label col-sm-6')) }}

                                <div class="col-sm-3">
                                    {{ Form::text('advance_no', null, array('class' => 'form-control', 'id' => 'advance_no', 'placeholder'  => 'Advance No.')) }}
                                    @if ($errors->has('advance_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('advance_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('advance_date', null, array('class' => 'form-control date', 'id' => 'advance_date', 'placeholder' => 'Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    @if ($errors->has('advance_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('advance_date') }}</strong>
                                        </span>
                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('alt_no') || $errors->has('alt_date') ? ' has-error' : '' }}">

                                {{ Form::label('alt_no', 'Certificate No. / Date', array( 'class' => 'control-label col-sm-6')) }}

                                <div class="col-sm-3">
                                    {{ Form::text('alt_no', null, array('class' => 'form-control', 'id' => 'alt_no', 'placeholder'  => 'Certificate No.')) }}
                                    @if ($errors->has('alt_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('alt_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('alt_date', null, array('class' => 'form-control date', 'id' => 'alt_date', 'placeholder' => 'Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    @if ($errors->has('alt_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('alt_date') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('lt_no') || $errors->has('lt_date') ? ' has-error' : '' }}">

                                {{ Form::label('lt_no', 'Diploma No. / Date', array( 'class' => 'control-label col-sm-6')) }}

                                <div class="col-sm-3">
                                    {{ Form::text('lt_no', null, array('class' => 'form-control', 'id' => 'lt_no', 'placeholder'    => 'Diploma No.')) }}
                                    @if ($errors->has('lt_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lt_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    {{ Form::text('lt_date', null, array('class' => 'form-control date', 'id' => 'lt_date', 'placeholder' => 'Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    @if ($errors->has('lt_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lt_date') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        @if(isset($org_id))
                            @if(!$organization->isSubmitted() && !$organization->isRegistered())
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{ url('scouter/team', [$org_id]) }}" class="btn btn-default">NEXT</a>
                            @else
                                <a href="{{ url('scouter/team', [$org_id]) }}" class="btn btn-default">NEXT</a>
                            @endif

                        @endif
                    </div>
                </div>
                {{ Form::close() }}


            </div><!-- /.box -->

        </div>
    </div>
    </div>

@stop

@section('scripts')

    @parent
    <script>
        $(".date").inputmask();
        $(".date").datepicker({
            format: 'dd/mm/yyyy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:2030',
            inline: true,
            dy: true,
        });


    </script>


@stop