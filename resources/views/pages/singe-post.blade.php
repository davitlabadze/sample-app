@extends('layouts.main')

@section('content')
<section class="jumbotron">
    
    <h1 class="jumbotron-heading">{{ $post->title }}</h1>
    <img src="{{ url($post->image) }}" alt="{{ $post->title }}">
    <p class="lead text-muted">{{ $post->text }}</p>
      
    
  </section>
@endsection