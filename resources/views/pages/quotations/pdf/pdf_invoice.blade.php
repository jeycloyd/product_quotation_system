<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

        @font-face {
          font-family: 'Calibri';
          src: url('path/to/calibri.ttf');
        }
        
        body {
          font-family: 'Calibri', sans-serif;
        }
        
        
        
        
        /*  PDF FORMAT (Start)  */
        
        
        .PDFWrapper {
        padding:  0%;
        }
        
        .PDFContainer {
          padding: 0.5%;
        }
        
        .table_labels {
          width: 105%;
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
        font-size: 24px;
        }
        
        .invoice {
        font-size: 35px;
        color: #a3a3a3;
        margin: 4;
        }
        
        
        
        .invoice_labels {
          font-size: 13px;
          font-weight: bold;
          margin: 2;
        }
        
        .invoice .labels2 {
          text-align: right;
        }
        
        
        .VAT_TIN {
        
        }
        
        .Date {
        
        }

        .table_details {
         margin: 0;

        }
        
        .Billto {
            margin: 0;
        }
        
        .CompanyName {
         margin: 0;
         padding: 0;
        } 
        
        .Attention {
        
        }
        
        
        
        .PDF_table {
            border-collapse: collapse;
        
          border color: black;
          justify-content: center;
          text-align: center;
          margin: center;
          width: 99%;
          padding: 1%;
        
        }
        
        
        .PDF_table thead th {
        background-color: #909090; 
        text-align: center;
        font-size: 10;
        font-family: 'Ubuntu', sans-serif;
        height: 25px;
        color: #fff;
        
           border-top: 2px solid #000000;
           border-bottom: 2px solid #000000;
           border-right: 2px solid #000000;
           border-left: 2px solid #000000;
          
        }
        
        .PDF_table td  {   
          font-size: 13;
        
          }
        
        .PDF_table tbody tr {    /* BORDERS */
          
          border-top: 2px solid #000000;
           border-bottom: 2px solid #000000;
           border-right: 2px solid #000000;
           border-left: 2px solid #000000;
        
          width: 10%;
        }
        
        .PDF_table td {
          border-right: 2px solid #000000;
           border-left: 2px solid #000000;
        }
        
        
        .table-item {
        width: 50%;
        }
        .table-qty {
        width: 5.5%;
        }
        
        .table-amount {
        width: 20%;
        }
        
        
        .PDF_table tbody tr: nth-of-type (even) {
          background-color: #f3f3f3;
        }
        
        .PDF_table tbody tr: last-of-type {
        border-bottom: 2px solid #009879;
        
        }
        
        /* ----- TOTAL TABLE ----- */
        .table_total {
            border-collapse: collapse;
        
          border color: black;
          margin: 0% 0% 0% 52%;
          padding: 4%;
          width: 50%;
        
        
        }
        .table_total  th {
        text-align: center;
        font-size: 13;
        font-family: 'Ubuntu', sans-serif;
        height: 35px;
        color: #000;  
        }
        .table_total th {    /* BORDERS */
          
          border-top: 2px solid #000000;
           border-bottom: 2px solid #000000;
           border-right: 2px solid #000000;
           border-left: 2px solid #000000;
        
        }
        .Total_Label {
         Text-align: center;
         background-color: #909090;
         color: #fff;
         width: 3%;
        }
        .Total_Label th {
        }
        .Total  {
        width: 55%;
        }

    /* BOTTOM LABELS */
       .bankdetails {
        font-weight: bold;
        font-size: 13px;
       }

       .details {
        font-size: 10px;
        margin: 2px;
        font-weight: 90; 
       }

       .thankyouforyourbusiness {
        margin: 15% auto;
        justify-content: center;

       }

        /*  pdf FORMAT (End)  */
    </style>
</head>
<body>
    <div class="PDFWrapper">
        <div class="PDFContainer">
           <table class="table_labels">
            <tr>
                <td>
                    <div class="PDFlogo">
                      <img class="logo" alt="media one logo" style="width:150%; height:5.5%;" 
                      src="{{public_path('images/global_images/media_one_logo_name.jpg')}}">
                    </div>
                </td>
                <td>
                   <div class="labels2">
                      <h1 class="invoice"> INVOICE </h1>
                      <p class="invoice_labels">DATE: {{Carbon\Carbon::now()->format('m.d.Y');}} </p>
                   </div>
                      <p class="invoice_labels">INVOICE #: i{{$quotation_id}} </p>
                      <p class="invoice_labels">PO #:  </p>
                     <p class="invoice_labels">PO DATE: {{Carbon\Carbon::now()->format('M d, Y');}} </p>
                   </div>
                </td>
             </tr>
 <table class="table_details">
             <tr>
                <td>

                  <br>
                  <br> <!-- SPACING -->
                  <br>
                    <div class="Billto">
                       Bill To: 
                       <h5>{{$customer_name}}</h5>
                    </div>

                </td> 
             </tr>
 </table>  
 
 <table> 
              <tr>
                 <td>
                   <div class="attention">
                    <h5> Attention: </h5>
              <br>
              <br><!-- SPACING -->
        </td>
    </tr>


 </div> <!--PDF CONTAINER(End -->
  

 <table class="PDF_table">

    <thead>
        <tr class="tabledetails">
           <th class="table-headeritem"> Item </th>
           <th class="table-headerqty"> Qty </th>
           <th class="table-headeramount"> Amount </th>   
        </tr>

    </thead>

    <tbody>

        {{-- <tr >
           <td class="table-item"> sample </td>
           <td class="table-qty"> 1 </td>
           <td class="table-amount"> sample </td>

        </tr> --}}
        @foreach ($product_quotations as $product_quotation)
            <tr>
              <td class="table-item"> {{$product_quotation->product_name}} </td>
              <td class="table-qty"> {{$product_quotation->quantity}} </td>
              <td class="table-amount"> {{number_format($product_quotation->unit_price,2)}} </td>
            </tr>
        @endforeach


    </tbody>    
</table>

     <!----- TOTAL  -----> 

<table class="table_total">

        <tr>

        <br>

          <th class="Total_Label" colspan="3">Total</th>
          <th class="Total" colspan="1" > P {{$grand_total}} </th>
          

        </tr>
      
</table>


<table>

    <tr>
        <td class="bankdetails">Bank Details:</td>
    </tr>
    <tr>
        <td>
            <p class="details">Bank Name: CHINA BANKING CORPORATION</p>
            <p class="details">Account Name: Mediaone Software Solutions</p>
            <p class="details">Account Number: 11782021318</p>
            <p class="details">Swift Code: CHBKPHMM</p>
            <p class="details">Bank Main Branch: CHINA BANKING CORPORATION BLDG., 8745 PASEO DE ROXAS CORNER VILLAR, STREET MAKATI, METRO MANILA</p>
        </td>
    </tr>
</table>

             <!-- "THANK YOU FOR YOUR BUSINESS!" FEEDBACK -->
                  <h6 class="thankyouforyourbusiness"> Thank you for your business! </h6>

</div> <!-- PDFWrapper End -->



 </table>

           </table>

           
    </div>
</body>
</html> 