@extends('layouts.master')
@section('title', 'View Quotations')
@section('content')
<div class="table-wrapper" style="width: 900px; margin-left: -390px; margin-top: -170px">
    <div style="margin-top: 50px">
        <h4>Quotation ID: {{ $quotation_id }}</h4>
        <h4>Quoted At: {{ $quotation_date }}</h4>
        <h4>Customer Name: {{ $customer_name }}</h4>
    </div>
    <div class="row" style="margin-left:73%">
      <div class="col">
        @if (auth()->user()->role == 'admin' && $approval_status != 'Approved')
            <button type="button" class="btn btn-outline-success mx-1" data-toggle="modal" data-target="#approveModal" data-id="{{$quotation_id}}">Approve</button>
        @endif
      </div>
      <div class="col" style="margin-left:-28%">
            <a href="{{ route('downloadPDF.quotations', $quotation_id) }}" target="_blank" class="btn btn-primary mx-1" style="margin-left:768px">View PDF</a>
      </div>
    </div> 
    <br>
    <br>
    <table class="content_table text-center">
        <thead>
           <tr>
                 <th class="table-title" colspan="5"> AUXILIARY EQUIPMENT </th>
           </tr>
           <tr class="tabledetails">
                <th class="option"> Option </th>
                <th class="description"> Description </th>
                <th class="qty"> Qty </th>
                <th class="unitprice"> Unit Price </th>
                <th class="subtotal"> Sub Total </th>     
           </tr>
       </thead>
       <tbody>
            @foreach ($product_quotations as $product_quotation)
                <tr>
                    <td class="option"> {{$loop->iteration}} </td>
                    <td class="description"> {{$product_quotation->product_name}} </td>
                    <td class="qty"> {{$product_quotation->quantity}} </td>
                    <td class="unitprice"> PHP {{number_format($product_quotation->unit_price,2)}} </td>
                    <td class="subtotal">PHP {{number_format($product_quotation->unit_price * $product_quotation->quantity,2)}} </td>      
                </tr> 
            @endforeach
           <tr>
                 <td style="text-align: right; background-color:#163f75; color:white" colspan="3"> <strong> TOTAL </strong> </td>
                 <td colspan="2">PHP {{number_format($grand_total,2)}} </td>
           </tr>
        </tbody>
   </table>
   <div class="d-flex justify-content-center">
    {{ $product_quotations->links() }}
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