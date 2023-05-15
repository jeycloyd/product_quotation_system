@extends('layouts.master')
@section('title', 'Add Customer')
@section('content')
    <!--  FILL UP FORM (Start)-->
    <div class="wrapper2">
            <div>
                <!--  REGISTRATION FORM (Start)-->
                <h1 class="h1_CustomerRegistration"> ADD CUSTOMER </h1>
                <form class="fillupform" action="{{route('store.customers')}}" method="POST">
                    @csrf
                    <div class="inputbox">  
                        <input type="text" required class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" placeholder="Enter customer name...">
                        @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputbox">  
                        <input type="text" required class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter address...">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputbox">
                        <input maxlength="11" type="text" id="input_contact_no" required name="customer_contact_no" placeholder="Enter contact number...">
                    </div>
                    <button type="submit" class="btn-confirm border-0" style="margin-left: 15px" >ADD CUSTOMER</button>
                </form>
        </div>
    </div>
    <!--  FILL UP FORM (End)-->
    <script>
        //only accepts number as format
        $("#input_contact_no").keypress(function (event) {
            var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
            if ((keyCode >= 48 && keyCode <= 57) || (keyCode == 32)) {
                return true;
            } else {
                var specialChars = ",;.'/[]\\`~!@#$%^&*()-_=+{}|:\"<>?";
                if (specialChars.indexOf(String.fromCharCode(keyCode)) != -1) {
                    return false;
                } else {
                    if ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122)) {
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        });
    </script>
@endsection