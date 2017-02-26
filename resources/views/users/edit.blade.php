@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"> Edit user </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                      action="{{ route('users_update', ['user' => $user->id]) }}">
                    {{ method_field('PUT') }}
                    @include('users.form')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

