@extends('layouts.master')
@section('title', 'View Customers')
@section('content')
@section('header','View Customers')
  <div class="table-wrapper">
    @if (\Session::has('success'))
        <div class="alert alert-success">
              {!! \Session::get('success') !!}
        </div>
    @endif
    <a href="/customers/create" class="btn btn-success" style="margin-bottom: 15px">Add New Customer</a>
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
                          <a href="{{route('view.customers',$customer->id)}}" class="btn btn-dark">View</a>
                          <a href="{{route('show.customers',$customer->id)}}" class="btn btn-warning">Edit</a>
                          <a href="{{route('destroy.customers',$customer->id)}}" class="btn btn-danger">Delete</a>
                      </td>
                  </tr>    
              @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $customers->withQueryString()->links() }}
        </div>
  </div>
@endsection