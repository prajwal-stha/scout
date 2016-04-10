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
                        <li class="active"><a href="{{ url('/committe') }}"><i class="fa fa-users"></i> Committe Member</a></li>
                        <li><a href="{{ url('scouter/scouter') }}"><i class="fa fa-user-plus"></i> Scouter Detail</a></li>
                        <li><a href="{{ url('/team') }}"><i class="fa fa-users"></i> Teams</a></li>
                        <li><a href="{{ url('/scouter/registration') }}"><i class="fa fa-calculator"></i> Registration Cost Detail</a></li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->


        </div>
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Committee Member Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('organizations/member') }}" method="post" id="member-create-form" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="f-name">First Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="f-name" placeholder="First Name" name="f_name" value="{{ old('f_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="m-name">Middle Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="m-name" placeholder="Middle Name" name="m_name" value="{{ old('m_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="l-name">Last Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="background-colour" placeholder="Last Name" name="l_name" value="{{ old('l_name') }}">
                            </div>
                        </div>

                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right" id="member-submit">Save</button><br />

                        </div>

                        <div class="box-footer">
                            <table id="table-member" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><input name="action_to_all" type="checkbox" class="check-all"></th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="list-member">
                                    <tr>
                                        <td class="check-row"><input name="action_to[]" type="checkbox" value=""></td>
                                        <td>{{ session()->get('f_name') }}</td>
                                        <td>{{ session()->get('m_name') }}</td>
                                        <td>{{ session()->get('l_name') }}</td>
                                        <td><i class="fa fa-pencil"></i> |
                                            <i class="fa fa-trash-o"></i></td>
                                    </tr>

                                </tbody>

                            </table>
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