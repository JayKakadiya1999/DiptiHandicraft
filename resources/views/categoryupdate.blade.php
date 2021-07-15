@extends('layout/Master')
@section('body')

	<div class="container">
		@foreach($data as $row)
		<h1 style="text-align: center; color: black; padding-top: 20px;">Category Details Details Of {{ $row->Category_name }}<hr style="width: 100%; border: 1.5px solid black;"></h1>
		<form action="{{ route('editcategory') }}" method="post">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-lg-3">
				</div>
				<div class="col-lg-6">
					<table class="table table-lg" style="width: 100%;">
						<input type="text" name="id" value="{{ $row->Category_id }}" style="display: none;">
					  <tr>
					  	<th style="border: 1px solid black">Name:</th>
					  	<td style="border: 1px solid black">
					  		<input type="text" name="name" value="{{ $row->Category_name }}" class="inputbox">
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