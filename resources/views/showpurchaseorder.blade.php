@extends('layout/Master')
@section('body')
<?php 
	use Illuminate\Support\Facades\DB;
?>
<div class="container-fluid">
	@foreach($data as $row)
	<div class="title-heading" style="text-align: center">
		Purchase Order Details Of <span style="color: gray;">{{ $row->Name }}<hr style="background-color:  black;"></span>
	</div>
			<div class="row pt-2">
				<div class="col-lg-3" style="text-align: right;">
				</div>
				<div class="col-lg-6 mb-5">
					<div class="row">
						<div class="col-lg-9">	
						</div>
						<div class="col-lg-3 mb-2">
							<?php
								$valid = DB::table('Purchase_return')
										->where('Purchase_order_id','=',$row->Purchase_order_id)
										->get();
							?>
							@if($valid == null)
								<form action="{{route('returnpurchase')}}" method="post">
									{{csrf_field()}}
									<input type="text" name="id" style="display: none;"
									value="{{$row->Purchase_order_id}}">
									<button class="btn btn-primary">Return Purchase</button>
								</form>
							@endif
						</div>	
					</div>
					<table style="width: 100%; border-collapse: collapse;">
						<tr style="border:none">
							<th style="border:none">Supplier Name:</th>
							<td>{{ $row->Name }}</td>
						</tr>
						<tr>
							<th style="border:none">Order Date:</th>
							<td>
								{{ date('d/m/Y',strtotime($row->Order_date)) }}
							</td>
						</tr>
						<tr>
							<th style="border:none">Total Amount:</th>
							<td>Rs.{{ $row->Total_amt }}</td>
						</tr>
						<tr>
							<th style="border:none">Supplier Email:</th>
							<td>{{$row->Email}}</td>
						</tr>
						<tr>
							<th style="border:none">Supplier Contact No. :</th>
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
							$id = $row->Purchase_order_id;
							$amount = 0;
							$items = DB::table('purchase_order')
										->join('purchase_order_details','purchase_order.Purchase_order_id','=','purchase_order_details.Purchase_order_id')
										->join('raw_material','purchase_order_details.Raw_material_id','=','raw_material.Raw_material_id')
										->where('purchase_order.Purchase_order_id','=',$id)
										->get();
						?>
						<tr>
							<th>Raw Material Name</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						@foreach($items as $row)
							<tr>
								<td>{{ $row->Raw_material_name }}</td>
								<td>{{ $row->QTY }}</td>
								<td>{{ $row->Price }}</td>
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