@extends('layout/Master')
@section('body')

	<div class="container-fluid" style="margin-bottom: 30px;">
		@foreach($data as $supp)
		<h1 style="text-align: center; color: black; padding-top: 20px;">Supplier Details Of {{ $supp->Name }}<hr style="width: 100%; border: 1.5px solid black;"></h1>
		<form action="{{ route('editsupplier') }}" method="post">
			{{ csrf_field() }}
			<div class="row pt-2">
				<div class="col-lg-2" style="text-align: right;">
				</div>
				<div class="col-lg-8">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<th style="border: none;">Name:</th>
							<td>
								<input type="text" name="id" style="display: none;" value="{{$supp->Supplier_id}}">
								<input type="text" class="edit-text" name="name" value="{{$supp->Name}}" required="true">
							</td>
						</tr>
						<tr>
							<th  style="border: none;">Email:</th>
							<td>
								<input type="text" class="edit-text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example123@gmail.com" value="{{$supp->Email}}">
							</td>
						</tr>
						<tr>
							<th style="border: none;">Contact No.:</th>
							<td>
								<input type="text" class="edit-text" name="contact" pattern="[1-9]{1}[0-9]{9}" title="10 Digit Required..." value="{{$supp->Contact}}">
							</td>
						</tr>
						<tr>
							<th style="border: none;">Address:</th>
							<td>
								<input type="text" class="edit-text" name="address" value="{{$supp->Address}}" required="true">
							</td>
						</tr>
						<tr>
							<th style="border: none;">Area:</th>
							<td>
								<input type="text" name="oldarea" style="display: none;" value="{{$supp->Area_name}}">
								<input type="text" class="edit-text" name="area" value="{{ucwords($supp->Area_name)}}" required="true">
							</td>
						</tr>
						<tr>
							<th style="border: none;">State:</th>
							<td>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" class="edit-text" name="oldstate" value="{{$supp->State_name}}" disabled="true">
									</div>
									<div class="col-lg-6">
										<div class="form-group" style="margin-bottom: 0;">
											<select class="form-control supplier-dropdown" name="states" id="states" required="true" onchange="citydatas()">
									        	<option value="0" disabled="true" selected="true">{{$supp->State_name}}</option>
									        	@foreach($state as $key => $value)
									        		<option value="{{ $value->State_id }}" class="text-black">{{ $value->State_name }}</option>
									        	@endforeach
									        </select>
										</div>
									</div>
								</div>
							</td>
						</tr>
						
						<tr>
							<th style="border: none;">City:</th>
							<td>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" class="edit-text" name="oldcity" value="{{$supp->City_name}}" disabled="true">
										<input type="text" name="oldcityid" value="{{$supp->City_id}}" style="display: none;">
									</div>
									<div class="col-lg-6">
										<div class="form-group" style="margin-bottom: 0;">
											<select class="form-control supplier-dropdown" name="city" id="city" required="true" title="Select City">
											    <option value="0" disabled="true" selected="true" value="{{ $supp->City_id }}">{{$supp->City_name}}</option>	
											</select>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<th style="border: none;">Material Name:</th>
							<td>
								<div class="row">
									<div class="col-lg-5">
										<input type="text" class="edit-text" name="oldmaterial" value="{{$supp->Raw_material_name}}" disabled="true">
									</div>
									<div class="col-lg-3">
										<a href="#" class="btn btn-success" style="width: 100%;" onclick="materialdata()">Change</a>
									</div>
									<div class="col-lg-4">
										<div class="form-group" style="margin-bottom: 0;" id="material">
											<select class="form-control supplier-dropdown material" name="material" id="material" required="true" title="Select Material Name">
												<option value="0" disabled="true" selected="true">{{$supp->Raw_material_name}}</option>
											</select>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<button class="btn btn-primary" style="width: 100%; margin-top: 10px; font-size: 20px; height: 40px;" onclick="return confirm('Are you sure want to update this Supplier record ?');"><i class="fa fa-floppy-o" aria-hidden="true"></i><span style="margin-left: 3px;">Save</span></button>
					<a href="{{ URL::previous() }}" class="btn btn-warning mt-3"><i class="fa fa-arrow-left" aria-hidden="true"><span style="margin-left: 3px;">Go Back</span></i></a>
				</div>
				<div class="col-lg-2">
				</div>
			</div>
		</form>
		@endforeach
	</div>

@endsection('body')