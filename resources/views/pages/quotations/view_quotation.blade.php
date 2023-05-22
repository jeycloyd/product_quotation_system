@extends('layouts.master')
@section('title', 'View Quotations')
@section('content')
<div class="table-wrapper">
    <div>
        <h4>Quotation ID: {{ $quotation_id }}</h4>
        <h4>Quotation Type: {{ $quotation_type }}</h4>
        <h4>Quoted At: {{ $quotation_date }}</h4>
        <h4>Customer Name: {{ $customer_name }}</h4>
    </div>
    
    {{-- <div class="btn-group" style="margin-left:51.9%">
      <div>
        @if (auth()->user()->role == 'admin' && $approval_status == 'Approved')
            <button type="button" class="btn btn-outline-success mx-1" data-toggle="modal" data-target="#approveModal" data-id="{{$quotation_id}}">Approve</button>          
        @endif
      </div>
      <div>
        @if (auth()->user()->role == 'admin' && $approval_status == 'Approved')
            <a href="{{ route('previewPDFBilling.quotations', $quotation_id) }}" class="btn btn-secondary" target="_blank">View Billing PDF</a>
        @endif
      </div>
      <div>
            <a href="{{ route('downloadPDF.quotations', $quotation_id) }}" target="_blank" class="btn btn-primary mx-1" style="margin-left:768px">View Quotation PDF</a>
      </div>
    </div>  --}}
     
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
  <br>
  {{-- <div class="btn-group" style="margin-left:51.9%">
    <div>
      @if (auth()->user()->role == 'admin' && $approval_status != 'Approved')
          <button type="button" class="btn btn-outline-success mx-1" data-toggle="modal" data-target="#approveModal" data-id="{{$quotation_id}}">Approve</button>          
      @endif
    </div>
    <div>
      @if (auth()->user()->role == 'admin' && $approval_status == 'Approved')
          <a href="{{ route('previewPDFBilling.quotations', $quotation_id) }}" class="btn btn-secondary" target="_blank">View Billing PDF</a>
      @endif
    </div>
    <div>
      <a href="{{ route('downloadPDF.quotations', $quotation_id) }}" target="_blank" class="btn btn-primary mx-1" style="margin-left:768px">View Quotation PDF</a>
    </div>
  </div>  --}}
  {{-- show only view pdf and approve button when the quotation is not yet approved --}}
  
  @if (auth()->user()->role == 'admin' && $approval_status != 'Approved')
    <div class="btn-group" style="margin-left:67%">
      <div>
        <button type="button" class="btn btn-outline-success mx-1" data-toggle="modal" data-target="#approveModal" data-id="{{$quotation_id}}">Approve</button> 
        <button class="btn btn-outline-warning" data-toggle="modal" data-target="#editModal">Edit Quotation</button>         
      </div>
      <div>
        <a href="{{ route('downloadPDF.quotations', $quotation_id) }}" target="_blank" class="btn btn-primary mx-1" style="margin-left:768px">View Quotation PDF</a>
      </div>
    </div>
  {{-- show only view pdf and view billing when the quotation is approved --}}
  @else
    <div class="btn-group" style="margin-left:62%">
      <div>
        @if ($quotation_type != 'Rental')
          <a href="{{ route('previewPDFBilling.quotations', $quotation_id) }}" {{$billing_approval_status != 'Approved' ? 'hidden' : ''}} class="btn btn-secondary" target="_blank">Create Billing</a>
        @else
          <a href="{{ route('view.billings', $quotation_id, $grand_total) }}" {{$billing_approval_status != 'Approved' ? 'hidden' : ''}} class="btn btn-secondary">Billing</a>
        @endif
      </div>
      <div>
        <a href="{{ route('downloadPDF.quotations', $quotation_id) }}" target="_blank" class="btn btn-primary mx-1" style="margin-left:768px">View Quotation PDF</a>
      </div>
    </div>
  @endif
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

  <!---------------------------------- POP UP MODAL FOR EDITING QUOTATION----------------------------------------------------->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document" style="width: 90%; max-width: 100%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel">Edit Quotation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" style="position:fixed;">
          <select name="product_name" id="input_product_name">
            <option value="" disabled selected>>--Select Product--<</option>
            @foreach ($products as $product)
                <option value="{{$product->product_name}}"
                  data-price="{{$product->product_price}}">
                  {{$product->product_name}}
                </option>
            @endforeach
          </select>
          <input type="number" id="form_input_qty" min="1" value="1">
          <button type="button" class="btn btn-primary" id="btn-add">Add</button>
          <button type="button" class="btn btn-secondary" id="btn-clear">Clear</button>
        </form>
        <br>
        <br>
        <br>
        <br>
        <table class="content_table text-center" style="table-layout:fixed" >
          <thead>
             <tr class="tabledetails">
                  <th class="description"> Product Name </th>
                  <th class="qty"> Qty </th>
                  <th class="unitprice"> Unit Price </th>
                  <th class="subtotal"> Sub Total </th>     
                  <th class="subtotal"> Actions</th>     
             </tr>
         </thead>
         <tbody id="table_edit_quotation">
              @foreach ($product_quotations as $product_quotation)
                  <tr class="table_contents">
                      <td class="description"> {{$product_quotation->product_name}} </td>
                      <td class="qty"> {{$product_quotation->quantity}} </td>
                      <td class="unitprice" data-price="{{$product_quotation->unit_price}}"> PHP {{number_format($product_quotation->unit_price,2)}} </td>
                      <td class="subtotal">PHP {{number_format($product_quotation->unit_price * $product_quotation->quantity,2)}} </td>      
                      <td>
                        <button class="btn btn-add-qty btn-primary">+</button>
                        <button class="btn btn-subtract-qty btn-danger">-</button>
                        <button class="btn btn-remove-product btn-danger" data-id="{{$product_quotation->product_name}}">Remove</button>
                      </td>
                      <td hidden>
                        <input hidden type="text" value="{{$product_quotation->product_name}}">
                        <input hidden type="text" class="input_qty" value="{{$product_quotation->quantity}}">
                        <input hidden type="number" value="{{$product_quotation->unit_price}}">
                        <input hidden type="number" class="input_subtotal" value="{{$product_quotation->unit_price * $product_quotation->quantity}}">
                      </td>
                  </tr> 
              @endforeach
             <tr id="grand_total_row">
                   <td style="text-align: right; background-color:#163f75; color:white" colspan="3"> <strong> TOTAL </strong> </td>
                   <td colspan="2" id="grand_total" >  </td>
             </tr>
          </tbody>
     </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button class="btn btn-warning">Save</button>
      </div>
    </div>
  </div>
