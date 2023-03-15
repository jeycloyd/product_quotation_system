@extends('layouts.master')
@section('title', 'Home')
@section('content')
    {{-- <div>
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
    </div> --}}
    {{-- <body>
        <div class="wrapper">
            <div class="navbar">
                <div class="inner_navbar">
                <!--  LOGO AND NAME OF THE WEBSITE (Start)-->
                    <div class="logo">
                        <img class="mediaonelogo" src= "{{asset('../images/global_images/media_one_logo.png')}}" alt="media one logo">    
                        <a href="#">Media<span>One</span></a>
                    </div>
         <div class="menu">
            <ul>
                <a href="/">Home</a>
                <a href="/quotations/select-customer">Create Quotation</a>
                <a href="/quotations/view">View Quotation</a>
                <a href="/customers/create">Add Customer</a>
                <a href="/products/create">Add Product</a>
            </ul>
        </div>
    </body> --}}
@endsection