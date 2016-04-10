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
                <form role="form" action="{{ url('scouter/create') }}" method="post" id="scouter-create-form" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="lead-scouter">Lead Scouter *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="lead-scouter">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="email">Email</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">Permission Letter No. / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="perm_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>


                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">B.T.C / P.T.C No. / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="btc_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>


                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">Advance Certificate / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="btc_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">ALT No. / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="btc_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">L.T Diploma / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="btc_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="organization-name">Assistant Lead Scouter *</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="lead-scouter">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="email">Email</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-6" for="organization-start">Permission Letter No. / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="perm_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">B.T.C / P.T.C No. / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="btc_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>


                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">Advance Certificate / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="btc_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">ALT No. / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="btc_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-sm-6" for="organization-start">L.T Diploma / Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" placeholder="Letter No." name="btc_letter_no">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                    </div>

                                </div>

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