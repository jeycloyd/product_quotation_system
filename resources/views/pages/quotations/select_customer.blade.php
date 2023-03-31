@extends('layouts.master')
@section('title', 'Select Customer')
@section('content')
    
        <!--  FILL UP FORM (Start)-->
        {{-- @if (\Session::has('success'))
                <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                </div>
        @endif --}}
        <div class="wrapper2">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}
                </div>
            @endif
            <div>
                <!--  REGISTRATION FORM (Start)-->
                <h1 class="h1_CustomerRegistration"> SELECT CUSTOMER </h1>
                <form action="{{route('create.quotations')}}" method="GET" class="fillupform">
                    @csrf
                    <div>
                        <select name="customer_name" class="form-select" aria-label="Default select example" id="customer_name" style="width: 300px">
                            @foreach ($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn-confirm border-0" style="margin-top: 35%; margin-left: 18px" >NEXT</button> 
                </form>
            </div>
        </div>
        <!--  FILL UP FORM (End)-->
@endsection