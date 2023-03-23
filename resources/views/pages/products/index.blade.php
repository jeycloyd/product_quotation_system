@extends('layouts.master')
@section('title', 'View Products')
@section('scripts')
@section('content')
@section('header','View Products')
  <div class="table-wrapper">
      <form action="{{route('search.products')}}" method="GET">
        <div class="input-group mb-3">
            @csrf
            <input type="text" class="form-control" placeholder="Search..." name="search">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </form>  
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
                          <a href="{{route('destroy.products',$product->id)}}" class="btn btn-danger">Delete</a>
                      </td>
                  </tr>    
              @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $products->withQueryString()->links() }}
        </div>
  </div>
@endsection