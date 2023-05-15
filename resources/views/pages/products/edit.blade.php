@extends('layouts.master')
@section('title', 'Edit Product')
@section('content')
    <div class="wrapper2">
        <div class="fillup_container">
            <div>
                <!--  PRODUCT FORM (Start)-->
                <h1 class="h1_ProductRegistration"> EDIT PRODUCT INFO</h1>
                <form class="productform" action="{{route('update.products',$product_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="inputbox">  
                        <input type="text" required class="form-control @error('product_name') is-invalid @enderror mb-0" name="product_name" value="{{$product_name}}">
                        @error('product_name')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputbox">  
                        <input type="text" required class="form-control @error('product_description') is-invalid @enderror mb-0" name="product_description" value="{{$product_description}}">
                        @error('product_description')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputbox">
                        <input type="number" required name="product_price" min="1" step=".01" value="{{$product_price}}">
                    </div>
                    <div class="inputbox">
                        <input type="file" name="product_image">
                    </div>
                    <button type="submit" class="btn-confirm border-0" >UPDATE PRODUCT </button> 
                </form>
            </div>
        </div>  
    </div>
@endsection