@extends('layouts.master')
@section('title', 'Add Product')
@section('content')
@section('header','Add Product')
    {{-- <div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <form action="{{route('store.products')}}" method="POST">
            @csrf
            <div>
                @error('product_name')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="product_name">Name:</label>
                <input type="text" class="@error('product_name') is-invalid @enderror" name="product_name">
            </div>
            <div>
                @error('product_description')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="product_description">Description:</label>
                <input type="text" class="@error('product_description') is-invalid @enderror" name="product_description">
            </div>
            <div>
                @error('product_description')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="product_price">Price:</label>
                <input type="number" name="product_price" value="1" min="1" step="0.01">
            </div>
            <div>
                <button type="submit">Add Product</button>
            </div>
        </form>
    </div> --}}
<!--  FILL UP FORM (Start)-->
<div class="wrapper2">
    <div class="fillup_container">
        <div>
            <!--  PRODUCT FORM (Start)-->
            <h1 class="h1_ProductRegistration"> ADD PRODUCT </h1>
            <form class="productform" action="{{route('store.products')}}" method="POST">
                @csrf
                <div>
                    @error('product_name')
                        <div>{{$message}}</div>
                    @enderror
                </div>
                <div class="inputbox">  
                    <input type="text" required class="@error('product_name') is-invalid @enderror" name="product_name" placeholder="Enter product name...">
                </div>
                <div class="inputbox">  
                    <input type="text" required name="product_description" placeholder="Enter product description...">
                </div>
                <div class="inputbox">
                    <input type="number" required name="product_price" min="1" step=".01" value="1">
                </div>
                <button type="submit" class="btn-confirm border-0" >ADD PRODUCT </button> 
            </form>
        </div>
    </div>  
</div>
<!--  PRODUCT FORM (End)-->
@endsection