@extends('layouts.master')
@section('title','Home')
@section('content')
         @if (auth()->user()->role != 'admin')
            <div class="homewrapper_guest">
              <div class="labelcontainer">
                <h1 class="firstlabel"> M E D I A O N E 
                  <img class="homeguestlogo" src="{{asset('images/global_images/media_one_logo.png')}}">
                </h1>
                <br>
                <div class="secondlabel" > Q U O T A T I O N  F O R M  S Y S T E M
                </div>  
              </div>
            </div>
            <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
         @else
          <div class="homewrapper">
          <div class="homelabel">
            <h1 style=" font-family: 'Ubuntu', sans-serif; font-weight: 500">Dashboard</h1>
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
      
                                    <img src="{{asset('images/dashboard_images/new_customers.png')}}">
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
                                   <h2 class="topic-heading" style="color:#66ff33">{{$customer_growth_rate}}</h2>
                                   <h2 class="topic">Customer Growth Rate</h2>
                                 </div>
                                 <img src="{{asset('images/dashboard_images/growth_rate.png')}}">
                          </div>
                    </div>
          @endif  
@endsection
    