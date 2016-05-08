@extends('layouts.scouter')


@section('content')



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
                    <h3 class="box-title">Organization Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                @if(Session::has('no_org'))

                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        {{ Session::get('no_org') }}
                    </div>

                @endif

                @if(Session::has('org_submitted'))

                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Great!</h4>
                        {{ Session::get('org_submitted') }}
                    </div>

                @endif

                @if(isset($org_id))

                    {{ Form::model($organization, ['url' => ['organizations/edit', $organization->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'organization-create-form']) }}
                    <input type="hidden" name="id" value="{{ $org_id }}">
                @else

                    {{ Form::open(['url' => 'organizations/create', 'class' => 'form-horizontal', 'id' =>'organization-create-form']) }}

                @endif
                <div class="box-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('organization-name', 'Name of Organization *', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4">
                            {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'organization-name')) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">

                        {{ Form::label('organization-type', 'Type *', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4 scout-selection">
                            {{ Form::select('type', array(
                                'school'      => 'School',
                                'other'       => 'Organization'
                            ), null, array('class' => 'form-control')) }}
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('registration_date') ? ' has-error' : '' }}">

                        {{ Form::label('registration_date', 'Organization Start Date *', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4">
                            {{ Form::text('registration_date', null, array('class' => 'form-control', 'id' => 'registration_date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                            @if ($errors->has('registration_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('registration_date') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">

                        {{ Form::label('organization-address-1', 'Address Line 1 *', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4">
                            {{ Form::text('address_line_1', null, array('class' => 'form-control', 'id' => 'address_line_1')) }}

                            @if ($errors->has('address_line_1'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('address_line_1') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address_line_2') ? ' has-error' : '' }}">

                        {{ Form::label('organization-address-2', 'Address Line 2', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4">
                            {{ Form::text('address_line_2', null, array('class' => 'form-control', 'id' => 'address_line_2')) }}
                            @if ($errors->has('address_line_2'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('address_line_2') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">

                        {{ Form::label('district', 'District *', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4 scout-selection">
                            {{ Form::select('district',formatOption($district) , null, array('class' => 'form-control')) }}

                            @if ($errors->has('district'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('district') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('chairman_f_name') || $errors->has('chairman_l_name') ? ' has-error' : '' }}">

                        {{ Form::label('chairman', 'Chairman / Principal *', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4">

                            {{ Form::text('chairman_f_name', null, array('class' => 'form-control', 'id' => 'chairman')) }}

                            @if ($errors->has('chairman_f_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('chairman_f_name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            {{ Form::text('chairman_l_name', null, array('class' => 'form-control', 'id' => 'chairman')) }}

                            @if ($errors->has('chairman_l_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('chairman_l_name') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('chairman_mobile_no') ? ' has-error' : '' }}">

                        {{ Form::label('chairman-mobile', 'Chairman Mobile No. *', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4">
                            {{ Form::text('chairman_mobile_no', null, array('class' => 'form-control', 'id' => 'chairman-mobile')) }}

                            @if ($errors->has('chairman_mobile_no'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('chairman_mobile_no') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('tel_no') ? ' has-error' : '' }}">

                        {{ Form::label( 'organization-tel', 'Organization Tel No. *', array( 'class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-4">
                            {{ Form::text('tel_no', null, array('class' => 'form-control', 'id' => 'organization-tel')) }}

                            @if ($errors->has('tel_no'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('tel_no') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        {{ Form::label( 'organization-email', 'Organization Email *', array( 'class' => 'control-label col-sm-3')) }}

                        <div class="col-sm-4">
                            {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'organization-email')) }}

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">Save</button>
                        {{ link_to('scouter/scarf', 'NEXT', array('class' => 'btn btn-default')) }}
                    </div>
                </div>

                {{ Form::close() }}
            </div><!-- /.box -->

        </div>
    </div>

@stop

@section('scripts')

    @parent
    <script src="{{  asset('js/parallax.js') }}"></script>
    <script>
        $("#registration_date").inputmask();
        $("#chairman-mobile").inputmask("999-999-9999", {placeholder: "#"});
        $("#organization-create-form").submit(function () {
            $('.help-block').each(function () {
                $(this).remove();
            });
            if ($(this).find('.help-block').length > 0) {
                var scrolto = $('#organization-create-form').find('.help-block:first').parent();
                $('html,body').animate({
                            scrollTop: $(scrolto).offset().top
                        }, 2000
                );
                return false;
            }
        });
        $("#registration_date").datepicker({
            format: 'dd/mm/yyyy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:2030',
            inline: true,
            dy: true,
        });
    </script>

@stop