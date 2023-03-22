@extends('layouts.master')
@section('title', 'View Customers')
@section('content')
@section('header','View Customers')
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Customer ID</th>
            <th scope="col">Name</th>
            <th scope="col">Contact No.</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->customer_name}}</td>
                    <td>{{$customer->customer_contact_no}}</td>
                    <td>
                        <a href="{{route('show.customers',$customer->id)}}" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>    
            @endforeach
        </tbody>
      </table>
@endsection