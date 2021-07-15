@extends('layout/Master')
@section('body')
<?php
	use Illuminate\Support\Facades\DB;
?>

<div class="container-fluid">
	<div class="title-heading">
		Purchase Details<hr style="background-color:  black;">
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@if(session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			@endif
			@if(session('danger'))
				<div class="alert alert-danger">
					{{ session('danger') }}
				</div>
			@endif
		</div>
		<div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10" style="text-align: right;">
		</div>
		<div class="col-lg-2">
			<div style="text-align: right; margin-right: 12px;">
				<a href="addpurchase" style="width: 100px; margin-bottom: 5px;" class="btn btn-primary"><span style="margin-left: 3px;">Add</span></a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="container-fluid p-0">
				<?php
					$number = 1;
				?>
				<table style="width: 100%;">
					<tr>
						<th>No.</th>
						<th>Purchsse Date</th>
						<th>Supplier Name</th>
						<th>Supplier Contact No.</th>
						<th>Supplier Address</th>
						<th>Total Amount</th>
						<th>Raw Material</th>
						<th>Return order</th>
						<th style="width: 95px;"></th>
					</tr>
					@foreach($data as $row)
						<tr>
							<td>{{ $number }}</td>
							<td>{{ date('d/m/Y',strtotime($row->Order_date)) }}</td>
							<td>{{ $row->Name }}</td>
							<td>{{ $row->Contact }}</td>
							<td>{{ $row->Address }},{{ $row->Area_name }},{{ $row->City_name }},{{ $row->State_name }}</td>
							<td>Rs.{{ $row->Total_amt }}</td>
							<td>
								<?php
									$product = DB::table('purchase_order_details')
													->join('raw_material','purchase_order_details.Raw_material_id','=','raw_material.Raw_material_id')
													->where('Purchase_order_id','=',$row->Purchase_order_id)
													->get();
									$no = 1;
									foreach ($product as $row)
									{
										echo $no.".".$row->Raw_material_name."</br>";
										$no++;
									}
								?>
							</td>
							<td>
								<?php
									$valid = DB::table('purchase_return')
											->where('Purchase_order_id','=',$row->Purchase_order_id)
											->get();
								?>
								@if($valid == null)
									No
								@endif
								@if($valid != null)
									Yes
								@endif
							</td>
							<td>
								<form action="{{ route('purchseview') }}" method="post">
									{{ csrf_field() }}
									<input type="text" name="id" value="{{ $row->Purchase_order_id }}" style="display: none;">
									<button class="btn btn-success" style="width:100%;">View</button>
								</form>
							</td>
						</tr>
						<?php
							$number = $number + 1;
						?>
					@endforeach
				</table>
			</div>		
		</div>
	</div>
	
</div>

@endsection('body')