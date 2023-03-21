@extends('layouts.master')
@section('title', 'Add Product')
@section('content')
@section('header','Add Product')
    <div>
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
    </div>
@endsection