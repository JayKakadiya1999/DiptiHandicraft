@extends('layout/Master')
@section('body')

	<div class="container-fluid">
		<div class="title-heading">
			Add Purchase Order
			
			<hr style="background-color:  black;">
		</div>
		<div class="row">
			<div class="col-lg-2">
				
			</div>
			<div class="col-lg-8">
				<form action="{{ route('addpurchaseorder') }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div style="text-align: right;">
						<div class="row">
							<div class="col-lg-0">
								
							</div>
							<div class="col-lg-6" style="text-align: right;">
								<h4 style="margin-right:14px;">Select Order Date</h4>
								<input type="date" name="orderdate" style="border: 1px solid gray; border-radius: 10px; outline: none; padding: 5px 5px 5px 5px; width: 50%;" required="true">
							</div>
							<div class="col-lg-6">
								<h4 style="margin-right: 18px;">Select Supplier</h4>
								<select required name="supplier" id="supplier" style="padding: 8px 5px 8px 5px; border-radius: 10px; outline: none;" required="true">
									<option disabled selected>== Select Supplier ==</option>
									@foreach($supplier as $com)
										<option value="{{ $com->Supplier_id }}">{{ $com->Name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div id="purchaseorder" style="margin-top: 10px;" class="area" id="area">
						<div class="row" style="margin-top: 8px;">
							<div class="col-lg-4">
								<h5>Select Material</h5>
								<select name="material[]" style="padding: 8px 5px 8px 5px; border-radius: 10px; outline: none; width: 100%;" required>
									<option disabled selected>== Select Material ==</option>
									@foreach($category as $com)
										<option value="{{ $com->Raw_material_id }}">{{ $com->Raw_material_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-lg-3">
								<h5>Quantity</h5>
								<input type="text" name="qty[]" style="border: 1px solid gray; padding: 5px 5px 5px 5px; border-radius: 10px; outline: none; width: 100%;" placeholder="Enter Quantity" required>
							</div>
							<div class="col-lg-3">
								<h5>Price</h5>
								<input type="text" name="price[]" style="border: 1px solid gray; padding: 5px 5px 5px 5px; border-radius: 10px; outline: none; width: 100%;" placeholder="Enter Price" required>
							</div>
							<div class="col-lg-2">
								<a id="add" onclick="add()" class="add btn btn-primary add" style="margin-top: 33px; color: white; width: 100%;"><span style="margin-left: 3px;">ADD</span></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10">
						</div>
						<div class="col-lg-2" style="text-align: right;">
							<button class="btn btn-primary" style="margin-top: 10px;"><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left: 3px;">Save</span></button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-2">
				
			</div>
		</div>

	</div>

	<script>
		function add()
		{
			i = 0;
			i++;
			$('#purchaseorder').append('<div class="row" style="margin-top: 8px;" id="'+ i +'"><div class="col-lg-4"><select name="material[]" style="padding: 8px 5px 8px 5px; border-radius: 10px; outline: none; width: 100%;" required><option disabled selected>== Select Material ==</option>@foreach($category as $com)<option value="{{ $com->Raw_material_id }}">{{ $com->Raw_material_name }}</option>@endforeach</select></div><div class="col-lg-3"><input type="text" name="qty[]" style="border: 1px solid gray; padding: 5px 5px 5px 5px; border-radius: 10px; outline: none; width: 100%;" placeholder="Enter Quantity" required></div><div class="col-lg-3"><input type="text" name="price[]" style="border: 1px solid gray; padding: 5px 5px 5px 5px; border-radius: 10px; outline: none; width: 100%;" placeholder="Enter Price" required></div><div class="col-lg-2"><a class="btn btn-danger btn_remove" style="color:white; width: 100%;" onclick="remove('+ i +')">X</a></div></div>');
		}	
	</script>
	<script>
		function remove(id)
		{
			var button_id = id;
			document.getElementById(i).remove();
		}
	</script>

@endsection('body')