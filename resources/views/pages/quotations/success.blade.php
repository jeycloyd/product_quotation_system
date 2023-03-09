@extends('layouts.master')
@section('title', 'Success')
@section('content')
    <H1>Quotation has been succesfully created</H1>
    <ul>
        <li>
            <a href="/quotations/select-customer">Make a new Quotation</a>
        </li>
        <li>
            <a href="/quotations/view">View Quotations</a>
        </li>
    </ul>
@endsection