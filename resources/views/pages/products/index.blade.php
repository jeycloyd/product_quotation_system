@extends('layouts.master')
@section('title', 'View Products')
@section('content')
@section('header','View Products')
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->product_price}}</td>
                    <td>
                        <a href="{{route('show.products',$product->id)}}" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>    
            @endforeach
        </tbody>
      </table>
@endsection