@extends('layouts.app')

@section('content')

    @if($user->image)
        <div>
            <img class="user-image"
                 src="{{ asset(str_replace('public', 'storage', $user->image)) }}">
        </div>
    @endif

    <h1>
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        {{ $user->name }}
    </h1>
    <h1>
        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
        {{ $user->email }}
    </h1>

    @if($user->isMyself())
        <a href="{{ route('users_edit', ['user' => $user->id]) }}"
           class="btn btn-primary">
            Edit
        </a>
    @endif

@endsection