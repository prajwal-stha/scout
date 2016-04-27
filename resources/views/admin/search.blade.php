@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Search Results</li>

        </ol>
    </section>

    <section class="content">
        @if($search->count())
            @foreach($search as $value)
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ ucfirst($value->type) }}</h3>
                            <p>{{ $value->name }}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-institution"></i>
                        </div>
                        <a href="{{ url('admin/view-approved-organization', [$value->id]) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>
                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Not found.</h3>
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