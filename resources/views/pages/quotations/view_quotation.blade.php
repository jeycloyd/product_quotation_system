@extends('layouts.master')
@section('title', 'View Quotations')
@section('content')
    <h1>View Quotations</h1>
    <h1>Quotation ID:{{$quotation_id}}</h1>
    <table>
        <thead>
            <tr>
                <th>Quotation List</th>
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
                            <td>{{$quotation->id}}</td>
                            <td>{{$quotation->product_name}}</td>
                            <td>{{$quotation->quantity}}</td>
                            {{-- <td>{{$quotation->unit_price}}</td> --}}
                            {{-- <td>{{$quotation->total_price}}</td> --}}
                        </tr>
                    @endforeach
                </tr> 
            </tr>
        </tbody>
      </table>
@endsection