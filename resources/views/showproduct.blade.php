@extends('layout/Master')
@section('body')
<div class="container-fluid">
	@foreach($data as $row)
	<h1 style="text-align: center; color: black; padding-top: 20px;">Product Data Of {{ $row->Product_name }}<hr style="width: 100%; border: 1.5px solid black;"></h1>
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-4" style="text-align: right;">
					<tr>
							<th style="border: none;"></th>
							<td>
						      	<img src="{{ $row->Path }}" style="width: 250px;height: 250px">
						    </td>
						</tr>
				</div>
				<div class="col-lg-6">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<th style="border: none;">Name:</th>
							<td>{{$row->Product_name}}</td>
						</tr>
						<tr>
							<?php?>
							<th style="border: none;">Quantity:</th>
							<td>{{ $row->Qty }}</td>
						</tr>
						<tr>
							<th style="border: none;">Price:</th>
							<td>{{$row->Price}}</td>
						</tr>
						<tr>
							<th style="border: none;">Discount:</th>
							<td>{{$row->Discount}}</td>
						</tr>
						<tr>
							<th style="border: none;">Description:</th>
							<td>{{$row->Discription}}</td>
						</tr>
						<tr>
							<th style="border: none;">Category Name:</th>
							<td>{{$row->Category_name}}</td>
					</table>
					<a href="{{ URL::previous() }}" class="btn btn-warning mt-3"><i class="fa fa-arrow-left" aria-hidden="true"><span style="margin-left: 3px;">Go Back</span></i></a>	
				</div>
				<div class="col-lg-1"></div>
			</div>
		@endforeach
</div>

@endsection('body')