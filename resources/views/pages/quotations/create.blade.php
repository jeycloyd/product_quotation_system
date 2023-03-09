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
            <div>
                <button type="submit">Add</button>
            </div>
        </form>
    </div>

    <hr>

    <div>Date: {{  now()->toDateString('Y-m-d') }}</div>
    <div>Quotation ID:{{$generated_id}}</div>
    <div>User ID:{{$selected_customer}}</div>
    <label for="customer_name">Quotation for: {{ $customer_name }}</label>
    <form action="{{route('store.quotations')}}" method="POST">
        @csrf
        <input type="text" hidden name="date" value="{{now()->toDateString('Y-m-d')}}">
        <input type="text" hidden name="quotation_id" value="{{$generated_id}}">
        <input type="text" hidden name="customer_id" value="{{$selected_customer}}">
        
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
                        <td>Sample</td>
                        <td>5</td>
                        <td>100</td>
                        <td>500</td>
                    </tr>
                </tbody>
              </table>
        </div>
        <h3>Grand Total: P500.00</h3>
        <div>
            <button type="submit">Make Quotation</button>
        </div>
    </form>
@endsection