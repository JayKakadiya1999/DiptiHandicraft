@extends('layout/cusmaster')
@section('body')

<?php
	use Illuminate\Support\Facades\DB;
?>

	@if($data != null)
		<div class="container">
			<div class="row">
				<?php
					$number=1;
					$numbers=1;
				?>
				<div class="col-lg-12 mt-4">
					<h1 style="color: #002347; margin-bottom: 0px; text-align: center">My Purchase Order</h1>
					<div style="text-align: center">
              			<hr style="border: 2px solid blue; margin-top: 5px; width: 100%">
              		</div>
				</div>
				
				<div class="container-fluid" >

					@foreach($data as $row)
					<div style="border: 2px solid black; border-radius: 25px; padding: 10px;margin-bottom:20px">
						<form action="{{  route('invoice') }}" method="post" style="margin: 0; padding: 0; text-align: right;">
							{{ csrf_field() }}
							<input type="text" name="id" value="{{ $row->Sales_order_id }}" style="display: none;">
							<button class="btn btn-success" style="width: 150px">Generate Invoice</button>
						</form>
						<h2>Order Date : {{ date('d/m/Y',strtotime($row->Order_date)) }}<br>
							SGST : ₹ {{ $row->SGST }}<br>
							CGST : ₹ {{ $row->CGST }}<br>
							Total Amount : ₹ {{ $row->Total_amount  }}<br>
						
						</h2>
						<form action="{{ route('orderview') }}" method="post" style="margin: 0; padding: 0; text-align: right;">
							{{ csrf_field() }}
							<input type="text" name="id" style="display: none;" value="{{ $row->Sales_order_id }}" >
							<button class="btn btn-primary" style="width: 150px;margin-bottom:2px">View</button>
						</form>
						<form action="{{  route('cancelorder') }}" method="post" style="margin: 0; padding: 0; text-align: right;">
							{{ csrf_field() }}
							<input type="text" name="id" value="{{ $row->Sales_order_id }}" style="display: none;">
							<button class="btn btn-danger" style="width: 150px;margin-bottom:2px">Cancel Order</button>
						</form>
						
						
						<?php
							$id = $row->Sales_order_id;
							$products = DB::table('sales_order')
											->join('sales_order_details','sales_order.Sales_order_id','=','sales_order_details.Sales_order_id')
											->join('product','sales_order_details.Product_id','=','product.Product_id')
											->where('sales_order.Sales_order_id','=',$id)
											->get();
						?>
						<div class="row" style="border: 1px solid black; border-radius: 25px; padding: 10px; margin-bottom: 100px;margin-left:3px;margin-right:3px">
							<table style="width: 100%;">
								<tr>
									<th><b>Product Name</b></th>
									<th><b>Price</b></th>
									<th><b>Quantity</b></th>
									<th><b>Discount</b></th>
									<th><b>Order Status</b></th>
								</tr>
								@foreach($products as $pro)
									<tr>
										
										<td>{{ $pro->Product_name }}</td>
										<td>₹ {{ $pro->Price }}.00</td>
										<td>{{ $pro->Quantity }}</td>
										<td>{{ $pro->Discount * $pro->Quantity}}</td>
										<td>{{ $pro->Order_status }}</td>
									</tr>
								@endforeach
							</table>
						</div>
						</div>
					@endforeach
				</div>

			</div>
		</div>
	@endif

	@if($data == null)
  	<br><br>
  	<h1 style="color: red;text-align: center">You have no Order!!!</h1>
  	<br><br>
  	@endif

	@if($complateorder != null)
		<div class="container">
			<div class="row">
				<?php 
					$number = 1;
					$numbers = 1;
				?>
				<div class="col-lg-12 mt-4">
					<h1 style="color: #002347; margin-bottom: 0px; margin-top: 50px; text-align: center">History</h1>
					<div style="text-align: center">
              			<hr style="border: 2px solid blue; margin-top: 5px; width: 100%;">
              		</div>
				</div>
			</div>
			<div class="col-lg-12">
				<table style="width: 100%; font-size: 25px;" class="mb-3">
					<tr style="border-bottom: 1px solid black;">
						<th style="border: none;">No.</th>
						<th style="border: none;">Items</th>
						<th style="border: none;">Order Date</th>
						<th style="border: none;">Total Amount</th>
						<th style="border: none;">Status</th>
						<th style="border: none;"></th>
					</tr>
					@foreach($complateorder as $row)
					<tr style="border-bottom: 1px solid black;">
						<td><?php
							echo $numbers;
							$numbers ++;
						?></td>
						<td>
							<?php
								$id = $row->Sales_order_id;
								$amount = 0;
								$items = DB::table('sales_order')
											->join('sales_order_details','sales_order.Sales_order_id','=','sales_order_details.Sales_order_id')
											->join('product','sales_order_details.product_id','=','product.Product_id')
											->where('sales_order.Sales_order_id','=',$id)
											->get();
								foreach ($items as $rows)
								{
									echo $rows->Product_name."<br>";
								}
							?>
						</td>
						<td>
							{{ date('d/m/Y',strtotime($row->Order_date)) }}
						</td>
						<td>
							 ₹ {{ $row->Total_amount  }}
						</td>
						<td>
							@if($row->Order_status == "Complete")
								Delivered
							@endif
							@if($row->Order_status == "Cancelled")
								Cancelled
							@endif
						</td>
						<td>
							@if($row->Order_status == "Complete")
								<form action="{{ route('complateorderview') }}" method="post">
									{{ csrf_field() }}
									<input type="number" name="id" style="display: none;" value="{{ $row->Sales_order_id }}">
									<button class="btn btn-primary" style="margin-bottom: 2px;width: 100%	">View</button>
								</form>
							@endif
						</td>
					</tr>
					@endforeach
				</table>
				</div>
			</div>
		</div>
	</div>
	@endif

@endsection('body')