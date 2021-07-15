@extends('layout/Master')
@section('body')
<?php 
	use Illuminate\Support\Facades\DB;
?>
<div class="container-fluid">
	@foreach($data as $row)
	<div class="title-heading">
		Processing Sales Order Details Of <span style="color: gray;">{{ $row->Name }}<hr style="background-color:  black;"></span>
	</div>
			<div class="row pt-2">
				<div class="col-lg-3" style="text-align: right;">
				</div>
				<div class="col-lg-6">
					<table style="width: 100%; border-collapse: collapse;">
						<tr style="border:none">
							<th style="border:none">Name:</th>
							<td>{{ $row->Name }}</td>
						</tr>
						<tr>
							<th style="border:none">Order Date:</th>
							<td>
								{{ date('d/m/Y',strtotime($row->Order_date)) }}
							</td>
						</tr>
						<tr>
							<th style="border:none">Discount</th>
							<td>Rs.{{ $row->Dis }}</td>
						</tr>
						<tr>
							<th style="border:none">Total Amount</th>
							<td>Rs.{{ $row->Total_amount }}</td>
						</tr>
						<tr>
							<th style="border:none">Email:</th>
							<td>{{$row->Email}}</td>
						</tr>
						<tr>
							<th style="border:none">Contact No.:</th>
							<td>{{$row->Contact}}</td>
						</tr>
						<tr>
							<th style="border:none">Address:</th>
							<td>{{$row->Address}}</td>
						</tr>
						<tr>
							<th style="border:none">Area:</th>
							<td>{{$row->Area_name}}</td>
						</tr>
						<tr>
							<th style="border:none">State:</th>
							<td>{{$row->State_name}}</td>
						</tr>
						<tr>
							<th style="border:none">City:</th>
							<td>{{$row->City_name}}</td>
						</tr>
					</table>
					<table style="width: 100%; margin-top: 10px;">
						<?php
							$id = $row->Sales_order_id;
							$amount = 0;
							$items = DB::table('sales_order')
										->join('sales_order_details','sales_order.Sales_order_id','=','sales_order_details.Sales_order_id')
										->join('product','sales_order_details.Product_id','=','product.Product_id')
										->where('sales_order.sales_order_id','=',$id)
										->get();
						?>
						<tr>
							<th>Product Name</th>
							<th>Quantity</th>
						</tr>
						@foreach($items as $row)
							<tr>
								<td>{{ $row->Product_name }}</td>
								<td>{{ $row->Quantity }}</td>
							</tr>
						@endforeach
					</table>
					<a href="{{ URL::previous() }}" class="btn btn-primary" style="margin-top: 10px;"><i class="fa fa-arrow-left"></i> Back</a>	
				</div>
				<div class="col-lg-3">
				</div>
			</div>
		@endforeach
</div>

@endsection('body')