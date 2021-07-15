@extends('layout/Master')
@section('body')
<?php
	use Illuminate\Support\Facades\DB;
?>
	
	<div class="container-fluid">
		<div class="title-heading" style="text-align: center;">
			Complete Sales Order<hr style="background-color: black">
		</div>

		<div class="row">
			
		</div>
		<table style="width: 100%; border-collapse: collapse;" >
			<tr style="text-align: center;">
				<th>No.</th>
				<th>Customer Name</th>
				<th>Mobile No.</th>
				<th>Items</th>
				<th>Order Date</th>
				<th>Address</th>
				<th style="width: 15%"></th>

			</tr>
			<?php
				$number=1;
			?>
			@if(count($data)>0)
				@foreach($data as $row)
					<tr>
						<td>
							<?php
								echo $number;
								$number = $number +1;
							?>
						</td>
						<td>
							{{ $row->Name }}
						</td>
						<td>
							{{ $row->Contact }}
						</td>
						<td >
							<?php
								$id = $row->Sales_order_id;
								$items = DB::table('sales_order')
											->join('sales_order_details','sales_order.Sales_order_id','=','sales_order_details.Sales_order_id')
											->join('product','sales_order_details.Product_id','=','product.Product_id')
											->where('sales_order.Sales_order_id','=',$id)
											->get();
								foreach($items as $rows)
								{
									echo $rows->Product_name."<br>";
								}
							?>
						</td>
						<td>
							{{ date('d/m/Y',strtotime($row->Order_date))}}
						</td>
						<td>
							<?php
								echo $row->Address.", ".ucwords($row->Area_name).",".ucwords($row->City_name).", ".ucwords($row->State_name) ;
							?>
						</td>
						<td>
							<form action="comporderview" method="post">
								{{csrf_field()}}
								<input type="text" name="id" style="display: none" value="{{ $row->Sales_order_id }}">
								<button class="btn btn-success" style="width: 100%">View</button>
							</form>
						</td>
					</tr>
				@endforeach
			@endif
		</table>
		{!! $data->render() !!}
	</div>

@endsection('body')