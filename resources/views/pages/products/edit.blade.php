@extends('layouts.master')
@section('title', 'Edit Product')
@section('content')
@section('header','Edit Product Info')
    {{-- <form action="{{route('update.products',$product_id)}}" method="POST">
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
    </form> --}}
    <div class="wrapper2">
        <div class="fillup_container">
            <div>
                <!--  PRODUCT FORM (Start)-->
                <h1 class="h1_ProductRegistration"> EDIT PRODUCT INFO</h1>
                <form class="productform" action="{{route('update.products',$product_id)}}" method="POST">
                    @csrf
                    <div>
                        @error('product_name')
                            <div>{{$message}}</div>
                        @enderror
                    </div>
                    <div class="inputbox">  
                        <input type="text" required class="@error('product_name') is-invalid @enderror" name="product_name" value="{{$product_name}}">
                    </div>
                    <div class="inputbox">
                        <input type="number" required name="product_price" min="1" step=".01" value="{{$product_price}}">
                    </div>
                    <button type="submit" class="btn-confirm border-0" >ADD PRODUCT </button> 
                </form>
            </div>
        </div>  
    </div>
@endsection