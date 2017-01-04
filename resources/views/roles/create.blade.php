@extends('layouts.app')

@section('content')
    <h1>Create a new role</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($role, ['method' => 'POST', 'route' => ['role.create'], 'role' => 'form'])  !!}

    @include('roles.partials.form')

    <div class="form-group">
        {!! Form::submit('Add Role', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

    {{ link_to_route('role.index', 'Back', [], ['class' => 'btn btn-danger']) }}

@stop