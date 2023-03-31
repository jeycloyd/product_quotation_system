@extends('layouts.master')
@section('title', 'View Quotations')
@section('content')
@section('header','View Quotations')
  <div  class="table-wrapper">
        <form action="{{route('search.quotations')}}" method="GET">
              <div class="input-group mb-3">
                  @csrf
                  <input type="text" class="form-control" placeholder="Search..." name="search">
                  <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
              </div>
        </form>  
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Quotation ID</th>
              <th scope="col">Quoted For</th>
              <th scope="col">Quoted At</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                  @foreach ($quotations as $quotation)
                      <tr>
                          <td>{{$quotation->id}}</td>
                          <td>{{$quotation->customer_name}}</td>
                          <td>{{$quotation->created_at}}</td>
                          <td>
                              <a href="{{route('show.quotations', $quotation->id)}}" class="btn btn-success">View</a>
                              @if (auth()->user()->role == 'admin')
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$quotation->id}}"><i class='bx bxs-trash' style='color:#ffffff' ></i></button>
                              @endif
                          </td>
                      </tr>
                  @endforeach
              </tr> 
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $quotations->withQueryString()->links() }}
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
        Are you sure you want to remove this quotation detail?
        <form action="{{route('destroy.quotations')}}" method="GET">
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