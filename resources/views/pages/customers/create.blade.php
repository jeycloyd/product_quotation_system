@extends('layouts.master')
@section('title', 'Add Customer')
@section('content')
@section('header','Add Customer')
    {{-- <div>
        <form action="{{route('store.customers')}}" method="POST">
            @csrf
            <div>
                @error('customer_name')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div style="padding-top: 15px">
                <label for="customer_name">Name:</label>
                <input type="text" class="@error('customer_name') is-invalid @enderror" name="customer_name">
            </div>
            <div >
                @error('customer_contact_no')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div style="padding-top: 15px">
                <label for="customer_contact_no">Contact No:</label>
                <input type="text" class="@error('customer_contact_no') is-invalid @enderror" name="customer_contact_no">
            </div>
            <div style="padding-top: 15px">
                <button type="submit">Add Customer</button>
            </div>
        </form>
    </div> --}}
    {{-- <form>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form> --}}

    <!--  FILL UP FORM (Start)-->
    <div class="wrapper2">
            <div>
                <!--  REGISTRATION FORM (Start)-->
                <h1 class="h1_CustomerRegistration"> ADD CUSTOMER </h1>
                <form class="fillupform" action="{{route('store.customers')}}" method="POST">
                    @csrf
                    <div>
                        @error('customer_name')
                            <div>{{$message}}</div>
                        @enderror
                    </div>
                    <div class="inputbox">  
                        <input type="text" required class="@error('customer_name') is-invalid @enderror" name="customer_name" placeholder="Enter customer name...">
                    </div>
                    <div class="inputbox">
                    <input type="text" required name="customer_contact_no" placeholder="Enter contact number...">
                    </div>
                    <button type="submit" class="btn-confirm border-0" >ADD CUSTOMER</button>   
                </form>
        </div>
    </div>
    <!--  FILL UP FORM (End)-->
@endsection