
@extends('layouts.main')

@section('content')
<div class="row">
  @foreach ($posts as $post)
  @include('components.post',['post'=>$post])
  @endforeach
 
</div>
    
@endsection