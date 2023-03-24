@extends('layouts.master')
@section('title', 'Add Customer')
@section('content')
    <!--  FILL UP FORM (Start)-->
    <div class="wrapper2">
            <div>
                <!--  REGISTRATION FORM (Start)-->
                <h1 class="h1_CustomerRegistration"> ADD CUSTOMER </h1>
                <form class="fillupform" action="{{route('store.customers')}}" method="POST">
                    @csrf
                    <div class="inputbox">  
                        <input type="text" required class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" placeholder="Enter customer name...">
                        @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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