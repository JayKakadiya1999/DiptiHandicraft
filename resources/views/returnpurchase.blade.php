@extends('layout/Master')
@section('body')
<?php
	use Illuminate\Support\Facades\DB;
?>
<div class="container-fluid">
	@foreach($data as $row)
	<div class="title-heading">
		Purchse Return<hr style="background-color:  black;"></span>
	</div>
		<form action="{{ route('returnpurchaseform') }}" method="post">
			<div class="row pt-2">
				<div class="col-lg-2" style="text-align: right;">
				</div>
				<div class="col-lg-8 mb-5">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<input type="text" name="purchase_order_id" value="{{ $row->Purchase_order_id }}" style="display: none;"> 
							<th style = "border:none">Order Date</th>
							<td>{{ date('d/m/Y',strtotime($row->Order_date)) }}</td>
						</tr>
						<tr>
							<th style = "border:none">Supplier Name</th>
							<td>{{ $row->Name }}</td>
						</tr>
						<tr>
							<th style = "border:none">Supplier Contact No.</th>
							<td>{{ $row->Contact }}</td>
						</tr>
						<tr>
							<th style = "border:none">Supplier Address</th>
							<td>{{ $row->Address }},{{ $row->Area_name }},{{ $row->City_name }},{{ $row->State_name }}</td>
						</tr>
						<tr>
							<th style = "border:none">Total Amount</th>
							<td>Rs.{{ $row->Total_amt }}</td>
						</tr>
					</table>
					<table style="width: 100%; margin-top: 10px;" >
						{{ csrf_field() }}
						<tr>
							<th>Raw Material Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Select Quantity</th>
							<th>Reason</th>
						</tr>
						<?php
							$data = DB::table('Purchase_order_details')
													->join('raw_material','purchase_order_details.Raw_material_id','=','raw_material.Raw_material_id')
													->where('Purchase_order_id','=',$row->Purchase_order_id)
													->get(); 
						?>
						@foreach($data as $com)
							<tr>
								<td>{{ $com->Raw_material_name }}</td>
								<input type="text" name="id[]" value="{{ $com->Raw_material_id }}" style="display: none;">
								<td>Rs.{{ $com->Price }}</td>
								<td>{{ $com->QTY }}</td>
								
								<td>
									<select name="qty[]" style="border: 1px solid gray; width: 100%; height: 25px;">
											<option value="0" selected>0</option>
										<?php
											for ($i=1; $i < $com->QTY + 1; $i++)
											{ 
										?>
											<option value="{{ $i }}">{{ $i }}</option>
										<?php
											}
										?>
									</select>
								</td>
								<td>
									<input type="text" name="reason[]" placeholder="Enter Reason...">
								</td>
							</tr>
						@endforeach
					</table>
					<div class="row">
						<div class="col-lg-2">
							<a href="purchase" class="btn btn-warning mt-3"><i class="fa fa-arrow-left" aria-hidden="true"><span style="margin-left: 3px;">Back</span></i></a>
						</div>
						<div class="col-lg-10" style="text-align: right; margin-top: 10px;width: 100%;">
							<button class="btn btn-primary">Return</button>
						</div> 
					</div>	
				</div>
				<div class="col-lg-2">
				</div>
			</div>
			</form>
		@endforeach
</div>

@endsection('body')