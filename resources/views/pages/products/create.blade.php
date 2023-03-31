@extends('layouts.master')
@section('title', 'Add Product')
@section('content')
<!--  FILL UP FORM (Start)-->
<div class="wrapper2">
    <div class="fillup_container">
        <div>
            <!--  PRODUCT FORM (Start)-->
            <h1 class="h1_ProductRegistration"> ADD PRODUCT </h1>
            <form class="productform" action="{{route('store.products')}}" method="POST">
                @csrf
                <div class="inputbox">  
                    <input type="text" required class="form-control @error('product_name') is-invalid @enderror mb-0" name="product_name" placeholder="Enter product name...">
                    @error('product_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(session('message'))
                    <div class="invalid-feedback" style="display: block;
                    width: 100%;
                    margin-top: .25rem;
                    font-size: 80%;
                    color: #dc3545;">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="inputbox">  
                    <input type="text" required name="product_description" placeholder="Enter product description...">
                </div>
                <div class="inputbox">
                    <input type="number" required name="product_price" min="1" step=".01" value="1">
                </div>
                <button type="submit" class="btn-confirm border-0" style="margin-top: 52%; margin-left: 20px" >ADD PRODUCT </button> 
            </form>
        </div>
    </div>  
</div>
<!--  PRODUCT FORM (End)-->
@endsection