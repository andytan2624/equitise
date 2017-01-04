@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ ucwords($type).'s' }}</h1>

        @if(Session::has('status'))
            <div class="alert alert-success"><em> {!! session('status') !!}</em></div>
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>No. People</th>
                <th>Rating</th>
                <th>Year Created</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->number_people }}</td>
                    <td>{{ $record->rating }}</td>
                    <td>{{ $record->getYearCreated() }}</td>

                    <td></td>
                    <td>{{ link_to_route('entity.edit', 'Edit', ['id' => $record->id, 'type' => $type], ['class' => 'btn btn-primary']) }}</td>
                    <td>
                        <button class="btn btn-danger" type="button" data-id="{{ $record->id }}" data-toggle="modal"
                                data-target="#delete-user-modal-{{ $record->id }}">Delete
                        </button>
                    </td>
                </tr>

            @section('modals')
                {!! Form::open(['route' => ['entity.delete', $record->id,  $type], 'id' => 'form-remove-' . $record->id]) !!}
                @include('components.modal', ['id' => 'delete-user-modal-'.$record->id, 'message' => 'Are you sure you want to delete '.$record->name.'?'])
                {!! Form::hidden('id', $record->id) !!}
                {!! Form::close() !!}
            @append
            @endforeach
            </tbody>
        </table>
        {{ link_to_route('entity.create', 'Create A Record', ['type' => $type], ['class' => 'btn btn-primary']) }}
    </div>
@endsection

