@extends('layouts.scouter')


@section('content')


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
                        <li class="active"><a href="{{ url('/') }}"><i class="fa fa-institution"></i> Organization Detail</a></li>
                        <li><a href="{{ url('/scarf') }}"><i class="fa fa-lemon-o"></i> Scarf Detail</a></li>
                        <li><a href="{{ url('/committe') }}"><i class="fa fa-users"></i> Committe Member</a></li>
                        <li><a href="{{ url('scouter/scouter') }}"><i class="fa fa-user-plus"></i> Scouter Detail</a></li>
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
                    <h3 class="box-title">Organization Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('organizations/create') }}" method="post" id="organization-create-form" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-sm-3" for="organization-name">Name of Organization</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-name" placeholder="Organization Name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="organization-type">Type</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="organization-type" name="type">
                                    <option>Select</option>
                                    <option value="school">School</option>
                                    <option value="other">Organization</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                             </div>
                        </div>


                        <div class="form-group{{ $errors->has('registration_date') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="organization-start">Organization Start Date</label>
                            <div class="col-sm-4">
                                <input type="text" id="organization-start" name="registration_date" value="{{ old('registration_date') }}" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                @if ($errors->has('registration_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registration_date') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="organization-address-1">Address Line 1</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-address-1" placeholder="Address Line 1" name="address_line_1" value="{{ old('address_line_1') }}">
                                @if ($errors->has('address_line_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address_line_2') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="organization-address-2">Address Line 2</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-address-2" placeholder="Address Line 2" name="address_line_2" value="{{ old('address_line_2') }}">
                                @if ($errors->has('address_line_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_2') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="district">District</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="district" name="district">
                                    <option>Select</option>
                                    @if(!empty($district))
                                        @foreach($district as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('district'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('chairman_f_name') || $errors->has('chairman_l_name') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="chairman">Chairman / Principal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="chairman" placeholder="First Name" name="chairman_f_name" value="{{ old('chairman_f_name') }}">
                                @if ($errors->has('chairman_f_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('chairman_f_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="chairman" placeholder="Last Name" name="chairman_l_name" value="{{ old('chairman_l_name') }}">
                                @if ($errors->has('chairman_l_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('chairman_l_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('chairman_mobile_no') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="chairman-mobile">Chairman Mobile No.</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="chairman-mobile" placeholder="Chairman Mobile No." name="chairman_mobile_no" value="{{ old('chairman_mobile_no') }}">
                                @if ($errors->has('chairman_mobile_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('chairman_mobile_no') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('tel_no') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="organization-tel">Organization Tel No.</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-tel" placeholder="Organization Tel No." name="tel_no" value="{{ old('tel_no') }}">
                                @if ($errors->has('tel_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tel_no') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <label class="control-label col-sm-3" for="organization-email">Organization Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-email" placeholder="Organization Email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right btn-lg">Save</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->

        </div>
    </div>

@stop

@section('scripts')

    @parent
    <script src="{{  asset('input-mask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{  asset('js/parallax.js') }}"></script>
    <script>
        $("[data-mask]").inputmask();
        $("#organization-create-form").submit(function() {
            if ($(this).find('font[class="error"]').length > 0) {
                var scrolto = $('#organization-create-form').find('font[class="error"]:first').parent();
                $('html,body').animate({
                    scrollTop: $(scrolto).offset().top}, 2000
                );
                return false;
            }
        });
        $( "#organization-start" ).datepicker({
            startDate: new Date(),
            format:'dd/mm/yyyy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:2030',
            inline: true,
            dy:true,
        });
    </script>

@stop