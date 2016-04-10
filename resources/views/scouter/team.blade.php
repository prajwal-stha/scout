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
                        <li><a href="{{ url('scouter/scouter') }}"><i class="fa fa-user-plus"></i> Scouter Detail</a></li>
                        <li class="active"><a href="{{ url('/team') }}"><i class="fa fa-users"></i> Teams</a></li>
                        <li><a href="{{ url('/registration') }}"><i class="fa fa-calculator"></i> Registration Cost Detail</a></li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->


        </div>
        <div class="col-md-9">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Manage Team</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">

                            <form role="form" action="{{ url('team/create') }}" method="post" id="team-create-form" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="lead-scouter">Team Name</label>
                                    <div class="col-sm-8">
                                       <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right" id="team-submit">Save</button>
                                </div>
                            </form>

                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Alpha</td>
                                        <td><i class="fa fa-pencil"></i> |
                                            <i class="fa fa-trash-o"></i></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                            <div class="col-md-8">
                                <form class="form-horizontal">

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="email">Name</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="email" placeholder="First" name="f_name" value="{{ old('f_name') }}">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="email" placeholder="Middle" name="m_name" value="{{ old('email') }}">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="email" placeholder="Last" name="l_name" value="{{ old('l_name') }}">
                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">DOB</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                        </div>


                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">Date of Join</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">Current Level</label>

                                        <div class="col-sm-9">
                                            <select class="form-control">
                                                <option>Select</option>
                                            </select>
                                        </div>


                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">Passed Date</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="organization-start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                                        </div>


                                    </div>


                                    <div class="form-group">

                                        <label class="control-label col-sm-3" for="organization-start">Notes</label>

                                        <div class="col-sm-9">
                                            <textarea id="organization-start" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right">Add Member</button>
                                    </div>
                                </form>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-md-12">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>Date of Join</th>
                                            <th>Passed Date</th>
                                            <th>Notes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>P.L</td>
                                            <td>John Doe</td>
                                            <td>12/09/1990</td>
                                            <td>13/08/2011</td>
                                            <td>04/07/2013</td>
                                            <td>lorem ipsum</td>
                                            <td><i class="fa fa-pencil"></i> |
                                                <i class="fa fa-trash-o"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div><!-- /.box -->
                </div>

            </div>
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