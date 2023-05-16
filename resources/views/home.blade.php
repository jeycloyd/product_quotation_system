@extends('layouts.master')
@section('title','Home')
@section('content')
    <div class="homewallpaper">
        {{-- <img class="homewallpaper" src= "{{asset('../images/home/homewallpaper.png')}}" alt="product quotation system title image">    
         --}}

         {{-- <h2>Total Customers:</h2>
         <p>{{$count_customer}}</p>
         
         <h2>New Customers this month:</h2>
         <p>{{$count_new_customer}}</p>
         
         <h2>Quotations Made:</h2>
         <p>{{$count_quotation}}</p>
         
         <h2>Available Products</h2>
         <p>{{$count_product}}</p>
         
         <h2>Registered Users</h2>
         <p>{{$count_user}}</p>
          --}}

          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <p class="card-text">{{$count_customer}}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">New Customers this month</h5>
                    <p class="card-text">{{$count_new_customer}}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Quotations Made</h5>
                    <p class="card-text">{{$count_quotation}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Available Products</h5>
                    <p class="card-text">{{$count_product}}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Registered Users</h5>
                    <p class="card-text">{{$count_user}}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Customer Growth Rate</h5>
                    <p class="card-text">{{$customer_growth_rate}}%</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
    