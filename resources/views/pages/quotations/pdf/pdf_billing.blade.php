<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Billing</title>
    <style>     

        body{
            font-size: 15px;
            font-family: "Calibri", sans-serif;
        }
        
        .PDFWrapper {
            padding: 5%;
            padding-top: 10%;
        }

        .PDFContainer {
            padding: 0;
        }

        .table_labels {
            width: 110%;
        }

        .PDFlogo {
            justify-content:;
            left: 0;
            max-width: 30%;
            height: 15.5vh;
            margin: left;
            padding: 1px;
        }

        .PDFlogo  {
        }


        .labels .labels2 {
            font-size: 12px;
            display: flex;
            vertical-align: top;
        }

        .logoname {
            font-size: 20px;
        }

        .invoice {
            font-size: 20px;
        }


        .VAT_TIN {

        }

        .Date {

        }

        .Billto {
            font-weight: bold;
        }

        .CompanyName {

        } 


        .PDF_table {
            border-collapse: collapse;
            border color: black;
            justify-content: center;
            text-align: center;
            margin: center;
            width: 100%;
            padding: 0;
        }


        .PDF_table thead th {
            background-color: #0f355a; 
            color: #fff;
            text-align: center;
            font-size: 15px;
            font-family: 'Ubuntu', sans-serif;
            height: 32px;

            border-top: 0.9px solid black;
            border-bottom: 0.9px solid black;
            border-right: 0.9px solid black;
            border-left: 0.9px solid  black;
        }

        .PDF_table tbody td  {   
            background-color: white;
            font-size: 13px;
            height: 30px;
            border-bottom: 0.9px solid black;
            border-right: 0.9px solid black;
            border-left: 0.9px solid  black;
        }   

        .PDF_table tbody tr {
            width: 10%;
        }


        .table-item {
            width: 50%;
        }
        .table-qty {
            width: 5.5%;
        }
        .table-rate {
            width: 20%;
        }
        .table-amount {
            width: 17%;
        }


        .PDF_table tbody tr: nth-of-type (even) {
            background-color: #f3f3f3;
        }

        .PDF_table tbody tr: last-of-type {
            border-bottom: 2px solid;
        }

        .Total {
            text-align: right;
        }
    </style>
</head>
<body>
    {{-- <h1>MEDIA ONE IMAGE PLACEHOLDER</h1>
    <strong>INVOICE #</strong><br>
    <p>VAT Reg</p>
    <p>TIN:</p>
    <p>Date:</p>
    <strong>Mediaone Software Solutions</strong><br>
    <strong>Bill To:</strong><br>
    <strong>COMPANY NAME:</strong><br>

    @foreach ($product_quotations as $product_quotation)
        <p>{{$product_quotation->product_name}}</p>
        <p>{{$product_quotation->unit_price}}</p>
        <p>{{$product_quotation->quantity}}</p>
        <p>{{$product_quotation->total_price}}</p>
    @endforeach
    
    <strong>Total: {{number_format($grand_total,2)}}</strong> --}}

    <div class="PDFWrapper">
        <div class="PDFContainer">
   
        <div class="PDFlogo">
            <img class="logo" src="{{public_path('images/global_images/media_one_logo_name.jpg')}}">
        </div>
   
        <table class="table_labels">
           <tr>
               <td>
                    <div class="labels">
                        <h3 class="logoname">Mediaone Software Solutions</h3>
                        VAT Reg<br>
                        TIN: 414-408-984-000
                    </div>
                </td>
                <td>
                    <div class="labels2" >
                        <h1 class="invoice">  INVOICE  i{{$billing}}</h1>
                        {{-- (invoice number MM-YY-PO num)<br>
                        Example: 04-23-001 --}}
                    </div>
                </td>
            </tr>
        </table>
   
        <div class="VAT_TIN">
            <!-- <p>(invoice number MM-YY-PO num)</p>
            <p>Example: 04-23-001</p> -->
        </div>
    
        <div class="Date">
            <p>Date:</p>
        </div>
        <div class="Billto">
           <p>Bill To:</p>
        </div>
        <div class="CompanyName">
            <h3>{{$customer_name}}</h3>
        </div>    
        <p>{{$customer_address}}</p>
    </div> <!--PDF CONTAINER(End -->
    
    <table class="PDF_table" style="margin-top: 60px">
        <thead>
            <tr class="tabledetails">
                <th class="table-headeritem"> Item </th>
                <th class="table-headerqty"> Qty </th>
                <th class="table-headerrate"> Rate </th>
                <th class="table-headeramount"> Amount </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product_quotations as $product_quotation)
                <tr>
                    <td>{{$product_quotation->product_name}}</td>   
                    <td>{{$product_quotation->quantity}}</td>
                    <td>{{$product_quotation->unit_price}}</td>
                    <td>{{$product_quotation->total_price}}</td>
                </tr>
            @endforeach
        </tbody>    
    </table>
   <br>
   <br>
    <div class="Total">
        <h2>Total: PHP {{number_format($grand_total,2)}}</h2>
    </div>
</body>
</html>