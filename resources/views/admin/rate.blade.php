@extends('layouts.admin')

@section('content')

    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Rate</li>
        </ol>
    </section>


    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('rate_created'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Great!</strong> {{ Session::get('rate_created') }}<br><br>
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
                    @if(isset($rates))
                        {{--<form role="form" action="{{  url('rate/create-rate') }}" method="post">--}}
                        {{ Form::open(['url' => 'rate/edit-rate']) }}
                    @else
                        {{--<form role="form" action="{{  url('rate/edit-rate') }}" method="post">--}}
                        {{ Form::model($rates, ['url' => 'rate/create-rate']) }}
                    @endif

                        {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Registration Fees</label>
                                    <input type="text" class="form-control" name="registration_rate" value="{{ old('registration_rate') }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Scouter Registration Fees</label>
                                    <input type="text" class="form-control" name="scouter_rate" value="{{ old('scouter_rate') }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Member Registration Fees</label>
                                    <input type="text" class="form-control" name="team_rate" value="{{ old('team_rate') }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Committee Registration Fees</label>
                                    <input type="text" class="form-control" name="committee_members_rate" value="{{ old('committee_members_rate') }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Disaster Management Trust</label>
                                    <input type="text" class="form-control" name="disaster_mgmt_trust_rate" value="{{ old('disaster_mgmt_trust_rate') }}">
                                </div>

                            </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div><!-- /.box -->

            </div>
        </div>
    </section>

@stop

@section('scripts')

    @parent

@stop