</div> 
<script src="{{ asset('js/modals.js') }}"></script>
<script>
  $(document).ready(function () {

    /*----------------------------------------- HELPER FUNCTION ----------------------------------------------*/

    //function to get the grand total of the products inside the edit quotation modal
    $.extend({
        getGrandTotal: function() {
            var total = 0;
          $('.input_subtotal').each(function() {
            var value = $(this).val();

            if (value !== '') {
              total += parseFloat(value);
            }
          });
          $('#grand_total').html('PHP ' + Number(total).toLocaleString(undefined, {minimumFractionDigits: 2}));
        }
    });

    $.getGrandTotal();

    //disable add button when the dropdown has no value
    $('#btn-add').prop('disabled',true);
    $('#input_product_name').on( "change", function() {
      if($('select#input_product_name option:selected').val() === ''){
      $('#btn-add').prop('disabled',true);
      }else{
        $('#btn-add').prop('disabled',false);
      }
    } );

    //add selected product to the edit quotation modal
    $('#btn-add').click(function (e) { 
      
      //check if the added product already exists in the table

      //extract product name from the drop down
      var product_name = $('select#input_product_name option:selected').val();
      var product_price = $('select#input_product_name option:selected').data('price');
      var product_qty = $('#form_input_qty').val();
      
      // Create the new element to be appended
      var newElement = $(`
          <tr class="table_contents">
              <td class="description">${product_name}</td>
              <td class="qty">${product_qty}</td>
              <td class="unitprice" data-price="${product_price}">PHP ${Number(product_price).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
              <td class="subtotal">PHP ${Number(product_qty * product_price).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
              <td>
                  <button class="btn btn-add-qty btn-primary">+</button>
                  <button class="btn btn-subtract-qty btn-danger">-</button>
                  <button class="btn btn-remove-product btn-danger" data-id="{{$product_quotation->product_name}}">Remove</button>
              </td>
              <td hidden>
                  <input hidden type="text" value="${product_name}">
                  <input hidden type="text" class="input_qty" value="${product_qty}">
                  <input hidden type="number" value="${product_price}">
                  <input hidden type="number" class="input_subtotal" value="${product_price * product_qty}">
              </td>
          </tr>
      `);

// Find the specific element before which you want to insert the new element
var specificElement = $('tbody#table_edit_quotation').find('#grand_total_row');

// Insert the new element before the specific element
newElement.insertBefore(specificElement);


      //function call
      $.getGrandTotal();
      
    });
    
    //remove selected product
    $(document).on('click', '.btn-remove-product', function(e) { 
      //remove the selected row
      $(this).closest('tr').remove();
      
      //function call
      $.getGrandTotal();
    });

    //remove all products from the quotation listed
    $('#btn-clear').click(function (e) { 
      $('tr.table_contents').empty();

      //function call
      $.getGrandTotal();
    });

    //add 1 quantity to product
    var intervalId;

    $(document).on('click mousedown', '.btn-add-qty', function(e) {
      // Function to perform the desired actions
      var performEvent = function() {
        // Get qty of row
        var inputQty = parseFloat($(e.target).closest('tr').find('.input_qty').val());
        inputQty += 1;

        // Update the data value and the input qty id of the selected row
        $(e.target).data('qty', inputQty);
        $(e.target).closest('tr').find('.input_qty').val(inputQty);
        $(e.target).closest('tr').find('.qty').html(inputQty);

        // Update subtotal
        // Extract the price of the row
        var unit_price = $(e.target).closest('tr').find('.unitprice').data();
        var total_price = Number(unit_price.price * inputQty).toLocaleString(undefined, { minimumFractionDigits: 2 });
        var sub_total = unit_price.price * inputQty;

        $(e.target).closest('tr').find('.subtotal').html('PHP ' + total_price);
        $(e.target).closest('tr').find('.input_subtotal').val(sub_total);

        // Function call
        $.getGrandTotal();
      };

      // Trigger the event immediately on click
      if (e.type === 'click') {
        performEvent();
      } else if (e.type === 'mousedown') {
        // Start the continuous event on mousedown
        intervalId = setInterval(performEvent, 200); // Adjust the interval duration as needed
      }
    });
    
    //subtract 1 quantity to product
    $(document).on('click mousedown', '.btn-subtract-qty', function(e) {
      // Function to perform the desired actions
      var performEvent = function() {
        // Get qty of row
        var inputQty = parseFloat($(e.target).closest('tr').find('.input_qty').val());
        inputQty -= 1;

        // Update the data value and the input qty id of the selected row
        $(e.target).data('qty', inputQty);
        $(e.target).closest('tr').find('.input_qty').val(inputQty);
        $(e.target).closest('tr').find('.qty').html(inputQty);

        // Update subtotal
        // Extract the price of the row
        var unit_price = $(e.target).closest('tr').find('.unitprice').data();
        var total_price = Number(unit_price.price * inputQty).toLocaleString(undefined, { minimumFractionDigits: 2 });
        var sub_total = unit_price.price * inputQty;

        $(e.target).closest('tr').find('.subtotal').html('PHP ' + total_price);
        $(e.target).closest('tr').find('.input_subtotal').val(sub_total);

        // Function call
        $.getGrandTotal();
      };

      // Trigger the event immediately on click
      if (e.type === 'click') {
        performEvent();
      } else if (e.type === 'mousedown') {
        // Start the continuous event on mousedown
        intervalId = setInterval(performEvent, 200); // Adjust the interval duration as needed
      }
    });

    // Event handler when the mouse button is released
    $(document).on('mouseup', function(e) {
      // Stop the continuous event
      clearInterval(intervalId);
    });
  });
</script>
@endsection