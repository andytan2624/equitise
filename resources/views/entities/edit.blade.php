@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="css/dragula.min.css">
@append

@section('content')
    <div class="container">
        @if(Session::has('status'))
            <div class="alert alert-success"><em> {!! session('status') !!}</em></div>
        @endif

            <h1>Edit a {{ $type }}</h1>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($record, ['method' => 'POST', 'route' => ['entity.edit', $record->id, $type], 'role' => 'form', 'files' => true])  !!}

            @include('entities.partials.form', [$userRoles, $otherRoles])

            <div class="form-group">
                {!! Form::submit('Save ' . $type . ' Details', ['class' => 'btn btn-primary form-control mt-2', 'id' => 'saveRecord']) !!}
            </div>

            {!! Form::close() !!}

            {{ link_to_route('entity.index', 'Back', ['type' => $type], ['class' => 'btn btn-danger']) }}
    </div>


@stop

