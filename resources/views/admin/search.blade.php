@extends('layouts.admin')

@section('content')

    <section class="content">
        @if($search->count())
            <div class="row">
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Search Results</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <table id="search-result" class="table table-bordered table-striped">
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
                                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
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