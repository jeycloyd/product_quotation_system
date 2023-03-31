@extends('layouts.master')
@section('title', 'View Quotations')
@section('content')
<div class="table-wrapper" style="width: 900px; margin-left: -300px; margin-top: -170px">
    <div style="margin-top: 50px">
        <h4>Quotation ID: {{ $quotation_id }}</h4>
        <h4>Quoted At: {{ $quotation_date }}</h4>
        <h4>Customer Name: {{ $customer_name }}</h4>
    </div>
    <a href="{{ route('downloadPDF.quotations', $quotation_id) }}" target="_blank" class="btn btn-primary" style="margin-left:768px">View PDF</a>
    <br>
    <br>
    <table class="content_table">
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
@endsection