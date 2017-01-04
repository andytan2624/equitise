@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a new user</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::model($user, ['method' => 'POST', 'route' => ['user.create'], 'role' => 'form'])  !!}

        @include('users.partials.form')

        <div class="form-group">
            {!! Form::submit('Add User', ['class' => 'btn btn-primary form-control mt-2', 'id' => 'saveUser']) !!}
        </div>

        {!! Form::close() !!}

        {{ link_to_route('user.index', 'Back', [], ['class' => 'btn btn-danger']) }}
    </div>
@stop