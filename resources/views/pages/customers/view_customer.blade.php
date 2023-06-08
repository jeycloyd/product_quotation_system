@extends('layouts.master')
@section('title', 'View Customer')
@section('content')
<div class="table-wrapper">
    <div>
        <h4>Customer Name: {{ $customer_name}} </h4>
    </div>
      <form action="{{route('search.customerQuotations', $customer_id)}}" method="GET" style="width:50%">
          <div class="input-group mb-3">
              @csrf
              {{-- <input type="text" name="customer_name" value="{{$customer_name}}">
              <input type="text" name="quotation_id" value="1202304011">
              <input type="text" name="customer_id" value="1"> --}}
              {{-- <div class="col-xs-2">
                <select class="form-select" name="approval_status">
                  <option  value="">All</option>
                  <option  value="Approved" >Approved</option>
                  <option  value="For Approval">For Approval</option>
                </select>
              </div> --}}
              <div class="col-xs-2">
                <select class="form-select" name="quotation_type">
                  <option value="" disabled selected>--Quotation Type--</option>
                  <option  value="">All</option>
                  <option  value="Retail" >Retail</option>
                  <option  value="Services">Services</option>
                  <option  value="Rental">Rental</option>
                </select>
              </div>
              <input type="text" class="form-control" placeholder="Search by quotation id..." name="search">
              <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
          </div>
      </form>  
      <table class="table table-hover" >
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Quotation ID</th>
              <th scope="col">Quotation Type</th>
              <th scope="col">Created At</th>
              <th scope="col">Approval Status</th>
              <th scope="col">Billing Approval Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(isset($count_customer_quotations))
                @if ($count_customer_quotations == 0)
                <tr>
                  <th colspan="7" style="text-align: center" >No Results Found!</th>
                </tr>
                @endif
              @endif 
              @foreach ($customer_quotations as $customer_quotation)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$customer_quotation->quotation_id}}</td>
                      <td>{{$customer_quotation->quotation_type}}</td>
                      <td>{{$customer_quotation->created_at}}</td>
                      <td {{$customer_quotation->approval_status == 'Approved' ? 'style=color:green' : 'style=color:red'}}>{{$customer_quotation->approval_status}}</td>
                      <td {{$customer_quotation->billing_approval_status == 'Approved' ? 'style=color:green' : 'style=color:red'}}>{{$customer_quotation->billing_approval_status}}</td>
                      <td>
                            <a href="{{route('show.quotations', $customer_quotation->quotation_id)}}" class="btn btn-outline-primary">View</a>
                            @if (auth()->user()->role == 'admin')
                                @if ($customer_quotation->billing_approval_status != 'Approved' && $customer_quotation->approval_status == 'For Approval')
                                  <button class="btn btn-outline-success" data-toggle="modal" data-target="#approveModal" data-id="{{$customer_quotation->quotation_id}}">Approve</button>
                                @else
                                 <button class="btn btn-outline-warning" data-toggle="modal" data-target="#billingApprovalModal" data-billing="{{$customer_quotation->quotation_id}}" data-customer_id="{{$customer_quotation->customer_id}}" {{($customer_quotation->billing_approval_status == 'Approved') ? 'disabled'  : ''}}>Approve For Billing</button>
                                @endif
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
            <input type="text"  name="id" class="form-control" id="id">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" form="approve_form" class="btn btn-success">Yes, Approve it</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!---------------------------------- POP UP MODAL FOR APPROVING BILLING----------------------------------------------------->
<div class="modal fade" id="billingApprovalModal" tabindex="-1" role="dialog" aria-labelledby="billingApprovalModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel">Confirm Billing Approval</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Confirm for Billing Approval?
        <form id="approve_billing_form" action="{{route('approve.billings')}}" method="POST">
          @csrf
          <input type="text" hidden  id="input_for_image_receipt"  name="id" class="form-control">
          <input type="text" hidden id="input_customer_id"  name="customer_id" class="form-control">
          <input type="number" hidden id="input_total"  name="total" class="form-control">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" form="approve_billing_form" class="btn btn-success">Yes, Approve it</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <script src="{{ asset('js/modals.js') }}"></script> 
@endsection