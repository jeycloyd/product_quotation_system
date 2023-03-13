@extends('layouts.master')
@section('title', 'View Quotations')
@section('content')
    <h1>View Quotations</h1>
    <table>
        <thead>
            <tr>
                <th>Quotation ID</th>
                <th>Quoted For</th>
                <th>Quoted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                    <tr>
                        {{-- @foreach ($quotations as $quotation)
                            <tr>
                                <td>{{$quotation->id}}</td>
                                <td>{{$quotation->customer_id}}</td>
                                <td>{{$quotation->created_at}}</td>
                                <td>
                                    <a href="">View</a>
                                    <a href="">Delete</a>
                                </td>
                            </tr>  
                        @endforeach     --}}
                        @foreach ($quotations as $quotation)
                            <tr>
                                <td>{{$quotation->id}}</td>
                                <td>{{$quotation->customer_name}}</td>
                                <td>{{$quotation->created_at}}</td>
                                <td>
                                    <a href="{{route('show.quotations', $quotation->id)}}">View</a>
                                    <a href="{{route('destroy.quotations', $quotation->id)}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tr> 
            </tr>
        </tbody>
      </table>
@endsection