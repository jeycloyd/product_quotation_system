@extends('layouts.master')
@section('title', 'Edit Product')
@section('content')
@section('header','Edit Product Info')
    <form action="{{route('update.products',$product_id)}}" method="POST">
        @csrf
        <div class="form-group">
        <label for="Name">Product Name</label>
        <input type="text" class="form-control" value="{{$product_name}}" name="product_name">
        </div>
        <div class="form-group">
        <label for="">Product Price</label>
        <input type="number" class="form-control" value="{{$product_price}}" name="product_price" step=".1" min="1">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection