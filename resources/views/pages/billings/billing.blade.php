@extends('layouts.master')
@section('title', 'Billing')
@section('content')
{{-- @section('header')
    Billing for Quotation: {{$quotation_id}}
@endsection --}}
<h1 class="h1_header_test">Billing for Quotation: {{$quotation_id}}</h1>
    <div  class="table-wrapper">
      @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
      @endif
      <button class="btn btn-primary" data-toggle="modal" data-target="#createBillingModal">Create Billing</button>
      <br>
      <br>

      <div style="width: 50%;">
        <form action="{{route('search.billings',$quotation_id)}}" method="GET">
          <div class="input-group mb-3">
              @csrf
              <select name="month" id="select_input_month" class="form-control">
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
              <select name="year" id="select_input_year" class="form-control">
              </select>
              {{-- <input type="text" class="form-control" placeholder="Search..." name="search"> --}}
              <button type="submit" class="btn btn-primary"><i class='bx bx-search'></i></button>
          </div>
        </form>
      </div>

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
                      <td>{{$billing->month}}, {{$billing->year}}</td>
                      <td>{{number_format($billing->due,2)}}</td>
                      <td {{$billing->payment_status == 'paid' ? 'style=color:green' : 'style=color:red'}}>{{$billing->payment_status}}</td>
                      <td>
                        @if ($billing->payment_status == 'unpaid')
                          <button class="btn btn-success" data-id="{{$billing->id}}" data-toggle="modal" data-target="#markAsPaidModal">Mark As Paid</button>
                        @else
                          <button class="btn btn-outline-success" data-image="{{$billing->receipt_image}}" data-id="{{$billing->id}}" data-toggle="modal" data-target="#viewReceiptModal">View Receipt</button>
                        @endif
                      </td>
                </tr> 
                @endforeach  
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {{ $billings->withQueryString()->links() }}
      </div>
      <h2 style="float:right; padding-right:5%">Remaining Balance: 
          @if ( $total_balance == 0)
            <strong> PHP {{number_format($total_balance,2)}}</strong>
          @else
            <strong style="color:red" >PHP {{number_format($total_balance,2)}}</strong>
          @endif 
      </h2>
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
          <form action="{{route('create.billings',$quotation_id)}}" method="POST" id="createBilling-form">
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
              <input type="number" min="1" name="due" value="{{$quotation_cost}}" class="form-control" required>   
              <input type="text" name="customer_id" value="{{$customer_id}}" hidden>
              <input type="text" name="quotation_id" value="{{$quotation_id}}" hidden>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success" form="createBilling-form">Create</button>
        </div>
      </div>
    </div>
  </div>

  <!---------------------------------- View Receipt Modal----------------------------------------------------->
  <div class="modal fade" id="viewReceiptModal" tabindex="-1" role="dialog" aria-labelledby="viewReceiptModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Image of the Receipt</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="display: flex; justify-content: center; align-items: center;">
          <img id="image_receipt" style="width:350px; height: 400px;" alt="an image of the receipt">
        </div>        
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
        
        //populate dropdown with year starting from 1900 to 2099
        for (let startYear = 1900; startYear < 2100; startYear++) {
          //check if the current value of startYear matches the current year. If matched, make it the selected option
          if(startYear != currentYear){
            $('#input_year, #select_input_year').append('<option >' + startYear  + '</option>')
          }else{
            $('#input_year, #select_input_year').append('<option selected>' + startYear  + '</option>')
          }
        }
    });
</script>
<script src="{{ asset('js/modals.js') }}"></script>
@endsection