@extends('layout/Master')
@section('body')
<?php
	use Illuminate\Support\Facades\DB;
?>
<div class="container-fluid">
	<h1 style="text-align: center; color: black; padding-top: 20px;">Product Details<hr style="width: 365px; border: 1.5px solid black;"></h1>
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
		<button type="button" style="width: 100px; margin-bottom: 5px;" class="btn btn-success" data-toggle="modal" data-target="#product">Add</button>
	</div>
	<?php
		$number = 1;
	?>
	<table style="width: 100%; border-collapse: collapse;">
	<tr style="text-align: center;">
		<th>No.</th>
      	<th>Image</th>
      	<th>Product Name</th>
      	<th>Quantity</th>
      	<th>Price</th>
      	<th>Discount</th>
      	<th>Description</th>
      	<th>Category</th>
      	<th></th>
      	<th></th>
      	<th></th>
	</tr>
	@if(count($data)>0)
		@foreach($data as $row)
		
		<tr>
			<td>{{ $row->Product_id }}</td>
		    <td>
		      	<img src="{{ $row->Path }}" style="width: 70px;">
		    </td>
		    <td>{{ $row->Product_name }}</td>
		    <td>{{ $row->Qty }}</td>
		    <td>{{ $row->Price }}</td>
		    <td>{{ $row->Discount }}</td>
		    <td>{{ $row->Discription }}</td>
		    <td>{{ $row->Category_name }}</td>
			<td>
	      	<form action="{{ route('productupdate') }}" method="post" style="margin-bottom: 0;">
	      		{{ csrf_field() }}
	      		<input type="text" name="id" style="display: none;" value="{{ $row->Product_id }}">
	      		<button class="btn btn-primary" style="height: 40px; width: 100%;">Edit</button>
	      	</form>
	      	</td>
	      	<td>
	      		<a href='#' class="btn btn-danger" style="height: 40px; width: 100%;" onclick="warning()">
	      		Delete
	      		</a>
	      	<!--{{ url("productdelete/{$row->Product_id}") }}-->
	      	</td>
	      	<td>
	      		<form action="{{ route('showproduct') }}" method="post" style="margin-bottom: 0;">
	      		{{ csrf_field() }}
	      			<input type="text" name="id" style="display: none;" value="{{ $row->Product_id }}">
	      			<button class="btn btn-success" style="height: 40px; width: 100%;">View</button>
	      		</form>
	      	</td>
		</tr>
		@endforeach
	@endif
	</table>
	{!! $data->render() !!}
</div>

@endsection('body')


<!-- Modal -->
<div class="modal fade" id="product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: right;">
      	<form action="{{ route('productform') }}" method="post" enctype="multipart/form-data">
      		{{  csrf_field() }}
      		<div class="row" style="text-align: left;">
      			<div class="col-lg-4">
      				<h4>Product Name:</h4>
      				 <input type="text" name="name" style="width: 100%; margin-bottom: 20px; border-radius: 10px; border: 1px solid black; height: 35px; font-size: 20px; outline: none; padding-left: 10px; padding-right: 10px;" required="true" placeholder="Enter Product Name...">
      			</div>
      			<div class="col-lg-4">
      				<h4>Select Image:</h4>
      				 <input type="file" name="image_raw" style="border:1px solid black; border-radius: 10px; margin-bottom: 10px; width: 100%; padding: 2px 8px 2px 8px; text-decoration: none; " required="true" accept="image" multiple>
      			</div>
      			<div class="col-lg-4">
      				<h4>Quentity:</h4>
      				 <input type="text" name="qty" style="width: 100%; margin-bottom: 20px; border-radius: 10px; border: 1px solid black; height: 35px; font-size: 20px; outline: none; padding-left: 10px; padding-right: 10px;" required="true" placeholder="Enter Quentity...">
      			</div>
      			<div class="col-lg-4">
      				<h4>Price:</h4>
      				 <input type="text" name="price" style="width: 100%; margin-bottom: 20px; border-radius: 10px; border: 1px solid black; height: 35px; font-size: 20px; outline: none; padding-left: 10px; padding-right: 10px;" required="true" placeholder="Enter Price...">
      			</div>
      			<div class="col-lg-4">
      				<h4>Discount:</h4>
      				 <input type="text" name="discount" style="width: 100%; margin-bottom: 20px; border-radius: 10px; border: 1px solid black; height: 35px; font-size: 20px; outline: none; padding-left: 10px; padding-right: 10px;" required="true" placeholder="Enter Discount...">
      			</div>
      			<div class="col-lg-4">
      				<h4>Description:</h4>
      				 <input type="text" name="discription" style="width: 100%; margin-bottom: 20px; border-radius: 10px; border: 1px solid black; height: 35px; font-size: 20px; outline: none; padding-left: 10px; padding-right: 10px;" required="true" placeholder="Enter Description...">
      			</div>
      			<div class="col-lg-4">
      				<h4>Select Category:</h4>
      				 <select style="width: 100%; border: 1px solid black; border-radius: 10px; padding: 5px; margin-bottom: 15px; height: 38px;" name="category" required>
			        	<option selected>==Select Category==</option>
			        	@foreach($category as $row)
			        		<option value="{{ $row->Category_id }}">{{ $row->Category_name }}</option>
			        	@endforeach
			        </select>
      			</div>
      		</div> 

	      	<button type="button" class="btn btn-secondary" data-dismiss="modal" style="height: 40px;">Close</button>
	        <button class="btn btn-primary" type="submit" style="height: 40px;">Save</button>
	    </form>
      </div>
    </div>
  </div>
</div>