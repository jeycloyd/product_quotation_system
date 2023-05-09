@extends('layouts.master')
@section('title', 'Billing')
@section('content')
@section('header','Billing')
    <div  class="table-wrapper">
        
        <table class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">PERIOD</th>
            <th scope="col">DUE</th>
            <th scope="col">STATUS</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
                  @foreach ($billings as $billing)
                      <tr>
                        
                        <td>{{$billing->PERIOD}}</td>
                        <td>{{$billing->DUE}}</td>
                        <td>{{$billing->DUE != '0' ? 'UNPAID' : 'PAID'}}</td>
                        <td>
                            <button class="btn btn-success" {{$billing->DUE != '0' ? '' : 'disabled'}} data-toggle="modal" data-target="#markAsPaidModal">Mark As Paid</button>
                        </td>
                      </tr>
                  @endforeach
        </tbody>
      </table>
      {{-- <div class="d-flex justify-content-center">
        {{ $quotations->withQueryString()->links() }}
      </div> --}}
    </div>
    <h2>Total Balance: {{$total_balance}}</h2>

    <!---------------------------------- Mark as Paid Modal----------------------------------------------------->
<div class="modal fade" id="markAsPaidModal" tabindex="-1" role="dialog" aria-labelledby="markAsPaidModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Mark as PAID?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Mark this due as "PAID"?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Confirm</button>
      </div>
    </div>
  </div>
</div>
@endsection