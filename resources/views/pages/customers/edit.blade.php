@extends('layouts.master')
@section('title', 'Edit Customer')
@section('content')
    <!--  FILL UP FORM (Start)-->
    <div class="wrapper2">
        <div>
            <!--  REGISTRATION FORM (Start)-->
            <h1 class="h1_CustomerRegistration"> EDIT CUSTOMER INFO </h1>
            <form class="fillupform" action="{{route('update.customers', $customer_id)}}" method="POST">
                @csrf
                <div class="inputbox">  
                    <input type="text" required class="form-control @error('customer_name') is-invalid @enderror mb-0" name="customer_name" value="{{$customer_name}}">
                    @error('customer_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="inputbox">
                    <input type="text" required name="customer_contact_no" value="{{$customer_contact_no}}">
                </div>
                <div class="inputbox">
                    <input type="text" required name="customer_address" value="{{$customer_address}}">
                </div>
                <button type="submit" class="btn-confirm border-0" >UPDATE CUSTOMER</button>   
            </form>
    </div>
</div>
<!--  FILL UP FORM (End)-->
@endsection