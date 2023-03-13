@extends('layouts.master')
@section('title', 'Make Quotation')
@section('content')
    <h1>Make Quotation</h1>
    <div>
        <form action="{{route('add.products')}}" method="POST">
            @csrf
            <div>
                <label for="product_name">Product:</label>
                <select name="product_name" id="product_name">
                    @foreach ($products as $product)
                        <option value="{{$product->id . '|' . $product->product_price . '|' . $product->product_name}}">{{$product->product_name . ' - ' . $product->product_price}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="quantity">Qty:</label>
                <input type="number" name="quantity" value="1" min="1" >
            </div>
            {{-- HIDDEN INPUTS FOR RETAINING DURING REFRESH --}}
            <div>
                <input type="text" hidden name="date" value="{{now()->toDateString('Y-m-d')}}">
                <input type="text"  hidden name="quotation_id" value="{{$generated_id}}">
                <input type="text" hidden name="customer_id" value="{{$selected_customer}}">
                <input type="text" hidden name="customer_name" value="{{$customer_name}}">
            </div>  
            <div>
                <button type="submit" name="action" value="add">Add</button>
                <button type="submit" name="action" value="clear">Clear</button>
            </div>
        </form>
    </div>

    <hr>

    <div>Date: {{  now()->toDateString('Y-m-d') }}</div>
    <div>Quotation ID:{{ isset($generated_id) ? $generated_id: ''}}</div>
    <div>Customer ID:{{isset($selected_customer) ? $selected_customer: ''}}</div>
    <label for="customer_name">Quotation for: {{ isset($customer_name) ? $customer_name: '' }}</label>
    <form action="{{route('store.quotations')}}" method="POST">
        @csrf
        {{-- HIDDEN INPUTS FOR QUOTATION --}}
        <input type="text" hidden name="date" value="{{now()->toDateString('Y-m-d')}}">
        <input type="text" hidden name="quotation_id" value="{{$generated_id}}">
        <input type="text" hidden name="customer_id" value="{{$selected_customer}}">
        <input type="text" hidden name="total_price" value="{{$grand_total}}">
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price of Item</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($temp_tables as $temp_table)
                            <tr>
                                <td>{{$temp_table->product_name}}</td>
                                <td>{{$temp_table->quantity}}</td>
                                <td>{{$temp_table->unit_price}}</td>
                                <td>{{$temp_table->total_price}}</td>
                            </tr> 
                        @endforeach
                    </tr>
                </tbody>
              </table>
        </div>
        <h3>Grand Total: {{'PHP '.$grand_total}} </h3>
        <div>
            <button type="submit" {{ $temp_tables_isEmpty === 0 ? 'disabled' : ''}}>Make Quotation</button>
        </div>
    </form>
@endsection