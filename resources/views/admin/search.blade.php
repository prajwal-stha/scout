@extends('layouts.admin')

@section('content')

    <section class="content">
        @if($search->count())
            <div class="row">
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ isset($query) ? $search->count() . ' Results found for: '. $query : '' }} </h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <table id="search-result" class="table table-bordered table-striped">
                                @if($search_type == 'school')
                                    <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Organizations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($search as $value)
                                            <tr>
                                                <td>{{ ucfirst($value->type) }}</td>
                                                <td><a href="{{ url('admin/view-approved-organization', [$value->original_id]) }}">{{ $value->name }}</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @elseif($search_type == 'member')
                                    <thead>
                                        <tr>
                                            <th>Organizations</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($search as $value)
                                        <tr>
                                            <td><a href="{{ url('admin/view-approved-organization', [$value->organization_id]) }}">{{ $value->core_organization->name }}</a></td>
                                            <td>{{ $value->f_name }} {{ $value->m_name }} {{ $value->l_name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                @elseif($search_type == 'scouter')
                                    <thead>
                                    <tr>
                                        <th>Organizations</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($search as $value)
                                        <tr>
                                            <td><a href="{{ url('admin/view-approved-organization', [$value->organization_id]) }}">{{ $value->core_organization->name }}</a></td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->is_lead == 1 ? 'Lead Scouter' : 'Assistant-Lead Scouter' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                @elseif($search_type == 'team')
                                    <thead>
                                    <tr>
                                        <th>Organizations</th>
                                        <th>Team</th>
                                        <th>Team Member</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($search as $value)
                                        <tr>
                                            <td><a href="{{ url('admin/view-approved-organization', [$value->organization_id]) }}">{{ $value->core_organization->name }}</a></td>
                                            <td>{{ $value->name }}</td>
                                            <td>
                                                @foreach($value->core_team_members as $team_member)
                                                    {{ $team_member->f_name }} {{ $team_member->m_name }} {{ $team_member->l_name }}
                                                @endforeach
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="error-page">
                <h2 class="headline text-green"> 404</h2>
                <div class="error-content">
                    <h3><i class="fa fa-warning text-red"></i> Oops! Not found.</h3>
                    <p>
                        We could not find the result you were looking for.
                        Meanwhile, you may <a href="{{ url('admin') }}">return to dashboard</a> or be precise with the search query.
                    </p>

                    {{ Form::open(['url' => 'admin/search', 'method' => 'POST', 'class' => 'search-form']) }}
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                            </div>
                        </div><!-- /.input-group -->
                    {{ Form::close() }}
                </div><!-- /.error-content -->
            </div><!-- /.error-page -->
        @endif

    </section>

@stop

@section('scripts')
    @parent

@stop