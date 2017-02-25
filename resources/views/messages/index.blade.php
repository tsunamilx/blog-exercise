@extends('layouts.app')

@section('content')
    @foreach($messages as $m)
        <section>
            {{ $m->body }}
        </section>
    @endforeach
@endsection