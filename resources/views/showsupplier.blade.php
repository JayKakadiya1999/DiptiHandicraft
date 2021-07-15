@extends('layout/Master')
@section('body')
<div class="container-fluid">
	@foreach($data as $sup)
	<h1 style="text-align: center; color: black; padding-top: 20px;">Supplier Data Of {{ $sup->Name }}<hr style="width: 100%; border: 1.5px solid black;"></h1>
			<div class="row pt-2">
				<div class="col-lg-3" style="text-align: right;">
				</div>
				<div class="col-lg-6">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<th style="border: none;">Name:</th>
							<td>{{$sup->Name}}</td>
						</tr>
						<tr>
							<th style="border: none;">Email:</th>
							<td>{{$sup->Email}}</td>
						</tr>
						<tr>
							<th style="border: none;">Contact No.:</th>
							<td>{{$sup->Contact}}</td>
						</tr>
						<tr>
							<th style="border: none;">Address:</th>
							<td>{{$sup->Address}}</td>
						</tr>
						<tr>
							<th style="border: none;">Area:</th>
							<td>{{$sup->Area_name}}</td>
						</tr>
						<tr>
							<th style="border: none;">State:</th>
							<td>{{$sup->State_name}}</td>
						</tr>
						<tr>
							<th style="border: none;">City:</th>
							<td>{{$sup->City_name}}</td>
						</tr>
						<tr>
							<th style="border: none;">Raw_material_name:</th>
							<td>{{$sup->Raw_material_name}}</td>
						</tr>
					</table>
					<a href="{{ URL::previous() }}" class="btn btn-warning mt-3"><i class="fa fa-arrow-left" aria-hidden="true"><span style="margin-left: 3px;">Go Back</span></i></a>	
				</div>
				<div class="col-lg-3">
				</div>
			</div>
		@endforeach
</div>

@endsection('body')