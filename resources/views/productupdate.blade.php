@extends('layout/Master')
@section('body')

	<div class="container">
		@foreach($data as $row)
		<h1 style="text-align: center; color: black; padding-top: 20px;">Product Details Of {{ $row->Product_name }}<hr style="width: 100%; border: 1.5px solid black;"></h1>
		<form action="{{ route('editproduct') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-lg-3">
				</div>
				<div class="col-lg-6">
					<table class="table table-lg" style="width: 100%;">
						<input type="text" name="id" value="{{ $row->Product_id }}" style="display: none;">
					  <tr>
					  	<th style="border: 1px solid black">Name:</th>
					  	<td style="border: 1px solid black">
					  		<input type="text" name="name" value="{{ $row->Product_name }}" class="inputbox">
					  	</td>
					  </tr>
					  <tr>
					  	<th style="border: 1px solid black">Image:</th>
					  	<td style="border: 1px solid black">
					  		<div class="row">
					  			<img src="{{ $row->Path }}" style="width: 70px; margin-left: 20px;">
					  			<input type="file" name="image_raw" style="border:1px solid black; border-radius: 10px; margin-bottom: 10px; margin-top: 18px; margin-left: 20px; width: 69%; padding: 2px 8px 2px 8px; text-decoration: none; height: 37px;">
					  		</div>
					  	</td>
					  </tr>
					  <tr>
					  	<th style="border: 1px solid black">Quantity:</th>
					  	<td style="border: 1px solid black">
					  		<input type="text" name="qty" value="{{ $row->Qty }}" class="inputbox">
					  	</td>
					  </tr>
					  <tr>
					  	<th style="border: 1px solid black">Price:</th>
					  	<td style="border: 1px solid black">
					  		<input type="text" name="price" value="{{ $row->Price }}" class="inputbox">
					  	</td>
					  </tr>
					  <tr>
					  	<th style="border: 1px solid black">Discount:</th>
					  	<td style="border: 1px solid black">
					  		<input type="text" name="discount" value="{{ $row->Discount }}" class="inputbox">
					  	</td>
					  </tr>
					  <tr>
					  	<th style="border: 1px solid black">Description:</th>
					  	<td style="border: 1px solid black">
					  		<input type="text" name="discription" value="{{ $row->Discription }}" class="inputbox">
					  	</td>
					  </tr>
					  <tr>
					  	<th style="border: 1px solid black">Category:</th>
					  	<td style="border: 1px solid black">
						  	<select style="width: 100%; border: 1px solid black; border-radius: 10px; padding: 5px; height: 38px;" name="category">
						  		<option selected value="{{ $row->Category_id }}">{{ $row->Category_name }}</option>
						        	@foreach($category as $row)
						        		<option value="{{ $row->Category_id }}">{{ $row->Category_name }}</option>
						        	@endforeach
						    </select>
					  	</td>
					  </tr>
					  
					</table>
					<button class="btn btn-primary" style="width: 100%;">Save</button>
					<a href="{{ URL::previous() }}" class="btn btn-warning mt-3"><i class="fa fa-arrow-left" aria-hidden="true"><span style="margin-left: 3px;">Go Back</span></i></a>
				</div>
				<div class="col-lg-3">
				</div>
			</div>
		</form>
	@endforeach
	</div>

@endsection('body')