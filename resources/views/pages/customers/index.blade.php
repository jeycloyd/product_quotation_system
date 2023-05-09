@extends('layouts.master')
@section('title', 'View Customers')
@section('content')
@section('header','View Customers')
  <div class="table-wrapper" style="width:70em">
    @if (\Session::has('success'))
        <div class="alert alert-success">
              {!! \Session::get('success') !!}
        </div>
    @endif
    <a href="/customers/create" class="btn btn-success" style="margin-bottom: 15px"><i class='bx bxs-user-plus' style='color:#ffffff' ></i>Add New Customer</a>
      <form action="{{route('search.customers')}}" method="GET">
          <div class="input-group mb-3">
              @csrf
              <input type="text" class="form-control" placeholder="Search..." name="search">
              <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
          </div>
      </form>  
      <table class="table table-hover text-center">
          <thead>
            <tr>
              <th scope="col">Customer ID</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Contact No.</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($customers as $customer)
                  <tr>
                      <td>{{$customer->id}}</td>
                      <td>{{$customer->customer_name}}</td>
                      <td>{{$customer->address}}</td>
                      <td>{{$customer->customer_contact_no}}</td>
                      <td>
                          <a href="{{route('view.customers',$customer->id)}}" class="btn btn-outline-primary">View</a>
                          @if (auth()->user()->role == 'admin')
                            <a href="{{route('show.customers',$customer->id)}}" class="btn btn-outline-warning">Edit</a>
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$customer->id}}">Delete</button>
                          @endif        
                      </td>
                  </tr>    
              @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $customers->withQueryString()->links() }}
        </div>
  </div>

<!---------------------------------- POP UP MODAL FOR CONFIRM DELETE----------------------------------------------------->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to remove this customer?
        <form action="{{route('destroy.customers')}}" method="GET">
          @csrf
          <input hidden type="text" name="id" class="form-control" id="id">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete it</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/modals.js') }}"></script>
@endsection