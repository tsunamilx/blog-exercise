@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"> Edit post </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('posts_update', ['post' => $post->id]) }}">
                    {{ method_field('PUT') }}
                    @include('posts.form')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
    <script>
        const post = {!! json_encode($post) !!};
        const tags = {!! json_encode($post->tags) !!};
    </script>
    <script src="{{ mix('/js/edit.js') }}"></script>
@endsection

