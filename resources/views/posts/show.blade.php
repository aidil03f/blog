@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">
     <h4>{{ $post->slug }}</h4>
     <hr>
     <p>{{ $post->body }}</p>
</div>
@endsection