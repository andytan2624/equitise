<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ link_to_route('user.edit', 'Edit', ['id' => $user->id], ['class' => 'btn btn-primary']) }}</td>
    <td><button class="btn btn-danger" type="button" data-id="{{ $user->id }}" data-toggle="modal" data-target="#delete-user-modal-{{ $user->id }}">Delete</button> </td>
</tr>

@section('modals')
    {!! Form::open(['route' => ['user.delete', $user->id], 'id' => 'form-remove-' . $user->id]) !!}
    @include('components.modal', ['id' => 'delete-user-modal-'.$user->id, 'message' => 'Are you sure you want to delete '.$user->name.'?'])
    {!! Form::hidden('id', $user->id) !!}
    {!! Form::close() !!}
@append