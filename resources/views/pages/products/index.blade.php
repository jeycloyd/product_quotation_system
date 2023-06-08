@extends('layouts.master')
@section('title', 'View Products')
@section('scripts')
@section('content')
{{-- @section('header','View Products') --}}
<h1 class="h1_header_test">View Products</h1>
  <div class="table-wrapper">
    @if (\Session::has('success'))
        <div class="alert alert-success">
              {!! \Session::get('success') !!}
        </div>
    @endif
    <a href="/products/create" class="btn btn-success" style="margin-bottom: 15px"><i class='bx bxs-package' style='color:#ffffff'  ></i>Add New Product</a>
    <div class="searchform">
    <form action="{{route('search.products')}}" method="GET">
        <div class="input-group mb-3">
            @csrf
            <input type="text" class="form-control" placeholder="Search..." name="search">
            <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
        </div>
      </form>  
    </div>

      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Product ID</th>
              <th scope="col">Product Name</th>
              <th scope="col">Product Image</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(isset($count_products))
                @if ($count_products == 0)
                <tr>
                  <th colspan="6" style="text-align: center" >No Results Found!</th>
                </tr>
                @endif
              @endif 
              @foreach ($products as $product)
                  <tr>
                      <td>{{$product->id}}</td>
                      <td>{{$product->product_name}}</td>
                      <td> <img style="width:100px; height:70px" src="{{is_null($product->  product_image) ? asset('../images/no_image.png') : $product->product_image}}"></td>
                      <td>{{$product->product_description}}</td>
                      <td>PHP {{number_format($product->product_price,2)}}</td>
                      <td>
                          <a href="{{route('show.products',$product->id)}}" class="btn btn-outline-warning">Edit</a>
                          <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$product->id}}">Delete</button>
                      </td>
                  </tr>    
              @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $products->withQueryString()->links() }}
        </div>
  </div>
<!---------------------------------- POP UP MODAL FOR CONFIRM DELETE----------------------------------------------------->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove this product?
        <form action="{{route('destroy.products')}}" method="GET">
          @csrf
          <input hidden type="text" name="id" class="form-control" id="id">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete it</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/modals.js') }}"></script>
@endsection