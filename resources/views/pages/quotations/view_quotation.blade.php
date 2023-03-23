@extends('layouts.master')
@section('title', 'View Quotations')
@section('header', 'View Quotations')
@section('content')
    <h2>Quotation ID: {{ $quotation_id }}</h2>
    <h2>Quoted At: {{ $quotation_date }}</h2>
    <h2>Customer Name: {{ $customer_name }}</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <tr>
                    @foreach ($product_quotations as $product_quotation)
                        <tr>
                            {{-- <td>{{$quotation->id}}</td> --}}
                            <td>{{$product_quotation->product_name}}</td>
                            <td>{{$product_quotation->quantity}}</td>
                            <td>{{$product_quotation->unit_price}}</td>
                            <td>{{$product_quotation->unit_price * $product_quotation->quantity}}</td> 
                        </tr>
                    @endforeach
                </tr> 
            </tr>
        </tbody>
      </table>
      <h1>Grand Total: {{$grand_total}}</h1>
      <a href="{{ route('export.quotations', $quotation_id) }}" class="btn btn-primary">Download as PDF</a>
@endsection