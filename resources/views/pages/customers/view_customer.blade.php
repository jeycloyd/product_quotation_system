@extends('layouts.master')
@section('title', 'View Customer')
@section('content')
<div class="table-wrapper">
    <div>
        <h4>Customer Name: {{ $customer_name}} </h4>
    </div>
    <a href="{{route('view.billings',$customer_id)}}" class="btn btn-primary">Generate Billing</a>
      <form action="{{route('search.customerQuotations', $customer_id)}}" method="GET">
          <div class="input-group mb-3">
              @csrf
              {{-- <input type="text" name="customer_name" value="{{$customer_name}}">
              <input type="text" name="quotation_id" value="1202304011">
              <input type="text" name="customer_id" value="1"> --}}
              <div class="col-xs-2">
                <select class="form-select" name="approval_status">
                  <option  value="">All</option>
                  <option  value="Approved" >Approved</option>
                  <option  value="For Approval">For Approval</option>
                </select>
              </div>
              <input type="text" class="form-control" placeholder="Search by quotation id..." name="search">
              <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
          </div>
      </form>  
      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Quotation ID</th>
              <th scope="col">Created At</th>
              <th scope="col">Approval Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($customer_quotations as $customer_quotation)
                  <tr>
                      <td>{{$customer_quotation->quotation_id}}</td>
                      <td>{{$customer_quotation->created_at}}</td>
                      <td>{{$customer_quotation->approval_status}}</td>
                      <td>
                            <a href="{{route('show.quotations', $customer_quotation->quotation_id)}}" class="btn btn-outline-primary">View</a>
                            @if (auth()->user()->role == 'admin')
                              <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#approveModal" data-id="{{$customer_quotation->quotation_id}}" {{($customer_quotation->approval_status == 'For Approval') ? '' : 'disabled'}}>Approve</button>
                            @endif
                      </td>
                  </tr>    
              @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $customer_quotations->withQueryString()->links() }}
          </div>
  </div>
  <!---------------------------------- POP UP MODAL FOR APPROVING----------------------------------------------------->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approveModalLabel">Confirm Quotation Approval?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Approve this quotation?
          <form id="approve_form" action="{{route('approve.quotations')}}" method="PUT">
            @csrf
            <input type="text" hidden name="id" class="form-control" id="id">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" form="approve_form" class="btn btn-success">Yes, Approve it</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/modals.js') }}"></script> 
@endsection