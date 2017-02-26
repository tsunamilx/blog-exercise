@extends('layouts.app')

@section('content')

<template v-for="post in posts">
    <section>
        <h1> <a :href="'/posts/' + post.id">@{{ post.title }} </a> </h1>
        <a :href="'/users/' + post.user_id">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            @{{ post.user.name }}
        </a>
        <a v-for="tag in post.tags" :href="'/tags/' + tag.id" class="tag label label-primary" >
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            @{{ tag.name }}
        </a>
        <article>
            <p v-for="p in post.body.split('\n')"> @{{ p }} </p>
        </article>
    </section>
</template>

<div>
    <button v-show="ready && !loading" @click="load" class="btn btn-primary"> More </button>
    <button v-show="loading && hasMore" class="btn btn-primary">
        <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
        Processing...
    </button>
</div>

@endsection

@section('footer')
    <script src="{{ mix('/js/index.js') }}"></script>
@endsection