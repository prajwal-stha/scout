@extends('layouts.admin')

@section('content')

    <section class="content">


        @if(Session::has('lead_scouter_updated'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('lead_scouter_updated') }}
            </div>

        @endif
        <div class="row">
            <div class="col-md-4">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $organization->name }}</h3>
                    </div>
                    @include('partials/admin_nav')
                </div><!-- /. box -->

            </div>
            <div class="col-md-8">

                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lead Scouter Detail</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    {{ Form::model($leadScouter, ['url' => ['admin/lead', $leadScouter['id']], 'method' => 'PATCH', 'class' => 'form-horizontal']) }}
                        <div class="box-body">
                            <input type="hidden" name="org_id" id="org_id" value="{{ $organization->id }}">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {{ Form::label('lead-scouter', 'Lead Scouter *', array( 'class' => 'control-label col-sm-6')) }}
                                        <div class="col-sm-6 scout-selection">
                                            {{ Form::select('name', formatNameOption($member), null, array('class' => 'form-control')) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
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


                                    <div class="form-group{{ $errors->has('permission') || $errors->has('permission_date') ? ' has-error' : '' }}">

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

                                    <div class="form-group{{ $errors->has('btc_no') || $errors->has('btc_date') ? ' has-error' : '' }}">

                                        {{ Form::label('lead_btc_no', 'B.T.C / P.T.C No. / Date', array( 'class' => 'control-label col-sm-6')) }}
                                        <div class="col-sm-3">
                                            {{ Form::text('btc_no', null, array('class' => 'form-control', 'id' => 'lead_btc_no')) }}
                                            @if ($errors->has('btc_no'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('btc_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            {{ Form::text('lead_btc_date', null, array('class' => 'form-control date', 'id' => 'lead_btc_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                            @if ($errors->has('btc_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('btc_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                    </div>

                                    <div class="form-group{{ $errors->has('advance_no') || $errors->has('advance_date') ? ' has-error' : '' }}">

                                        {{ Form::label('lead_advance_no', 'Advance Certificate / Date', array( 'class' => 'control-label col-sm-6')) }}

                                        <div class="col-sm-3">
                                            {{ Form::text('advance_no', null, array('class' => 'form-control', 'id' => 'lead_advance_no')) }}

                                            @if ($errors->has('advance_no'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('advance_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">

                                            {{ Form::text('advance_date', null, array('class' => 'form-control date', 'id' => 'lead_advance_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                            @if ($errors->has('advance_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('advance_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group{{ $errors->has('alt_no') || $errors->has('alt_date') ? ' has-error' : '' }}">

                                        {{ Form::label('lead_alt_no', 'ALT No. / Date', array( 'class' => 'control-label col-sm-6')) }}

                                        <div class="col-sm-3">

                                            {{ Form::text('alt_no', null, array('class' => 'form-control', 'id' => 'lead_alt_no')) }}
                                            @if ($errors->has('alt_no'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('alt_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">

                                            {{ Form::text('alt_date', null, array('class' => 'form-control date', 'id' => 'lead_alt_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                            @if ($errors->has('alt_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('alt_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group{{ $errors->has('lt_no') || $errors->has('lt_date')? ' has-error' : '' }}">

                                        {{ Form::label('lead_lt_no', 'LT No. / Date', array( 'class' => 'control-label col-sm-6')) }}

                                        <div class="col-sm-3">
                                            {{ Form::text('lt_no', null, array('class' => 'form-control', 'id' => 'lead_lt_no')) }}
                                            @if ($errors->has('lt_no'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lt_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            {{ Form::text('lt_date', null, array('class' => 'form-control date', 'id' => 'lead_lt_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
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
                            <button type="submit" class="btn btn-success ">Save</button>
                            {{ link_to('admin/scouter/'.$organization->id, 'NEXT', array('class' => 'btn btn-default pull-right')) }}
                        </div>

                    {{ Form::close() }}


                </div><!-- /.box -->
            </div>
        </div>

    </section>



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
