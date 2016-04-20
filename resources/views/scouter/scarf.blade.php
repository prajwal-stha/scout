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
                        <li class="active"><a href="{{ url('/scarf') }}"><i class="fa fa-lemon-o"></i> Scarf Detail</a></li>
                        <li><a href="{{ url('/committe') }}"><i class="fa fa-users"></i> Committe Member</a></li>
                        <li><a href="{{ url('scouter') }}"><i class="fa fa-user-plus"></i> Scouter Detail</a></li>
                        <li><a href="{{ url('/team') }}"><i class="fa fa-users"></i> Teams</a></li>
                        <li><a href="{{ url('/registration') }}"><i class="fa fa-calculator"></i> Registration Cost Detail</a></li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->

        </div>
        <div class="col-md-8">
            @if(Session::has('district_updated'))

                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Great!</h4>
                    {{ Session::get('district_updated') }}
                </div>

            @endif

            @if(Session::has('scarf_update'))

                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Great!</h4>
                    {{ Session::get('scarf_update') }}
                </div>

            @endif

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Scarf Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                @if(isset($org_id))

                    {{ Form::model($organization, ['url' => ['organizations/edit-scarf', $org_id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'scarf-create-form']) }}

                @else

                    {{ Form::open(['url' => 'organizations/scarf', 'class' => 'form-horizontal', 'id' =>'scarf-create-form']) }}

                @endif
                    <input type="hidden" name="org_id" id="org_id" value="{{ Session::get('org_id') }}">
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('background-colour', 'Background Colour *', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-4">
                                {{ Form::text('background_colour', null, array('class' => 'form-control', 'id' => 'background-colour')) }}
                                @if ($errors->has('background_colour'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('background_colour') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('border_colour') ? ' has-error' : '' }}">
                            {{ Form::label('border-colour', 'Border Colour *', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-4">

                                {{ Form::text('border_colour', null, array('class' => 'form-control', 'id' => 'border-colour')) }}

                                @if ($errors->has('border_colour'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('border_colour') }}</strong>
                                    </span>
                                @endif

                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-lg pull-right">Save</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->

        </div>

    </div>




@stop

@section('scripts')


    @parent


@stop