@extends('layouts.master')
@section('title', 'Add Customer')
@section('content')
    <h1>Add Customer</h1>
    <div>
        <form action="{{route('store.customers')}}" method="POST">
            @csrf
            <div>
                @error('customer_name')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="customer_name">Name:</label>
                <input type="text" class="@error('customer_name') is-invalid @enderror" name="customer_name">
            </div>
            <div>
                @error('customer_contact_no')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="customer_contact_no">Contact No:</label>
                <input type="text" class="@error('customer_contact_no') is-invalid @enderror" name="customer_contact_no">
            </div>
            <div>
                <button type="submit">Add Customer</button>
            </div>
        </form>
    </div>
@endsection