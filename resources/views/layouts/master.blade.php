<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="{{asset('images/global_images/media_one_logo.jpg')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Navbar.css') }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">   
    <title>@yield('title')</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-----------------------------------JQuery AJAX-----------------------------------------------}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    {{---------------------------TAKEN FROM APP BLADE-----------------------------------}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>  
<!--------------------------NAVIGATION BARS AND MENU (Start)---------------------------->



  <div class="sidebar close">
    <div class="logo-details">
      <img class="mediaonelogo" src="{{asset('images/global_images/media_one_logo.png')}}"></i>
      <span class="logo_name"> MediaOne</span>
    </div>
    
    <ul class="nav-links">
      <li>
        <a href="/">
          <i class='bx bxs-home' style='color:#ffffff'  ></i>
          <span class="link_name">Home</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Category</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="/customers/index">
            <i class='bx bxs-user'></i>
            <span class="link_name">Customers</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Customer</a></li>
          <li><a href="/customers/create">Add Customer</a></li>
          <li><a href="/customers/index">View Customer</a></li>
        </ul>
      </li>
      @if(auth()->user()->role == 'admin')
        <li>
          <div class="iocn-link">
            <a href="/products/index">
              <i class='bx bx-book-alt' ></i>
              <span class="link_name">Products</span>
            </a>
            <i class='bx bxs-chevron-down arrow' ></i>
          </div>
          <ul class="sub-menu">
            <li><a class="link_name" href="#">Products</a></li>
            <li><a href="/products/create">Add Product</a></li>
            <li><a href="/products/index">View Product</a></li>
          </ul>
        </li>
      @endif

      <li>
        <div class="iocn-link">
          <a href="/quotations/view">
            <i class='bx bxs-file'></i>
            <span class="link_name">Quotations</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Quotations</a></li>
          <li><a href="/customers/index">Create Quotation</a></li>
          <li><a href="/quotations/view">View Quotation</a></li>
        </ul>
      </li>
      
      {{-- <li>
        <div class="iocn-link">
          <a href="/billings">
            <i class='bx bxs-file'></i>
            <span class="link_name">Billing</span>
          </a>
        </div>
      </li> --}}

      @if(auth()->user()->role == 'admin')
        <li>
          <a href="/users/index">
            <i class='bx bxs-user-account' style='color:#ffffff'  ></i>
            <span class="link_name">Users</span>
          </a>
        </li>
      @endif
      <br>
      <li>
          <form action="{{route('logout')}}" id="logout-form" style='color:#ffffff' method="POST">
            @csrf
            <a id="logout-btn">
              <i class='bx bx-log-out' ></i>
              <span class="link_name" style="cursor: pointer" >Logout</span>
            </a>
          </form>
      </li>
    </ul>
  </div>

    <section class="home-section">
        <div class="home-content">
            {{-- <i class='bx bx-menu' ></i> --}}
            <span class="text"></span>
            <h1 class="h1_header">
              @yield('header')</h1>
                <div>
                    <main >
                        @yield('content')
                    </main>
                </div>
        </div>
    </section>
    {{-- Vanilla JS --}}
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e)=> {
              let arrowParent = e.target.parentElement.parentElement; //select  main parent of arrow
              arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebar.addEventListener("mouseenter", ()=>{
            sidebar.classList.toggle("close");
        });
        sidebar.addEventListener("mouseleave", ()=>{
            sidebar.classList.toggle("close");
        });
    </script>
    {{-- jquery --}}
    <script>
      $(document).ready(function () {
        $('#logout-btn').click(function (e) { 
          e.preventDefault();
          $('#logout-form').submit();
        }); 
      });
    </script>
</body>
</html>