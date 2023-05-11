@extends('layouts.master')
@section('title', 'Billing')
@section('content')
@section('header','Billing for ' . $quotation_id )
     
    <div  class="table-wrapper">
      <button class="btn btn-primary" data-toggle="modal" data-target="#createBillingModal">Create Billing</button>
        <form action="#" method="GET">
          <div class="input-group mb-3">
              @csrf
              <input type="text" class="form-control" placeholder="Search..." name="search">
              <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
          </div>
        </form>  
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
                  
        </tbody>
      </table>
      <h2 style="float:right">Total Balance: PHP {{number_format($total,2)}} </h2>
      {{-- <div class="d-flex justify-content-center">
        {{ $quotations->withQueryString()->links() }}
      </div> --}}
    </div>

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
          Upload image receipt:
          <form action="{{route('markAsPaid.billings')}}" method="POST" id="markAsPaid-form" enctype="multipart/form-data">
            @csrf
            <input type="text" hidden name="billing_id" id="input_billing_id">
            <input type="file" name="receipt_image" id="input_image_receipt" class="form-control" required>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success" form="markAsPaid-form">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <!---------------------------------- Create Billing Modal----------------------------------------------------->
  <div class="modal fade" id="createBillingModal" tabindex="-1" role="dialog" aria-labelledby="createBillingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel"><strong>Create Billing for {{$quotation_id}} </strong> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#" id="createBilling-form">
              @csrf
              <label for="month">Select Month:</label>
                <select id="input_month" name="month" required class="form-control">
                  <option value="" disabled selected>Select a month</option>
                  <option value="January">January</option>
                  <option value="February">February</option>
                  <option value="March">March</option>
                  <option value="April">April</option>
                  <option value="May">May</option>
                  <option value="June">June</option>
                  <option value="July">July</option>
                  <option value="August">August</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                  <option value="November">November</option>
                  <option value="December">December</option>
                </select>
              <br>
              <label for="year">Select Year:</label>
              <select name="year" id="input_year" class="form-control">
              </select>
              <br>
              <label for="due">Due:</label>
              <input type="number" min="1" value="{{$total}}" class="form-control" required>   
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success" form="createBilling-form">Create</button>
        </div>
      </div>
    </div>
  </div>

 {{-- jquery for populating the drop down of year input --}}
<script>
    $(document).ready(function () {
        //get current year
        const d = new Date();
        let currentYear = d.getFullYear();
        
        //populate year lower than the current year
        while (currentYear>=1900){
          $('#input_year').append('<option>' + currentYear + '</option>')
          currentYear--;
        }

        //get the current year again
        currentYear = d.getFullYear();
        $('#input_year').append('<option selected>' + currentYear + '</option>')

        //populate year higher than the current year
        while (currentYear<2100){
          $('#input_year').append('<option>' + currentYear + '</option>')
          currentYear++;
        }  
    });
</script>
<script src="{{ asset('js/modals.js') }}"></script>
@endsection