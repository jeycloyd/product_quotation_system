@extends('layouts.master')
@section('title', 'Home')
@section('content')
    <div>
        <h1>Product Quotation Manager</h1>
        <ul>
            <li>
                <a href="/quotations/select-customer">Make Quotation</a>
            </li>
            <li>
                <a href="/quotations/view">View Quotations</a>
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