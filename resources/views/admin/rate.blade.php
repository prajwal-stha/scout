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
                    <form role="form" action="{{  url('rate/create-rate') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Registration Fees</label>
                                <input type="text" class="form-control" name="reg_fees">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Scouter Registration Fees</label>
                                <input type="text" class="form-control" name="s_reg_fees">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Member Registration Fees</label>
                                <input type="text" class="form-control" name="m_reg_fees">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Committee Registration Fees</label>
                                <input type="text" class="form-control" name="c_reg_fees">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Disaster Management Trust</label>
                                <input type="text" class="form-control" name="d_reg_fees">
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
    <script>

    </script>

@stop