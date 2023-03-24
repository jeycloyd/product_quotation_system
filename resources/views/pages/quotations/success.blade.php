@extends('layouts.master')
@section('title', 'Success')
@section('content')
    <!--  FILL UP FORM (Start)-->
    <div class="wrappersuccess">
        <h1 class="h1_SuccessInformation"> QUOTATION HAS BEEN CREATED SUCCESSFULLY!</h1>
        <a href="/quotations/select-customer" class="btn-makeanewquotation"> MAKE A NEW QUOTATION </a>
        <a href="/quotations/view" class="btn-viewquotation" > VIEW QUOTATION </a>
    </div>	
    <!--  FILL UP FORM (End)-->
@endsection