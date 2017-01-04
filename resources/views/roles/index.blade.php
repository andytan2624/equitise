@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Roles</h1>

    @if(Session::has('status'))
            <div class="alert alert-success"><em> {!! session('status') !!}</em></div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @each('roles.partials.item', $roles, 'role')
            </tbody>
        </table>
        {{ link_to_route('role.create', 'Create A Role', [], ['class' => 'btn btn-primary']) }}
    </div>
@endsection

