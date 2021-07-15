@extends('layout/Master')
@section('body')

	<div class="container">
		@foreach($data as $row)
		<h1 style="text-align: center; color: black; padding-top: 20px;">Raw Material Details Of {{ $row->Raw_material_name }}<hr style="width: 100%; border: 1.5px solid black;"></h1>
		<form action="{{ route('editrawmaterial') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-lg-3">
				</div>
				<div class="col-lg-6">
					<table class="table table-lg" style="width: 100%;">
						<input type="text" name="id" value="{{ $row->Raw_material_id }}" style="display: none;">
					  <tr>
					  	<th style="border: 1px solid black">Name:</th>
					  	<td style="border: 1px solid black">
					  		<input type="text" name="name" value="{{ $row->Raw_material_name }}" class="inputbox">
					  	</td>
					  </tr>
					  <tr>
					  	<th style="border: 1px solid black">Quantity On Hand:</th>
					  	<td style="border: 1px solid black">
					  		<input type="text" name="qoh" value="{{ $row->QOH }}" class="inputbox">
					  	</td>
					  </tr>
					  <tr>
					  	<th style="border: 1px solid black">Select Image:</th>
					  	<td style="border: 1px solid black; padding-bottom: 0px;">
					  			<img src="{{ $row->Path }}" style="width: 70px; margin-bottom: 5px;">
					  			<input type="file" name="image_raw" style="border:1px solid black; border-radius: 10px; margin-bottom: 10px; width: 79%; padding: 2px 8px 2px 8px; text-decoration: none; ">
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