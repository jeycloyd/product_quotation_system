@extends('layouts.master')
@section('title', 'View Products')
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@section('content')
@section('header','View Products')
  <div class="table-wrapper">
    @if (\Session::has('success'))
        <div class="alert alert-success">
              {!! \Session::get('success') !!}
        </div>
    @endif
    <a href="/products/create" class="btn btn-success" style="margin-bottom: 15px">Add New Product</a>
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
                      <td>PHP {{number_format($product->product_price,2)}}</td>
                      <td>
                          <a href="{{route('show.products',$product->id)}}" class="btn btn-warning">Edit</a>
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