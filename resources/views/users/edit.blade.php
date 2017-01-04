@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="css/dragula.min.css">
@append

@section('content')
    <div class="container">
        @if(Session::has('status'))
            <div class="alert alert-success"><em> {!! session('status') !!}</em></div>
        @endif

            <h1>Edit a role</h1>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($user, ['method' => 'POST', 'route' => ['user.edit', $user->id], 'role' => 'form'])  !!}

            @include('users.partials.form', [$userRoles, $otherRoles])

            <div class="form-group">
                {!! Form::submit('Save User Details', ['class' => 'btn btn-primary form-control mt-2', 'id' => 'saveUser']) !!}
            </div>

            {!! Form::close() !!}

            {{ link_to_route('user.index', 'Back', [], ['class' => 'btn btn-danger']) }}
    </div>


@stop

