@extends('layouts.admin')

@section('content')

    <section class="content">
        {{ Form::open(['url' => 'admin/advanced-search', 'method' => 'POST', 'class' => 'advanced-form']) }}
            <div class="row">
                <div class="col-md-12">

                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
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
                        <div class="box-body">
                            <!-- checkbox -->
                            <div class="form-group">
                                <label class="chairman">
                                    <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="chairman" id="chairman" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                    Chairman
                                </label>
                            </div>

                            <!-- checkbox -->
                            <div class="form-group">
                                <label class="committe">
                                    <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="committe" id="committe"class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                    Committe Member
                                </label>

                            </div>

                            <div class="form-group">
                                <label class="scouter">
                                    <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="scouter" id="scouter"class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                     Scouter
                                </label>

                            </div>

                            <!-- Minimal red style -->

                            <!-- checkbox -->
                            <div class="form-group">
                                <label class="team_member">
                                    <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="team_member" id="team_member"class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                    Team Member
                                </label>

                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">By Organization</h3>
                        </div>
                        <div class="box-body">
                            <!-- checkbox -->
                            <div class="form-group">
                                <label class="school">
                                    <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="school" id="school" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                    School
                                </label>
                            </div>

                            <!-- radio -->
                            <div class="form-group">
                                <label class="organization">
                                    <div id="organization" name="organization" class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                    Organization
                                </label>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">By Team</h3>
                        </div>
                        <div class="box-body">
                            <!-- checkbox -->
                            <div class="form-group">
                                <label class="team">
                                    <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="team" id="team" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                    Team
                                </label>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        {{ Form::close() }}

    </section>

@stop


@section('scripts')

    @parent



@stop