@extends('layouts.master')
@section('title', 'View Quotations')
@section('content')
@section('header','View Quotations')
  <div  class="table-wrapper" style="width: 1200px; margin-left: -530px;">
        <form action="{{route('search.quotations')}}" method="GET">
              <div class="input-group mb-3">
                  @csrf
                  <div class="col-xs-2">
                    <select class="form-select" name="approval_status">
                      <option value=""  selected style="display:none">--Approval Status--</option>
                      <option value="">All</option>
                      <option value="Approved" {{ isset($oldApprovalStatus) && old('approval_status', $oldApprovalStatus) == 'Approved' ? 'selected' : '' }}>Approved</option>
                      <option value="For Approval" {{ isset($oldApprovalStatus) && old('approval_status', $oldApprovalStatus) == 'For Approval' ? 'selected' : '' }}>For Approval</option>
                    </select>
                  </div>
                  <div class="col-xs-2">
                    <select class="form-select" name="quotation_type">
                      <option value=""  selected style="display:none">--Quotation Type--</option>
                      <option value="">All</option>
                      <option value="Retail" {{ isset($oldQuotationType) && old('quotation_type', $oldQuotationType) == 'Retail' ? 'selected' : '' }}>Retail</option>
                      <option value="Services" {{ isset($oldQuotationType) && old('quotation_type', $oldQuotationType) == 'Services' ? 'selected' : '' }}>Services</option>
                      <option value="Rental" {{ isset($oldQuotationType) && old('quotation_type', $oldQuotationType) == 'Rental' ? 'selected' : '' }}>Rental</option>
                    </select>
                  </div>                  
                  <input type="text" class="form-control" placeholder="Search..." name="search">
                  <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
              </div>
        </form>  
        <table class="table table-hover text-center">
          <thead>
            <tr>
              <th scope="col">Quotation ID</th>
              <th scope="col">Quotation Type</th>
              <th scope="col">Quoted For</th>
              <th scope="col">Quoted At</th>
              <th scope="col">Approval Status</th>
              <th scope="col">Billing Approval Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                  @foreach ($quotations as $quotation)
                      <tr>
                          <td>{{$quotation->id}}</td>
                          <td>{{$quotation->quotation_type}}</td>
                          <td>{{$quotation->customer_name}}</td>
                          <td>{{$quotation->created_at}}</td>
                          <td>{{$quotation->approval_status}}</td>
                          <td>{{$quotation->billing_approval_status}}</td>
                          <td>
                              
                              <a href="{{route('show.quotations', $quotation->id)}}" class="btn btn-outline-primary">View</a>
                              {{-- @if (auth()->user()->role == 'admin')
                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#approveModal" data-id="{{$quotation->id}}" {{($quotation->approval_status == 'Approved') ? 'disabled' : ''}} >Approve</button>
                              @endif  
                              @if (auth()->user()->role == 'admin')
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$quotation->id}}">Delete</button>
                                <button class="btn btn-outline-warning" data-toggle="modal" data-target="#billingApprovalModal" {{($quotation->approval_status == 'Approved') ? 'disabled' : ''}}>Approve For Billing</button>
                              @endif --}}
                              @if (auth()->user()->role == 'admin')
                                @if ($quotation->billing_approval_status != 'Approved' && $quotation->approval_status == 'For Approval')
                                  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#approveModal" data-id="{{$quotation->id}}">Approve</button>
                                @else
                                  <button class="btn btn-outline-warning" data-toggle="modal" data-target="#billingApprovalModal" {{($quotation->billing_approval_status == 'Approved') ? 'disabled' : ''}}>Approve For Billing</button>
                                @endif
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
        <form id="delete_form" action="{{route('destroy.quotations')}}" method="GET">
          @csrf
          <input  type="text" hidden name="id" class="form-control" id="id">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" form="delete_form" class="btn btn-danger">Yes, Delete it</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!---------------------------------- POP UP MODAL FOR APPROVING QUOTATION----------------------------------------------------->
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

<!---------------------------------- POP UP MODAL FOR APPROVING BILLING----------------------------------------------------->
<div class="modal fade" id="billingApprovalModal" tabindex="-1" role="dialog" aria-labelledby="billingApprovalModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel">Confirm Billing Approval?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Insert picture of the receipt
        <form id="approve_billing_form" action="#" enctype="multipart/form-data">
          @csrf
          <input type="text" hidden name="id" class="form-control" id="id">
          <input type="file" name="receipt" class="form-control" id="receipt" required>
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