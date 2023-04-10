@extends('layouts.master')
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    <ul>
                        <li>
                            <a href="/quotations/select-customer">Create Quotation</a>
                        </li>
                        <li>
                            <a href="/quotations/view">View Quotation</a>
                        </li>
                        <li>
                            <a href="/customers/create">Add Customers</a>
                        </li>
                        <li>
                            <a href="/products/create">Add Products</a>
                        </li>
                        <li>
                            <a href="/customers/index">View Customers</a>
                        </li>
                        <li>
                            <a href="/products/index">View Products</a>
                        </li>
                    </ul>  
                </div>
            </div>
        </div>
    </div>
</div> --}}

       
 <div class="homewallpaper">
    <img class="homewallpaper" src= "{{asset('../images/home/homewallpaper.png')}}" alt="product quotation system title image">    
 </div>
@endsection