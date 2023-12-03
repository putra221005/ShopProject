@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Putra Apps</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('admin.create')}}">Create New Product</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Image</th>
        <th>Name</th>
        <th>Details</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><img src="{{ $product->image }}" width="100px"></td>
        <td>{{ $product->title }}</td>
        <td>@currency($product->unit_price) </td>
        <td>
            <form action="{{route('admin.delete')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}">
                <a class="btn btn-primary" href="{{ route('admin.edit',$product->id) }}">Edit</a>

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach


</table>
@endsection