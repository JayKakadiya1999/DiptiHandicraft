@extends('layout/Master')
@section('body')
<?php
	use Illuminate\Support\Facades\DB;
?>
<div class="container-fluid">
	<h1 style="text-align: center; color: black; padding-top: 20px;">Supplier Details<hr style="width: 270px; border: 1.5px solid black;"></h1>
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
		<div style="text-align:left">
		<h3>Total Suppliers : <?php
									$sup = DB::table('supplier')
											->count();
								?> {{ $sup }}</h3>
		</div>
		<button type="button" style="width: 100px; margin-bottom: 5px;" class="btn btn-success" data-toggle="modal" data-target="#addsupplier">Add</button>
	</div>
	<?php
		$number = 1;
	?>
	<table style="width: 100%; border-collapse: collapse;">
	<tr style="text-align: center;">
		<th>No.</th>
		<th>Name</th>
		<th>Email</th>
		<th>Contact</th>
		<th>Material Name</th>
		<th>Address</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	@if(count($data)>0)
		@foreach($data as $supplier)
		<tr>
			<td>
				<?php
					echo $number;
					$number++;
				?>
			</td>
			<td>{{$supplier->Name}}</td>
			<td>{{$supplier->Email}}</td>
			<td>{{$supplier->Contact}}</td>
			<td>{{ $supplier->Raw_material_name }}</td>
			<td><?php echo $supplier->Address.", ".ucwords($supplier->Area_name).", ".ucwords($supplier->City_name).", ".ucwords($supplier->State_name) ?></td>
			
			<td>
				<form action="{{ route('updatesupplier') }}" method="post">
					{{ csrf_field() }}
					<input type="text" name="id" style="display: none;" value="{{ $supplier->Supplier_id }}">
					<button type="submit" class="btn btn-primary" style="width: 100%;">Edit</button>
				</form>
			</td>
			<td>
		      	<a href='' class="btn btn-danger" style=" width: 100%;" onclick="warning();">
		      		Delete
		      	</a>
	      </td>
			<td>
				<form action="{{ route('showsupplier') }}" method="post">
					{{ csrf_field() }}
					<input type="text" name="id" style="display: none;" value="{{ $supplier->Supplier_id }}">
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
	<div class="modal fade"  id="addsupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="container-fluid">
		      	<form action="{{ route('supplierstore') }}" method="post">
		      		{{ csrf_field() }}
		      		<div class="row">
		      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		      				Name:<br>
		      				<input type="text" class="supplier-text" placeholder="Enter Supplier Name" name="name" required="true" title="Enter Supplier Name" style="width: 100%;">
		      			</div>
		      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		      				Email:<br><input type="email" placeholder="Enter Supplier Email" class="supplier-text" name="email" required="true" title="example123@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" style="width: 100%;">
		      			</div>
		      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		      				Contact No.:<br><input type="text" placeholder="Enter Supplier Contact Number" class="supplier-text" name="contact" pattern="[1-9]{1}[0-9]{9}" required="true" title="Enter Supplier Contact Number" style="width: 100%;">
		      			</div>
		      			<div class="col-lg-6 col-md-4 col-sm-12 col-xs-12" style="margin-top: 10px;">
		      				Address:<br><input type="text" class="supplier-text" name="address" required="true" placeholder="Enter Supplier Shop Address" style="width: 100%;" title="Enter Supplier Shop Address">
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
		      				$raw_material = DB::table('raw_material')->get();
		      			?>
		      			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		      				<div class="form-group" style="margin-top: 10px;">
								Select Material:
								<select class="form-control supplier-dropdown" name="raw_material" id="raw_material" required="true" title="Select Material Name">
									<option value="0" disabled="true" selected="true">== Select Material Name ==</option>
									@foreach($raw_material as $raw)
										<option value="{{ $raw->Raw_material_id }}">{{ $raw->Raw_material_name }}</option>
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