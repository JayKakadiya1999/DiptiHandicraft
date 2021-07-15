@extends('layout/Master')
@section('body')
<div class="container-fluid">
	@foreach($data as $emp)
	<h1 style="text-align: center; color: black; padding-top: 20px;">Employee Data Of {{ $emp->Name }}<hr style="width: 100%; border: 1.5px solid black;"></h1>
			<div class="row pt-2">
				<div class="col-lg-3" style="text-align: right;">
				</div>
				<div class="col-lg-6">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<th style="border: none;">Name:</th>
							<td>{{$emp->Name}}</td>
						</tr>
						<tr>
							<?php?>
							<th style="border: none;">Date Of Joining:</th>
							<td>{{$emp->DOJ}}</td>
						</tr>
						<tr>
							<th style="border: none;">Email:</th>
							<td>{{$emp->Email}}</td>
						</tr>
						<tr>
							<th style="border: none;">Contact:</th>
							<td>{{$emp->Contact}}</td>
						</tr>
						<tr>
							<th style="border: none;">Address:</th>
							<td>{{$emp->Address}}</td>
						</tr>
						<tr>
							<th style="border: none;">Area:</th>
							<td>{{$emp->Area_name}}</td>
						</tr>
						<tr>
							<th style="border: none;">State:</th>
							<td>{{$emp->State_name}}</td>
						</tr>
						<tr>
							<th style="border: none;">City:</th>
							<td>{{$emp->City_name}}</td>
						</tr>
						<tr>
							<th style="border: none;">Product_name:</th>
							<td>{{$emp->Product_name}}</td>
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