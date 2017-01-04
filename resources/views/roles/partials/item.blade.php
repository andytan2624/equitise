<tr>
    <td>{{ $role->name }}</td>
    <td>{{ link_to_route('role.edit', 'Edit', ['id' => $role->id], ['class' => 'btn btn-primary']) }}</td>
    <td><button class="btn btn-danger" type="button" data-id="{{ $role->id }}" data-toggle="modal" data-target="#delete-role-modal-{{ $role->id }}">Delete</button> </td>
</tr>

@section('modals')
    {!! Form::open(['route' => ['role.delete', $role->id], 'id' => 'form-remove-' . $role->id]) !!}
    @include('components.modal', ['id' => 'delete-role-modal-'.$role->id, 'message' => 'Are you sure you want to delete '.$role->name.'?'])
    {!! Form::hidden('id', $role->id) !!}
    {!! Form::close() !!}
@append