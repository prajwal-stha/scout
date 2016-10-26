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


            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Scarf Detail {{ isset($organization) ? ': '. $organization->name : '' }}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

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


                @if(isset($org_id))

                    {{ Form::model($organization, ['url' => ['organizations/edit-scarf', $org_id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'scarf-create-form']) }}

                @else

                    {{ Form::open(['url' => 'organizations/scarf', 'class' => 'form-horizontal', 'id' =>'scarf-create-form']) }}

                @endif
                    <input type="hidden" name="org_id" id="org_id" value="{{ Session::get('org_id') }}">
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('background_colour') ? ' has-error' : '' }}">
                            {{ Form::label('background-colour', 'Background Colour *', array( 'class' => 'control-label col-sm-3')) }}
                            <div class="col-sm-4">
                                {{ Form::text('background_colour', null, array('class' => 'form-control', 'id' => 'background-colour', 'placeholder' => 'Background Colour')) }}
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

                                {{ Form::text('border_colour', null, array('class' => 'form-control', 'id' => 'border-colour', 'placeholder'    => 'Border Colour')) }}

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
                                @if(isset($org_id))
                                    @if(!$organization->isRegistered() && !$organization->isRegistered() )
                                        <button type="submit" class="btn btn-success">Save</button>
                                    @endif
                                    <a href="{{ url('scouter/committe', [$org_id]) }}" class="btn btn-default">NEXT</a>
                                @else
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a href="{{ url('scouter/committe') }}" class="btn btn-default">NEXT</a>
                                @endif

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