@extends('layout/Master')
@section('body')
<?php
	use Illuminate\Support\Facades\DB;
?>
<div class="container-fluid">
	<h1 style="text-align: center; color: black; padding-top: 20px;">Employee Details<hr style="width: 300px; border: 1.5px solid black;"></h1>
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
	</div>
	<div class="supplier-add" style="text-align: right; margin-right: 5px;">
		<button type="button" style="width: 100px; margin-bottom: 5px;" class="btn btn-success" data-toggle="modal" data-target="#employee">Add</button>
	</div>
	<?php
		$number = 1;
	?>
	<table style="width: 100%; border-collapse: collapse;">
	<tr style="text-align: center;">
		<th>No.</th>
		<th>Name</th>
		<th>Date Of Joining</th>
		<th>Email</th>
		<th>Contact</th>
		<th>Address</th>
		<th>Product Name</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	@if(count($data)>0)
		@foreach($data as $row)
		<tr>
			<td>
				<?php
					echo $number;
					$number++;
				?>
			</td>
			<td>{{$row->Name}}</td>
			<td>{{ $row->DOJ }}</td>
			<td>{{$row->Email}}</td>
			<td>{{$row->Contact}}</td>
			<td><?php echo $row->Address.", ".ucwords($row->Area_name).", ".ucwords($row->City_name).", ".ucwords($row->State_name) ?></td>
			<td>{{ $row->Product_name }}</td>
			
			
			<td>
				<form action="{{ route('updateemployee') }}" method="post">
					{{ csrf_field() }}
					<input type="text" name="id" style="display: none;" value="{{ $row->Employee_id }}">
					<button type="submit" class="btn btn-primary" style="width: 100%;">Edit</button>
				</form>
			</td>
			<td>
		      	<a href='' class="btn btn-danger" style=" width: 100%;" onclick="warning();">
		      		Delete
		      	</a>
	      </td>
			<td>
				<form action="{{ route('showemployee') }}" method="post">
					{{ csrf_field() }}
					<input type="text" name="id" style="display: none;" value="{{ $row->Employee_id }}">
					<button type="submit" class="btn btn-success" style="width: 100%;">View</button>
				</form>
			</td>
		</tr>
		@endforeach
	@endif
	</table>
	{!! $data->render() !!}
</div>




	<!--Add Supplier Modal -->
	<div class="modal fade"  id="employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="container-fluid">
		      	<form action="{{ route('employeestore') }}" method="post">
		      		{{ csrf_field() }}
		      		<div class="row">
		      			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
		      				Name:<br>
		      				<input type="text" class="supplier-text" placeholder="Enter Employee Name" name="name" required="true" title="Enter Supplier Name" style="width: 100%;">
		      			</div>
		      			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
		      				Date:<br>
		      				<input type="date" class="supplier-text" placeholder="Enter Joining Date" name="date" required="true" title="Enter Joining Date" style="width: 100%;">
		      			</div>
		      			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
		      				Email:<br><input type="email" placeholder="Enter Employee Email" class="supplier-text" name="email" required="true" title="example123@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" style="width: 100%;">
		      			</div>
		      			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
		      				Contact No.:<br><input type="text" placeholder="Enter Employee Contact Number" class="supplier-text" name="contact" pattern="[1-9]{1}[0-9]{9}" required="true" title="Enter Supplier Contact Number" style="width: 100%;">
		      			</div>
		      			<div class="col-lg-6 col-md-4 col-sm-12 col-xs-12" style="margin-top: 10px;">
		      				Address:<br><input type="text" class="supplier-text" name="address" required="true" placeholder="Enter Employee Address" style="width: 100%;" title="Enter Supplier Shop Address">
		      			</div>
		      			<div class="col-lg-6 col-md-4 col-sm-12 col-xs-12" style="margin-top: 10px;">
		      				Area:<br><input type="text" placeholder="Enter Area" class="supplier-text" name="area" required="true" title="Enter Supplier Shop Area" style="width: 100%;">
		      			</div>
		      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		      				<div class="form-group" style="margin-top: 10px;">
								Select State:
								<select class="form-control supplier-dropdown" name="state" id="state" required="true" onchange="citydata()" title="Select State">
										<option value="0" disabled="true" selected="true">== Select State ==</option>
									@foreach($state as $row)
										<option value="{{ $row->State_id }}">{{ $row->State_name }}</option>
									@endforeach
								</select>
							</div>
		      			</div>
		      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		      				<div class="form-group" style="margin-top: 10px;">
								Select City:
								<select class="form-control supplier-dropdown" name="city" id="city" required="true" title="Select City">
								    <option value="0" disabled="true" selected="true">== Select City ==</option>
								</select>
							</div>
		      			</div>
		      			<?php
		      				$product = DB::table('product')->get();
		      			?>
		      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		      				<div class="form-group" style="margin-top: 10px;">
								Select Product:
								<select class="form-control supplier-dropdown" name="product" id="product" required="true" title="Select Product Name">
									<option value="0" disabled="true" selected="true">== Select Product Name ==</option>
									@foreach($product as $raw)
										<option value="{{ $raw->Product_id }}">{{ $raw->Product_name }}</option>
									@endforeach
								</select>
							</div>
		      			</div>
		      			<div class="add-supplier col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<button type="submit" style="width: 100px;" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left: 3px;">Save</span></button>
						</div>
					</div>
				</form>
			</div>
	      </div>
	    </div>
	  </div>
	</div>

@endsection('body')