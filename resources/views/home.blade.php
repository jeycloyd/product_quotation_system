@extends('layouts.master')
@section('title','Home')
@section('content')
        {{-- <img class="homewallpaper" src= "{{asset('../images/home/homewallpaper.png')}}" alt="product quotation system title image">    
         --}}
         @if (auth()->user()->role != 'admin')
             <h1>Welcome, {{auth()->user()->name}}</h1>
         @else
         <div class="homewrapper">
          <div class="homelabel">
            <h1>Dashboard</h1>
            </div>
              <div class="box-container">
                             <div class="box box1">
                                     <div class="text">
                                       <h2 class="topic-heading">{{$count_customer}}</h2>
                                       <h2 class="topic">Total Customers</h2>
                                     </div>
      
                                     <img src="{{asset('images/dashboard_images/total_customers.png')}}">                       
                             </div>
      
                             <div class="box box2">
                                    <div class="text">
                                      <h2 class="topic-heading">{{$count_new_customer}}</h2>
                                      <h2 class="topic">New Customers</h2>
                                    </div>
      
                                    <img src="">
                             </div>
      
                             <div class="box box3">
                                    <div class="text">
                                      <h2 class="topic-heading">{{$count_quotation}}</h2>
                                      <h2 class="topic">Quotations Made</h2>
                                    </div>
      
                                    <img src="{{asset('images/dashboard_images/total_quotations.png')}}">
      
                             </div>
               </div> <!--BOX CONTAINER (End)-->
              <div class="box-container2">
                          <div class="box box4">
                                  <div class="text">
                                  <h2 class="topic-heading">{{$count_product}}</h2>
                                  <h2 class="topic">Available Products</h2>
                                  </div>
                                  <img src="{{asset('images/dashboard_images/available_products.png')}}">
                          </div>
                          <div class="box box5">
                                  <div class="text">
                                  <h2 class="topic-heading">{{$count_user}}</h2>
                                  <h2 class="topic">Registered Users</h2>
                                  </div>
                                  <img src="{{asset('images/dashboard_images/registered_users.png')}}">
                          </div>
                          <div class="box box6">
                                 <div class="text">
                                   <h2 class="topic-heading" style="color:#66ff33">+{{$customer_growth_rate}}%</h2>
                                   <h2 class="topic">Customer Growth Rate</h2>
                                 </div>
                                 <img src="{{asset('images/dashboard_images/growth_rate.png')}}">
                          </div>
          </div>
         @endif  
@endsection
    