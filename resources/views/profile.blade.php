@extends('layout/cusmaster')
@section('body')

	<div class="container">
		<div class="row">
			<div class="col-lg-12" style="text-align: center; font-size: 50px; color: #384aeb;">
				Profile<hr style="width: 120px; border: 2px solid black; margin-top: 0;">
			</div>
			<div class="col-lg-2">	
			</div>
			<div class="col-lg-8">	
				<table class="profile-table" style="font-size: 25px; background-color: darkblue; color: white;">
					@foreach($data as $row)
						<tr>
							<th style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">Name</th>
							<td style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">{{ $row->Name }}</td>
						</tr>
						<tr>
							<th style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">Email</th>
							<td style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">{{ $row->Email }}</td>
						</tr>
						<tr>
							<th style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">Contact No.</th>	
							<td style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">{{ $row->Contact }}</td>
						</tr>
						<tr>
							<th style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">Address</th>
							<td style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">{{ $row->Address }}</td>
						</tr>
						<tr>
							<th style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">Area</th>	
							<td style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">{{ $row->Area_name }}</td>
						</tr>
						<tr>
							<th style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">City</th>	
							<td style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">{{ $row->City_name }}</td>
						</tr>
						<tr>
							<th style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">State</th>	
							<td style="border: 5px solid #384aeb; text-align: left; padding: 8px; height: 60px;
	position: all; padding-left: 15px;">{{ $row->State_name }}</td>
						</tr>
					@endforeach
				</table>
			</div>
			<div class="col-lg-2">	
			</div>
		</div>
	</div>

@endsection('body')