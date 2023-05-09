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
                <h1 class="h1_CustomerRegistration" ><center>Customer and Quotation Type</center> </h1>
                <form action="{{route('create.quotations')}}" method="GET" class="fillupform">
                    @csrf
                    <div>
                        <select name="customer_name" class="form-select" aria-label="Default select example" id="customer_name" style="width: 300px" required>
                            <option value="" disabled selected>------------Select Customer------------</option>
                            @foreach ($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <select name="quotation_type" class="form-select" aria-label="Default select example" id="quotation_type" style="width: 300px" required>
                            <option value="" disabled selected>------------Quotation Type------------</option>
                            <option value="Retail">Retail</option>
                            <option value="Services">Services</option>
                            <option value="Rental">Rental</option>
                        </select>
                        <br>
                    </div>
                        <button type="submit" class="btn-confirm border-0" style="margin-top: 35%; margin-left: 18px" >NEXT</button> 
                </form>
            </div>
        </div>
        <!--  FILL UP FORM (End)-->
@endsection