@extends('layouts.master')
@section('title', 'Edit Customer')
@section('content')
@section('header','Edit Customer Info')
    <form action="{{route('update.customers',$customer_id)}}" method="POST">
        @csrf
        <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" class="form-control" value="{{$customer_name}}" name="customer_name">
        </div>
        <div class="form-group">
        <label for="">Contact No.</label>
        <input type="text" class="form-control" value="{{$customer_contact_no}}" name="customer_contact_no">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection