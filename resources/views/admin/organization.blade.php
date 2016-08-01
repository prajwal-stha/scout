@extends('layouts.admin')

@section('content')

    <section class="content">
        @if(Session::has('org_update'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('org_update') }}
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


                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Unit Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    {{ Form::model($organization, ['url' => ['admin/organization', $organization->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'organization-create-form']) }}
                        <input type="hidden" name="id" value="{{ $organization->id }}">

                        <div class="box-body">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {{ Form::label('organization-name', 'Name of Unit *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'organization-name', 'placeholder'  => 'Name of Unit')) }}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">

                                {{ Form::label('organization-type', 'Type *', array( 'class' => 'control-label col-sm-4', 'placeholder'  => 'Type')) }}
                                <div class="col-sm-4 scout-selection">
                                    {{ Form::select('type', array(
                                        'school'      => 'School / College',
                                        'other'       => 'Community'
                                    ), null, array('class' => 'form-control')) }}
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('registration_date') ? ' has-error' : '' }}">

                                {{ Form::label('registration_date', 'Organization Start Date *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('registration_date', null, array('class' => 'form-control', 'id' => 'registration_date', 'placeholder' => 'Date', 'data-inputmask' => '"alias": "dd/mm/yyyy"')) }}
                                    @if ($errors->has('registration_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('registration_date') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">

                                {{ Form::label('organization-address-1', 'Address Line 1 *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('address_line_1', null, array('class' => 'form-control', 'id' => 'address_line_1', 'placeholder'  => 'Address Line 1')) }}

                                    @if ($errors->has('address_line_1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address_line_1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address_line_2') ? ' has-error' : '' }}">

                                {{ Form::label('organization-address-2', 'Address Line 2', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('address_line_2', null, array('class' => 'form-control', 'id' => 'address_line_2', 'placeholder' => 'Address Line 2')) }}
                                    @if ($errors->has('address_line_2'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('address_line_2') }}</strong>
                                            </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">

                                {{ Form::label('district', 'District *', array( 'class' => 'control-label col-sm-4')) }}
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

                                {{ Form::label('chairman', 'Chairperson / Principal *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">

                                    {{ Form::text('chairman_f_name', null, array('class' => 'form-control', 'id' => 'chairman', 'placeholder'   => 'First Name')) }}

                                    @if ($errors->has('chairman_f_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('chairman_f_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-sm-4">
                                    {{ Form::text('chairman_l_name', null, array('class' => 'form-control', 'id' => 'chairman', 'placeholder'   => 'Last Name')) }}

                                    @if ($errors->has('chairman_l_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('chairman_l_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('chairman_mobile_no') ? ' has-error' : '' }}">

                                {{ Form::label('chairman-mobile', 'Chairperson Mobile No. *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('chairman_mobile_no', null, array('class' => 'form-control', 'id' => 'chairman-mobile', 'placeholder' => 'Mobile No.')) }}

                                    @if ($errors->has('chairman_mobile_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('chairman_mobile_no') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('chairman_gender') ? ' has-error' : '' }}">

                                {{ Form::label('chairman-gender', 'Chairperson Gender *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4 scout-selection">
                                    {{ Form::select('chairman_gender', array(
                                        'Male'       => 'Male',
                                        'Female'     => 'Female',
                                        'Other'      => 'Other'
                                        ),null, array('class' => 'form-control', 'id' => 'chairman-gender')) }}

                                    @if ($errors->has('chairman_gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('chairman_gender') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('tel_no') ? ' has-error' : '' }}">

                                {{ Form::label( 'organization-tel', 'Organization Tel No. *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('tel_no', null, array('class' => 'form-control', 'id' => 'organization-tel', 'placeholder'    => 'Tel No.')) }}

                                    @if ($errors->has('tel_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tel_no') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                {{ Form::label( 'organization-email', 'Unit Email *', array( 'class' => 'control-label col-sm-4')) }}

                                <div class="col-sm-4">
                                    {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'organization-email', 'placeholder'   => 'Email')) }}

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('background_colour') ? ' has-error' : '' }}">
                                {{ Form::label('background-colour', 'Background Colour *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">
                                    {{ Form::text('background_colour', null, array('class' => 'form-control', 'id' => 'background-colour', 'placeholder' => 'Background Color')) }}
                                    @if ($errors->has('background_colour'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('background_colour') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('border_colour') ? ' has-error' : '' }}">
                                {{ Form::label('border-colour', 'Border Colour *', array( 'class' => 'control-label col-sm-4')) }}
                                <div class="col-sm-4">

                                    {{ Form::text('border_colour', null, array('class' => 'form-control', 'id' => 'border-colour', 'placeholder' => 'Border Colour')) }}

                                    @if ($errors->has('border_colour'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('border_colour') }}</strong>
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">Save</button>
                                {{ link_to('admin/committee/'.$organization->id , 'NEXT', array('class' => 'btn btn-default')) }}
                            </div>
                        </div>


                    {{ Form::close() }}
                </div><!-- /.box -->
            </div>

        </div>

    </section>

@stop


@section('scripts')

    @parent

    <script src="{{  asset('js/parallax.js') }}"></script>
    <script>
        $("#registration_date").inputmask();
        $("#chairman-mobile").inputmask("999-999-9999", {placeholder: "#"});
        $("#organization-create-form").on('submit', function () {
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