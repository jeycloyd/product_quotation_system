@extends('layouts.master')
@section('title', 'View Customer')
@section('content')
<div class="table-wrapper">
    <div>
        <h4>Customer Name: {{ $customer_name }}</h4>
    </div>
      {{-- <form action="{{route('search.customers')}}" method="GET">
          <div class="input-group mb-3">
              @csrf
              <input type="text" class="form-control" placeholder="Search..." name="search">
              <button type="submit" class="btn btn-primary">Search</button>
          </div>
      </form>   --}}
      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Quotation ID</th>
              <th scope="col">Created At</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($customer_quotations as $customer_quotation)
                  <tr>
                      <td>{{$customer_quotation->quotation_id}}</td>
                      <td>{{$customer_quotation->created_at}}</td>
                      <td>
                          <a href="{{route('show.quotations', $customer_quotation->quotation_id)}}" class="btn btn-success">View</a>
                      </td>
                  </tr>    
              @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $customer_quotations->withQueryString()->links() }}
          </div>
  </div>
@endsection