@extends('layouts.master')
@section('title', 'Select Customer')
@section('content')
    <h1>Select Customer</h1>
    <div>
        <form action="{{route('create.quotations')}}" method="POST">
            @csrf
            <div>
                <label for="customer_name">Customer Name:</label>
                <select name="customer_name" id="customer_name">
                    @foreach ($customers as $customer)
                        <option value="{{$customer->customer_name}}">{{$customer->customer_name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>
@endsection