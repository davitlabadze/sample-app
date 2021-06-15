@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Post</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($post as $ps)
                            <tr>
                                <td>{{ $ps->id }}</td>
                                <td>{{ $ps->title }}</td>
                                <td><img src="{{ url($ps->image) }}" width="50" height="50" ></td>
                                <td>
                                    <form method="POST" action="{{ route('admin.post.destroy',['post' => $ps->id]) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                        <a href="{{ route('admin.post.edit',['post' => $ps->id]) }}" class="btn btn-sm btn-primary">edit</a>
                                    
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    
                </div>

            <a href="{{ route('admin.post.create') }}" class="btn btn-success" style="margin-right:0">Create New Post</a>
            </div>
        </div>
        
    </div>
    
</div>

@endsection