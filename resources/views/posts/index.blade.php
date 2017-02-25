@extends('layouts.app')

@section('content')

<template v-for="post in posts">
    <section>
        <h1> <a :href="'/posts/' + post.id">@{{ post.title }} </a> </h1>
        <span> @{{ post.user.name }} </span>
        <span class="tag label label-primary" v-for="tag in post.tags"> @{{ tag.name }} </span>
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
    <script src="{{ asset('js/index.js') }}"></script>
@endsection