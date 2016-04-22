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
                @include('partials/nav')
            </div><!-- /. box -->


        </div>
        <div class="col-md-8">

        </div>

    </div>




@stop

@section('scripts')


    @parent


@stop