<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
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
                    <a href="/customers/create">Add Customer</a>
                    <a href="/products/create">Add Product</a>
                </ul>
            </div>
        </body>
    </div>  
</body>
</html>