@extends('layout/Master')
@section('body')
<?php
	use Illuminate\Support\Facades\DB;
?>

<div class="container-fluid">
	<div class="title-heading">
		Sales Return Details<hr style="background-color:  black;">
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
		<div class="col-lg-12">
			<div class="container-fluid p-0">
				<?php
					$number = 1;
				?>
				<table style="width: 100%;">
					<tr>
						<th>No.</th>
						<th>Order Date</th>
						<th>Return Date</th>
						<th>User Name</th>
						<th>User Contact No.</th>
						<th>User Address</th>
						<th>Total Amount</th>
						<th>Products Name</th>
						<th style="width: 95px;"></th>
					</tr>
					@foreach($data as $row)
						<tr>
							<td>{{ $number }}</td>
							<td>{{ date('d/m/Y',strtotime($row->Order_date)) }}</td>
							<td>{{ date('d/m/Y',strtotime($row->Return_date)) }}</td>
							<td>{{ $row->Name }}</td>
							<td>{{ $row->Contact }}</td>
							<td>{{ $row->Address }},{{ $row->Area_name }},{{ $row->City_name }},{{ $row->State_name }}</td>
							<td>Rs.{{ $row->Amt }}</td>
							<td>
								<?php
									$raw = DB::table('sales_return_details')
													->join('product','sales_return_details.Product_id','=','product.Product_id')
													->where('sales_return_id','=',$row->Sales_return_id)
													->get();
									$no = 1;
									foreach ($raw as $row)
									{
										echo $no.".".$row->Product_name."</br>";
										$no++;
									}
								?>
							</td>
							<td>
								<form action="{{ route('salesreturnview') }}" method="post">
									{{ csrf_field() }}
									<input type="text" name="id" value="{{ $row->Sales_return_id }}" style="display: none;">
									<button class="btn btn-success">View</button>
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