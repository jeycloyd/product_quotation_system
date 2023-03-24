@extends('layouts.master')
@section('title', 'Select Customer')
@section('content')
    <div>
        <!--  FILL UP FORM (Start)-->
        <div class="wrapper2">
            <div>
                <!--  REGISTRATION FORM (Start)-->
                <h1 class="h1_CustomerRegistration"> SELECT CUSTOMER </h1>
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
                @endif
                <form action="{{route('create.quotations')}}" method="GET" class="fillupform">
                    @csrf
                    <div>
                        <select name="customer_name" class="form-select" aria-label="Default select example" id="customer_name" style="width: 300px">
                            @foreach ($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn-confirm border-0" >NEXT</button> 
                </form>
            </div>
        </div>
        <!--  FILL UP FORM (End)-->
    </div>
@endsection