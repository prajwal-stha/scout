<form action="{{ url('districts/remove') }}" method="post" id="remove_many_districts">
    {{ csrf_field() }}
    <table id="table-districts" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><input name="action_to_all" type="checkbox" class="check-all"></th>
            <th>Code</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="list-districts">

        @foreach($districts as $value)
            <tr>
                <td><input class="check-row" name="action_to[]" type="checkbox" value="{{ $value->id }}"></td>
                <td>{{ $value->district_code }}</td>
                <td>{{ $value->name }}</td>
                <td><a class="updateDistrict" data-id="{{ $value->id }}" href="{{ url('districts/update', [$value->id]) }}"><i class="fa fa-pencil"></i></a> |
                    <a class="deleteDistrict" data-id="{{ $value->id }}" href="{{ url( 'districts/delete', [$value->id]) }}"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>

    <div class="btn-toolbar list-toolbar">
        <button class="btn btn-danger" name="mass-delete" type="submit" id="delete-submit"><i class="fa fa-trash-o"></i> Delete</button>
    </div>
</form>