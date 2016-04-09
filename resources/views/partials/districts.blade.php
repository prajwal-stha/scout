@foreach($districts as $value)
    <tr>
        <td class="check-row"><input name="action_to[]" type="checkbox" value="{{ $value->id }}"></td>
        <td>{{ $value->district_code }}</td>
        <td>{{ $value->name }}</td>
        <td><a class="updateDistrict" id="updateDistrict" data-id="{{ $value->id }}"><i class="fa fa-pencil"></i></a> |
            <a class="deleteDistrict" data-id="{{ $value->id }}" href="{{ url( 'districts/delete', [$value->id]) }}"><i class="fa fa-trash-o"></i></a></td>
    </tr>
@endforeach

