@extends('layouts.app')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<!--  REGISTER WALLPAPER (Start)-->

    <div class="registerwrapper">
        <div class="fillup_container">
            <div class="registerlogo">
                <img class="register_mediaonelogo" src="{{asset('images/global_images/media_one_logo.png')}}">  
                <img class="register_QuotationFormSystem" src="{{asset('images/global_images/registration_form.png')}}">  
            </div>
            <form class="productform" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="registerbox">  
                    <input type="text" required="required" name="name" placeholder="Enter Name...">
                </div>
                <div class="registerbox">  
                    <input type="email" required="required" name="email" placeholder="Email Address...">
                </div>
                <div class="registerbox">  
                    <input type="password" required="required" name="password" placeholder="Enter password...">
                </div>
                <div class="registerbox">  
                    <input type="password" required="required" name="password_confirmation" placeholder="Confirm password...">
                </div>
                <button href="#" class="btn-register border-0   " type="submit">{{ __('Register') }}    </button>
            </form>
        </div>
    </div>
    <!--  REGISTER WALLPAPER (End)-->
@endsection
