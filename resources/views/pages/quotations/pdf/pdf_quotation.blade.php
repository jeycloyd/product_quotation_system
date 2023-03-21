<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .page-break{
            page-break-after: always;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quotation ID: {{$quotation_id}}</title>
</head>
<body>
    <h1 style="text-align: center; margin-top:50%; margin-bottom:50%">Equipment Quotation</h1>
    <div class="page-break"></div>
    {{-------------------------------------------2nd Page-----------------------------------------------------------}}
    <img src="{{ public_path('images/global_images/media_one_logo.jpg') }}" style="width: 150px; height: 150px;">
    
    <h3>Quotation ID: {{ $quotation_id }}</h2>
    <h4>Quoted At: {{ $quotation_date }}</h2>
    <h4>Customer Name: {{ $customer_name }}</h2>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Option</th>
            <th scope="col">Description</th>
            <th scope="col">Qty</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Sub Total</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($quotations as $quotation)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$quotation->product_name}}</td>
                <td>{{$quotation->quantity}}</td>
                <td>{{$quotation->product_price}}</td>
                <td>{{$quotation->product_price * $quotation->quantity}}</td>
            </tr>   
        @endforeach
        </tbody>
      </table>
    <h3>Total: PHP {{$grand_total}}</h3>
    <h5>Prepared By: MARK ADRIAN RESTAURO</h5>
    <h5>Approved By: RUINZE A. MALINAO</h5>
</body>
</html>