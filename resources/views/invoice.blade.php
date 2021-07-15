<?php 
	use App\Users;
    use Illuminate\Support\Facades\DB;
 ?>

@extends('layout/cusmaster')
@section('body')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dipti Handicraft</title>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="script.js"></script>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #002347;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
            text-align : center;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container" >
    @foreach($data as $row)
    <div class="col-lg-12" style="text-align: right ;margin-top:20px;margin-bottom:20px;">
                        <button class="button primary-btn"  onclick="generatePDF()">Download Invoice</button>
    </div>

    <div id="invoice">
        <div class="brand-section">
        
            <div class="row">
                <div class="col-4">
                    <h2 class="text-white">Dipti Handicraft</h2>
                </div>
                <div class="col-8">
                    <div class="company-details">
                        <p class="text-white">45,Anjana Park Society,Hirawadi,Ahmedabad-382345</p>
                        <p class="text-white">Mobile: +91 9714796281</p>
                        <p class="text-white">info@diptihandicraft.com</p>
                    </div>
                </div>
            </div>
        </div>
        
       
        <div class="body-section">
            <div class="row">
            
                <div class="col-6">

                    <h2 class="heading">Invoice No.: {{ $row->Sales_order_id }}</h2>
                    <p class="sub-heading">Order Date: {{ date('d/m/Y',strtotime($row->Order_date)) }} </p>
                    
                    
                </div>
                
                <?php
                    $activeuser = session()->get('activeuser');
                    $userdetail = DB::table('user')
                        ->join('area','user.Area_id','=','area.Area_id')
                        ->join('city','area.City_City_id','=','city.City_id')
                        ->join('state','city.State_State_id','=','state.State_id')
                        ->where('user.User_id','=',$activeuser)
                        ->get();
                ?>
                @foreach($userdetail as $user)
                <div class="col-6">
                    <p class="sub-heading">Email: {{ $user->Email }}</p>
                    <p class="sub-heading">Name:  {{ ucfirst(trans($user->Name)) }}</p>
                    <p class="sub-heading">Address:  {{ $user->Address }} </p>
                    <p class="sub-heading">Area,City,State : {{ $user->Area_name  }}, {{ $user->City_name  }} , {{ $user->State_name  }}</p>
                    <p class="sub-heading">Phone Number:  {{ $user->Contact  }}</p>
                </div>
                @endforeach
            </div>
        </div>
        

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th class="w-20">Product</th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Discount</th>
                        <th class="w-20">Grandtotal</th>
                    </tr>
                </thead>


                <?php $tot=0;?>
                <tbody>
                @foreach($product as $row)
                    <tr>
                        <td>{{ $row->Product_name }}</td>
                        <td>₹ {{ $row->Price }}.00</td>
                        <td>{{ $row->Quantity }}</td>
                        <td>₹ {{ $row->Discount * $row->Quantity}}</td>
                        <td>₹ {{ $row->Qty_price }}</td>

                        <?php $tot= $tot + $row->Qty_price; ?>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><b>Sub Total</td>
                        <td><b>₹ {{ $tot }} </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right"><b>CGST(2.5%)</td>
                        <td> <b>₹ {{ $data[0]->CGST }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right"><b>SGST(2.5%)</td>
                        <td> <b>₹ {{ $data[0]->SGST }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right"><b>Grand Total</td>
                        <td><b>₹ {{$data[0]->Total_amount}}</td>
                    </tr>
                    
                </tbody>
            </table>
            
            
            <br>
            <h3 class="heading">Payment Mode: Cash on Delivery</h3>
        </div>

        <div class="col-lg-12 footer-text text-center">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Dipti Handicraft Co.Pvt.Ltd.All Rights Reserved.
            </p>
        </div> 
        <div><h4>Thank you for your bussiness.</h4></div>
        @endforeach     
    </div>  
</div>    
    
</body>
</html>




@endsection('body')