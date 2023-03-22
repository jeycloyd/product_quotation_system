<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    <h1 style="position:absolute; margin-left: 20%">@yield('header')</h1>
    <div style="position:absolute; top: 30%; left: 45%;">
        <main >
            @yield('content')
        </main>
    </div>  
    <div>
        <body>
            <div class="wrapper">
                <div class="navbar">
                    <div class="inner_navbar">
                    <!--  LOGO AND NAME OF THE WEBSITE (Start)-->
                        <div class="logo">
                            <img class="mediaonelogo" src= "{{asset('../images/global_images/media_one_logo.png')}}" alt="media one logo">    
                            <a href="#">Media<span>One</span></a>
                        </div>
             <div class="menu">
                <ul>
                    <a href="/">Home</a>
                    <a href="/quotations/select-customer">Create Quotation</a>
                    <a href="/quotations/view">View Quotation</a>
                    <a href="/customers/index">View Customers</a>
                    <a href="/products/index">View Products</a>
                    <a href="/customers/create">Add Customer</a>
                    <a href="/products/create">Add Product</a>
                </ul>
            </div>
        </body>
    </div>  
</body>
</html>