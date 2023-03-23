@extends('layouts.master')
@section('title', 'Edit Customer')
@section('content')
@section('header','Edit Customer Info')
    {{-- <form action="{{route('update.customers',$customer_id)}}" method="POST">
        @csrf
        <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" class="form-control" value="{{$customer_name}}" name="customer_name">
        </div>
        <div class="form-group">
        <label for="">Contact No.</label>
        <input type="text" class="form-control" value="{{$customer_contact_no}}" name="customer_contact_no">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form> --}}
    <!--  FILL UP FORM (Start)-->
    <div class="wrapper2">
        <div>
            <!--  REGISTRATION FORM (Start)-->
            <h1 class="h1_CustomerRegistration"> EDIT CUSTOMER INFO </h1>
            <form class="fillupform" action="{{route('update.customers', $customer_id)}}" method="POST">
                @csrf
                <div>
                    @error('customer_name')
                        <div>{{$message}}</div>
                    @enderror
                </div>
                <div class="inputbox">  
                    <input type="text" required class="@error('customer_name') is-invalid @enderror" name="customer_name" value="{{$customer_name}}">
                </div>
                <div class="inputbox">
                <input type="text" required name="customer_contact_no" value="{{$customer_contact_no}}">
                </div>
                <button type="submit" class="btn-confirm border-0" >UPDATE CUSTOMER</button>   
            </form>
    </div>
</div>
<!--  FILL UP FORM (End)-->
@endsection