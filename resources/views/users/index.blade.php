@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>
        @if(Session::has('status'))
            <div class="alert alert-success"><em> {!! session('status') !!}</em></div>
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @each('users.partials.item', $users, 'user')
            </tbody>
        </table>
        {{ link_to_route('user.create', 'Create A User', [], ['class' => 'btn btn-primary']) }}
    </div>
@endsection

