@extends('layout/cusmaster')
@section('body')

<?php
	use Illuminate\Support\Facades\DB;
?>

		<div class="container">
			<h1 style="color: #002347; margin-bottom: 0px; text-align: center">My Order</h1>
					<div style="text-align: center">
              			<hr style="border: 2px solid blue; margin-top: 5px; width: 100%">
            		</div>
			@foreach($data as $row)
			<div class=row style="border:1px solid black;border-radius: 10px; margin-top: 30px;margin-bottom: 30px;">
				<div class="col-lg-6">
					<div class="owl-carousel owl-theme s_Product_carousel">
							<div class="single-prd-item" style="margin-top: 10px;margin-bottom: 10px">
								<img class="img-fluid" src="{{ $row->Path }}" alt="" style="height: 300px;">
							</div>
						</div>
				</div>
				<div class="col-lg-6">
					<div style="margin-top: 20px">
						<?php
							$gst= ($row->Price * $row->Quantity - ($row->Discount * $row->Quantity)) * (2.5/100);
							$ttlamt = ($row->Price * $row->Quantity - ($row->Discount * $row->Quantity)) + (2*$gst);
						?>
						<h2>Order Date : {{ date('d/m/Y',strtotime($row->Order_date)) }}</h2>
						<h5>Product Name : {{ $row->Product_name }}</h5>
						<h5>Quantity : {{ $row->Quantity}}</h5>
						<h5>Price : ₹{{$row->Price}}</h5>
						<h5>Discount : ₹{{$row->Discount * $row->Quantity}} </h5>
						<h5>SGST : ₹{{$gst}}</h5>
						<h5>CGST : ₹{{$gst}}</h5>
						<h5>Total Amount : ₹{{$ttlamt}}</h5>
						<h5>Order Status : <b>{{ $row->Order_status}}</b></h5>

					</div>
				</div>
			</div>
			@endforeach
		</div>

@endsection('body')