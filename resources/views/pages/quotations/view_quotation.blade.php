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
                    @foreach ($quotations as $quotation)
                        <tr>
                            {{-- <td>{{$quotation->id}}</td> --}}
                            <td>{{$quotation->product_name}}</td>
                            <td>{{$quotation->quantity}}</td>
                            <td>{{$quotation->product_price}}</td>
                            <td>{{$quotation->product_price * $quotation->quantity}}</td> 
                        </tr>
                    @endforeach
                </tr> 
            </tr>
        </tbody>
      </table>
      <h1>Grand Total: {{$grand_total}}</h1>
      <a href="{{ route('export.quotations', $quotation_id) }}" class="btn btn-primary">Download as PDF</a>
@endsection