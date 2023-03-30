@extends('layouts.master')
@section('title', 'View Customers')
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
                          {{-- <a data-toggle="modal" href="#deleteModal" class="btn btn-danger" data-id="{{$customer->id}}">Delete</a> --}}
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Are you sure you want to remove this customer detail?
            <input type="text" id="customer_id_input" name="customer_id" value="">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Yes, Delete it</button>
            </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/modals.js') }}"></script>
@endsection