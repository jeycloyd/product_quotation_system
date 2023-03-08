@extends('layouts.master')
@section('title', 'Home')
@section('content')
    <div>
        {{-- <form action="#" method="POST">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name">
            </div>
            <div>
                <label for="contact_no">Contact No:</label>
                <input type="text" name="contact_no">
            </div>
            <div>
                <button type="submit">Add Customer</button>
            </div>
        </form> --}}
        <h1>Product Quotation Manager</h1>
        <ul>
            <li>
                <a href="">Make Quotation</a>
            </li>
            <li>
                <a href="/customers/create">Add Customer</a>
            </li>
            <li>
                <a href="/products/create">Add Product</a>
            </li>
        </ul>
    </div>
@endsection