@extends('layouts.master')
@section('title', 'Make Quotation')
@section('content')
<div class="table-wrapper" style="width: 1090px; margin-left: -335px; margin-top:-190px;">
    <!--  FILL UP FORM (Start)-->
    <div class="wrapper4">
        <div class="fillup_container">
            <div>
                <h1 class="h1_AddQuotation"> CREATE QUOTATION </h1>
                <div class="float_quotationcontainer">
                    <form action="{{route('add.products')}}" method="POST">
                        @csrf
                        <select class="form-select" name="product_name" aria-label="Default select example" style=
                        "margin-left:38px;
                        margin-top:15px;
                        width:680px;
                        padding:6px;">
                            @foreach ($products as $product)
                                <option value="{{$product->id . '|' . $product->product_price . '|' . $product->product_name}}">{{$product->product_name . ' - ' . 'PHP '.number_format($product->product_price,2)}}</option>
                            @endforeach
                        </select>
                        <div class="qtyquotation" style="top:-38px; left: -50px">
                            <input type="number" required="required" name="quantity" min="1" value="1">
                        </div>
                        <div>
                            <button type="submit" name="action" class="btn-add border-0" value="add">Add</button>
                            <button type="submit" name="action" class="btn-clear border-0" value="clear">Clear</button>
                        </div>
                        {{-- HIDDEN INPUTS FOR RETAINING DURING REFRESH --}}
                        <div>
                            <input type="text" hidden name="date" value="{{now()->toDateString('Y-m-d')}}">
                            <input type="text" hidden name="quotation_id" value="{{$generated_id}}">
                            <input type="text" hidden name="customer_id" value="{{$selected_customer}}">
                            <input type="text" hidden name="customer_name" value="{{$customer_name}}">
                        </div> 
                    </form>
                </div>  
            </div>
        </div>
    </div>
    <!--  FILL UP FORM (End)-->
    <div style="padding: 8px 1em 1em 2.3em;">
        <div> Date: {{ \Carbon\Carbon::parse(now())->format('F j, Y')}} </div>
        <div> Quotation ID: <strong>{{ isset($generated_id) ? $generated_id: ''}} </strong></div>
        <label for="customer_name">Quotation for: {{ isset($customer_name) ? $customer_name: '' }}</label>
    </div>
    <form action="{{route('store.quotations')}}" method="POST">
        @csrf
        {{-- HIDDEN INPUTS FOR QUOTATION --}}
        <input type="text" hidden name="date" value="{{now()->toDateString('Y-m-d')}}">
        <input type="text" hidden name="quotation_id" value="{{$generated_id}}">
        <input type="text" hidden name="customer_id" value="{{$selected_customer}}">
        <input type="text" hidden name="total_price" value="{{$grand_total}}">
        <div class="scrollable" style="overflow: scroll; height: 270px; max-height:270px; width: 67em; max-width: 200em;">
            <table class="table table-hover">
                <thead>
                  <tr style="text-align: center">
                    <th scope="col">Item</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($temp_tables as $temp_table)
                        <tr style="text-align: center">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$temp_table->product_name}}</td>
                            <td>{{$temp_table->quantity}}</td>
                            <td>PHP{{number_format($temp_table->unit_price,2)}}</td>
                            <td>PHP{{number_format($temp_table->total_price,2)}}</td>
                            <td>
                                <a href="{{route('destroy.quotationsProducts', ['product_name' => $temp_table->product_name, 'quotation_id' => $generated_id])}}" class="btn btn-danger">Remove</a>
                                <a href="{{route('subtractOne.quotationsProducts', ['product_name' => $temp_table->product_name, 'quotation_id' => $generated_id])}}" class="btn btn-danger">-</a>  
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="wrapper5">
            <h4 class="h4_GrandTotalName">GRAND TOTAL: {{ 'PHP ' . number_format($grand_total,2)}}</h4> 
        </div>
        <div>
            <button type="submit" {{ $temp_tables_count === 0 ? 'disabled' : ''}} class="btn-makequotation border-0">Create Quotation</button>
        </div>
    </form>
</div>
@endsection