@extends('layouts.app')
@section('content')

    <div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
        <div class="card border-0 rounded-lg shadow-lg" style="max-width: 600px;">
            <div class="card-body text-center">
                <img src="{{asset('images/global_images/media_one_logo.png')}}" alt="Company Logo" class="mb-3" style="max-width: 50px;">
                <h5 class="card-title" style="font-weight: bold; font-size: 24px; margin-bottom: 20px;">
                    <i class="bi bi-hourglass"></i> Registration is Pending
                </h5>
                <p class="card-text">
                    Your registration is currently being processed. 
                    Please wait patiently while we review your information and complete the registration process. 
                    We appreciate your understanding and thank you for your patience.
                </p>
                <button class="btn btn-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                </button>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
