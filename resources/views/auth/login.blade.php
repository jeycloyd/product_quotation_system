@extends('layouts.app')
@section('title','Login')
@section('content')
<br>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('css/Navbar.css') }}" rel="stylesheet"> --}}

{{-----------------------------------JQuery UI Signature-----------------------------------------------}}
<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 
<link type="text/css" href="{{ asset('css/jquery.signature.css') }}" rel="stylesheet"> 
<script type="text/javascript" src="{{ asset('js/jquery.signature.js') }}"></script>

<!--  LOGIN WALLPAPER (Start)-->

<div class="loginwrapper">
    <div class="fillup_container">
        <div class="loginlogo">
        <img class="login_mediaonelogo" src="{{asset('images/global_images/media_one_logo.png')}}">  
        <img class="login_QuotationFormSystem" src= "{{asset('images/global_images/quotation_form_system.png')}}">  
        </div>  
        <!--  PRODUCT FORM (Start)-->
        <div class="card-body">
            <form class="productform" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="loginbox">  
                    <input type="email" name="email" required class="@error('email') is-invalid @enderror" name="email" placeholder="Enter Email...">
                    @error('email')
                        <span class="invalid-feedback" role="alert" style="color:red; margin-top:-10px">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="loginbox">  
                    <input type="password" required name="password" placeholder="Enter Password...">
                </div>
                <button type="submit" class="btn-login border-0">{{ __('Login') }}</button>
                {{-- <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}
            </form>
        </div>
    </div>
</div>
@endsection
