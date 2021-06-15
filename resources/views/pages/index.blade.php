
@extends('layouts.main')

@section('content')
<div class="row">
  @foreach ($post as $post)
  @include('components.post',['post'=>$post])
  @endforeach
 
</div>
    
@endsection