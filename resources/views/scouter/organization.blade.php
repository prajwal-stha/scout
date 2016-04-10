@extends('layouts.scouter')


@section('content')
        <!-- Small boxes (Stat box) -->
    @if (count($errors) > 0)

        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Whoops!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="organization-name">Name of Organization</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-name" placeholder="Organization Name" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="organization-type">Type</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="organization-type" name="type">
                                    <option>Select</option>
                                    <option value="school">School</option>
                                    <option value="other">Organization</option>
                                </select>
                             </div>
                        </div>


                        <div class="form-group">

                            <label class="control-label col-sm-3" for="organization-start">Organization Start Date</label>
                            <div class="col-sm-4">
                                <input type="text" id="organization-start" name="registration_date" value="{{ old('registration_date') }}" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="organization-address-1">Address Line 1</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-address-1" placeholder="Address Line 1" name="address_line_1" value="{{ old('address_line_1') }}">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="organization-address-2">Address Line 2</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-address-2" placeholder="Address Line 2" name="address_line_2" value="{{ old('address_line_2') }}">
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="district">District</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="district" name="district">
                                    <option>Select</option>
                                    @if(!empty($district))
                                        @foreach($district as $value)
                                            <option value="{{ $value->district_code }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="chairman">Chairman / Principal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="chairman" placeholder="First Name" name="chairman_f_name" value="{{ old('chairman_f_name') }}">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="chairman" placeholder="Last Name" name="chairman_l_name" value="{{ old('chairman_l_name') }}">
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="chairman-mobile">Chairman Mobile No.</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="chairman-mobile" placeholder="Chairman Mobile No." name="chairman_mobile_no" value="{{ old('chairman_mobile_no') }}">
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="organization-tel">Organization Tel No.</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-tel" placeholder="Organization Tel No." name="tel_no" value="{{ old('tel_no') }}">
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="organization-email">Organization Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="organization-email" placeholder="Organization Email" name="email" value="{{ old('email') }}">
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
    <script>
        $("[data-mask]").inputmask();
    </script>

@stop