<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .page-break{
            page-break-after: always;
        }
        body{
            font-size: 13px;
            font-family: "Calibri", sans-serif;
        }
         .content_table {   /* TABLE */
            margin: auto;
            border-collapse: collapse;
            border-color: black;
            text-align: center;
            width: 90%;
        }
        .table-title {   /* AUXILIARY EQUIPMENTS */
            background-color: #163f75;
            color: #ffffff;
            padding: auto;
            text-align: left;
            height: 49px;
            border-bottom: 0.9px solid #163f75;
            border-right: 0.9px solid #163f75;
            border-left: 0.9px solid #163f75; 
        }        .tabledetails th{
            height: 49px;
            padding: auto;
            text-align: center;
            border-bottom: 0.9px solid #163f75;
            border-right: 0.9px solid #163f75;
            border-left: 0.9px solid #163f75; 
        }
        .content_table td  {   
            background-color: white;
            padding: 12px 15px;
            border-bottom: 0.9px solid #163f75;
            border-right: 0.9px solid #163f75;
            border-left: 0.9px solid #163f75;    
        }
        .content_table tbody tr {    /* BORDERS */
            border-bottom: 0.9px solid #163f75;
            border-right: 0.9px solid #163f75;
            border-left: 0.9px solid #163f75;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quotation ID: {{$quotation_id}}</title>
</head>
<body>
    <div style="text-align: center; margin-top:50%; margin-bottom:50%; font-size: 30px;">Equipment Quotation</div>
    <footer style="position: absolute; bottom: 10px; width: 100%;">
        <div class="row" style="margin-bottom: 30px;">
            <div style="float: left; margin-left: 20px;">
                <p>
                    Mediaone Software Solutions <br>
                    Cordillera Cor Waling-Waling, NHA Bangkal <br>
                    Davao City, 8000 Davao del Sur <br>
                    www.mediaoneph.com
                </p>
            </div>
            <div style="text-align: center;">
                <img src="{{public_path('images/global_images/media_one_logo_name.jpg')}}" alt="mediaone logo with name">
            </div>
        </div>
    </footer>
    <div class="page-break"></div>
    {{-------------------------------------------2nd Page-----------------------------------------------------------}}
    <div>
        <strong>Quotation ID: {{ $quotation_id }}</strong>
        <p>
            Date: {{ $final_quotation_date }} <br>
            Customer Name: {{ $customer_name }}
        </p>
    </div>
    {{-- <table class="table table-bordered" >
        <thead>
          <tr style="background-color:#10345c; color:white">
            <th scope="col" colspan="5">AUXILIARY EQUIPMENT</th>
          </tr>
          <tr class="table-heading">
            <th scope="col">Option</th>
            <th scope="col">Description</th>
            <th scope="col">Qty</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Sub Total</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($quotations as $quotation)
            <tr class="table-content">
                <td>{{$loop->iteration}}</td>
                <td>{{$quotation->product_name}}</td>
                <td>{{$quotation->quantity}}</td>
                <td>{{$quotation->product_price}}</td>
                <td>{{number_format($quotation->product_price * $quotation->quantity)}}</td>
            </tr>   
        @endforeach
        <tr>
            <td></td>
            <td>***Nothing Follows***</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <th colspan="2" style="text-align: right; background-color:#10345c; color:white">TOTAL</th>
            <td colspan="3" style="text-align: center">PHP {{number_format($grand_total)}}</td>
        </tr>
        </tbody>
    </table> --}}
    <table class="content_table">
        <thead>
           <tr>
                 <th class="table-title" colspan="5"> AUXILIARY EQUIPMENT </th>
           </tr>
           <tr class="tabledetails">
                <th class="option"> Option </th>
                <th class="description"> Description </th>
                <th class="qty"> Qty </th>
                <th class="unitprice"> Unit Price </th>
                <th class="subtotal"> Sub Total </th>     
           </tr>
       </thead>
       <tbody>
            @foreach ($product_quotations as $product_quotation)
                <tr>
                    <td class="option"> {{$loop->iteration}} </td>
                    <td class="description"> {{$product_quotation->product_name}} </td>
                    <td class="qty"> {{$product_quotation->quantity}} </td>
                    <td class="unitprice"> {{$product_quotation->unit_price}} </td>
                    <td class="subtotal">{{number_format($product_quotation->unit_price * $product_quotation->quantity)}} </td>      
                </tr> 
            @endforeach
            <tr>
                <td></td>
                <td style="text-align: left">***Nothing Follows***</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
           </tr>
           <tr>
                 <td style="text-align: right; background-color:#163f75; color:white" colspan="3"> <strong> TOTAL </strong> </td>
                 <td colspan="2">PHP {{number_format($grand_total)}} </td>
           </tr>
        </tbody>
   </table>
    <footer style="position: absolute; bottom: 50%; width: 100%;">
        <div>
            <table style="width: 100%;">
                <tr>
                    <td>
                                Prepared By: <br>
                        <strong> MARK ADRIAN RESTAURO</strong> <br>
                               Marketing Manager
                    </td>
                    <td>        Approved By: <br>
                        <strong>RUINZE A. MALINAO</strong> <br>
                            CEO | Mediaone Software Solutions
                    </td>
                </tr>
            </table>
        </div>
    </footer>
</body>
</html>