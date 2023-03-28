<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
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
                            <a href="/" style="text-decoration: none;" >Media<span>One</span></a>
                        </div>
             <div class="menu">
                <ul>
                    <a href="/quotations/select-customer">Create Quotation</a>
                    <a href="/quotations/view">View Quotation</a>
                    <a href="/customers/create">Add Customers</a>
                    <a href="/products/create">Add Products</a>
                    <a href="/customers/index">View Customers</a>
                    <a href="/products/index">View Products</a>
                </ul>
            </div>
        </body>
    </div>  
</body>
</html>