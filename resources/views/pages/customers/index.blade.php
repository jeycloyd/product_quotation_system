@extends('layouts.master')
@section('title', 'View Customers')
@section('content')
@section('header','View Customers')
<div class="table-wrapper">
    <form action="{{route('search.customers')}}" method="GET">
        <div class="input-group mb-3">
            @csrf
            <input type="text" class="form-control" placeholder="Search..." name="search">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>  
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
                        <a href="{{route('destroy.customers',$customer->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>    
            @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {{ $customers->links() }}
      </div>
</div>

@endsection