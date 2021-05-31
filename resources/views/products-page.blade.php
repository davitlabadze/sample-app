
@extends('layouts.main')


@section('content')

<div class="card"></div>
    <div class="card-header">
        <h3>all Products</h3>
    </div>

    <div class="card-body">
        <table class="table ">
            <form action="{{ route('products.all') }}">
                <tr>
                    <th><input type="number" name="id"       value="{{ request('id') }}"placeholder="Enter ID"class="form-control"></th>
                    <th><input type="text"   name="name"     value="{{ request('name') }}"placeholder="Enter Name" class="form-control"></th>
                    <th><input type="text"   name="category" value="{{ request('category') }}"placeholder="Enter category" class="form-control"></th>
                    <th><input type="number" name="price"    value="{{ request('price') }}"placeholder="Enter Price" class="form-control"></th>
                    <th><input type="number" name="sale"     value="{{ request('sale') }}"placeholder="Enter Sale" class="form-control"></th>
                    <th><input type="number" name="stok"     value="{{ request('stok') }}"placeholder="Enter Stok" class="form-control"></th>
                    <th><button class="btn btn-primary">filter</button></th>
                    <th><a href="{{ route('products.all') }}" type="reset" class="btn btn-danger">clear</a></th>
                </tr>
            </form>

            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>category</th>
                <th>Price</th>
                <th>Sale</th>
                <th>Stok</th>
                <th>Date </th>
                <th>Actions</th>
            </thead>
            <tbody>
                <form action="{{ route('products.save') }}" method="POST">
                    @csrf
                    <tr>
                        <td colspan="2"><input type="text"  name="name" class="form-control"/></td>
                        <td ><input type="text"  name="category" class="form-control"/></td>
                        <td><input type="number" name="price" class="form-control"/></td>
                        <td><input type="number" name="sale" class="form-control"/></td>
                        <td><input type="number" name="stok" class="form-control"/></td>
                        <td><button class="btn btn-success">add</button></td>
                        <td>delete</td>
                        <td>edit</td>
        
                    </tr>
                </form>
            </tbody>
        
        
            @foreach ($products as $pr )
                <tr>
                    <td>{{$pr->id}}</td>
                    {{-- <td>{{$loop->index + 1}}</td> --}}
                    <td>{{$pr->name}}</td>
                    <td>{{$pr->category}}</td>
                    <td>{{$pr->price}}</td>
                    <td>{{$pr->sale}}</td>
                    <td>{{$pr->stok}}</td>
                    <td>{{$pr->created_at}}</td>
                
                    <td>
                        <form action="{{ route('products.delete', ['id' => $pr->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $pr->id }}">
                            <button class="btn btn-danger">delete</button>
                        </form>
                    </td>
                    <td>
                        
                       <a href="{{ route('products.edit',['id'=>$pr->id])}}">edit</a>
                    </td>
                </tr>
            @endforeach
        </table>

    </div>
</div>




@endsection