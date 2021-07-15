@extends('layout/Master')
@section('body')
<?php 
	use Illuminate\Support\Facades\DB;
?>
<div class="container-fluid">
	@foreach($data as $row)
	<div class="title-heading" style="text-align: center">
		Return Sales Order Details Of <span style="color: gray;">{{ $row->Name }}<hr style="background-color:  black;"></span>
	</div>
			<div class="row pt-2">
				<div class="col-lg-3" style="text-align: right;">
				</div>
				<div class="col-lg-6 mb-5">
					<table style="width: 100%; border-collapse: collapse;">
						<tr style="border:none">
							<th style="border:none">User Name:</th>
							<td>{{ $row->Name }}</td>
						</tr>
						<tr>
							<th style="border:none">Order Date:</th>
							<td>
								{{ date('d/m/Y',strtotime($row->Order_date)) }}
							</td>
						</tr>
						<tr>
							<th style="border:none">Return Date:</th>
							<td>
								{{ date('d/m/Y',strtotime($row->Return_date)) }}
							</td>
						</tr>
						<tr>
							<th style="border:none">Total Amount:</th>
							<td>Rs.{{ $row->Amt }}</td>
						</tr>
						<tr>
							<th style="border:none">User Email:</th>
							<td>{{$row->Email}}</td>
						</tr>
						<tr>
							<th style="border:none">User Contact No. :</th>
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
							$id = $row->Sales_return_id;
							$amount = 0;
							$items = DB::table('sales_return')
										->join('sales_return_details','sales_return.Sales_return_id','=','sales_return_details.Sales_return_id')
										->join('product','sales_return_details.Product_id','=','product.Product_id')
										->where('sales_return.sales_return_id','=',$id)
										->get();
						?>
						<tr>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						@foreach($items as $row)
							<tr>
								<td>{{ $row->Product_name }}</td>
								<td>{{ $row->Qty_return }}</td>
								<td><?php
									$price = $row->Qty_return * $row->Price;
									echo $price; ?></td>
							</tr>
						@endforeach
					</table>
					<a href="{{ URL::previous() }}" class="btn btn-warning" style="margin-top: 10px;"><i class="fa fa-arrow-left"></i>Go Back</a>	
				</div>
				<div class="col-lg-3">
				</div>
			</div>
		@endforeach
</div>

@endsection('body')