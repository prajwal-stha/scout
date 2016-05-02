@extends('layouts.admin')

@section('content')

    <section class="content">
        {{ Form::open(['url' => 'admin/advanced-search', 'method' => 'POST', 'class' => 'advanced-form']) }}
        <div class="row">
            <div class="col-md-12">

                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i
                                    class="fa fa-search"></i></button>
                    </div>
                </div><!-- /.input-group -->

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">By Person</h3>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> chairman
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Committe Member
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Scouter
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Team member
                                </label>
                            </div>
                        </li>
                    </ul>

                </div>

            </div>


            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">By Organization</h3>
                    </div>


                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> School
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Organization
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">By Team</h3>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Team
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        {{ Form::close() }}

    </section>

@stop


@section('scripts')

    @parent



@stop