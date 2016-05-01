@extends('layouts.admin')


@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Terms & Conditions</li>

        </ol>
    </section>

    <section class="content">

        @if(Session::has('terms_created'))

            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>
                {{ Session::get('terms_created') }}
            </div>
        @endif

        <div class="modal" id="termModal" tabindex="-1" role="dialog" aria-labelledby="termModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div id="modal-alert-placeholder"></div>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ url('term/update') }}" method="post" id="term-update-form">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="" id="update-term-id">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="">
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="terms">Terms</label>
                                <textarea class="form-control" id="terms" name="terms"></textarea>
                                <span class="error-message"></span>
                            </div>

                            <div class="form-group">
                                <label for="order">Display Order</label>
                                <select class="form-control" name="order" id="order">

                                    <?php $count = $terms->count(); ?>
                                    @for ($i = 1; $i <= $count+1; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor

                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-terms-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Terms & Conditions</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('term/create') }}" method="post" id="terms-create-form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="create-title">Title</label>
                                <input type="text" class="form-control" id="create-title" placeholder="Title" name="title" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                                <label for="create-terms">Terms</label>
                                <textarea class="textarea terms-textarea" id="create-terms" name="terms">{{ old('terms') }}</textarea>
                                @if ($errors->has('terms'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('terms') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                <label for="create-display">Display Order</label>
                                <select class="form-control" name="order" id="create-display">
                                    @if($terms->count() == 0)
                                        <option value="1">1</option>
                                    @else
                                        <?php $count = $terms->count(); ?>
                                            @for ($i = 1; $i <= $count+1; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>

                                            @endfor
                                    @endif
                                </select>
                                @if ($errors->has('order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="create-submit"><i class="fa fa-refresh"></i> Submit</button>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div>

            <div class="col-md-7">
                @if ($terms->count())

                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">All Terms & Conditions</h3>
                        </div><!-- /.box-header -->

                        <div class="box-body table-list-districts">
                            <form action="{{ url('term/remove') }}" method="post" id="remove_terms">
                                {{ csrf_field() }}
                                <table id="table-terms" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><input name="action_to_all" type="checkbox" class="check-all"></th>
                                        <th>Title</th>
                                        <th>Display Order</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-terms">

                                    @foreach($terms as $value)
                                        <tr>
                                            <td><input class="check-row" name="action_to[]" type="checkbox" value="{{ $value->id }}"></td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->order }}</td>
                                            <td><a class="updateTerm" data-id="{{ $value->id }}" href="{{ url('term/update', [$value->id]) }}"><i class="fa fa-pencil"></i></a> |
                                                <a class="deleteTerm" data-id="{{ $value->id }}" href="{{ url( 'term/delete', [$value->id]) }}"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>

                                <div class="btn-toolbar list-toolbar">
                                    <button class="btn btn-danger" name="mass-delete" type="submit" id="delete-submit"><i class="fa fa-trash-o"></i> Delete</button>
                                </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                @endif
            </div>
        </div>

    </section>
    </section>


@stop

@section('scripts')

    @parent
    <script>
        var delete_terms_url = "<?php echo url('term/delete'); ?>";
        var update_terms_url = "<?php echo url('term/update'); ?>";
    </script>




@stop