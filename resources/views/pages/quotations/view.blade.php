@extends('layouts.master')
@section('title', 'View Quotations')
@section('content')
@section('header','View Quotations')
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Quotation ID</th>
            <th scope="col">Quoted For</th>
            <th scope="col">Quoted At</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($quotations as $quotation)
                    <tr>
                        <td>{{$quotation->id}}</td>
                        <td>{{$quotation->customer_name}}</td>
                        <td>{{$quotation->created_at}}</td>
                        <td>
                            <a href="{{route('show.quotations', $quotation->id)}}" class="btn btn-success">View</a>
                            <a href="{{route('destroy.quotations', $quotation->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tr> 
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {{ $quotations->links() }}
    </div>
@endsection