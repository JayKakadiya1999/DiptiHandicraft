@extends('layout/Master')
@section('body')

	<div class="container">
		<h1 style="text-align: center; color: black; padding-top: 20px;">Raw-Material Details<hr style="width: 365px; border: 1.5px solid black;"></h1>
       
	
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				Upload Validation Error<br><br>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
				
			</div>
		@endif

		<div class="row">
			<div class="col-lg-12">
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

		<div class="row" style="margin-left: 745px;">
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rawmaterial" style="width: 80px; margin-top: 15px; margin-bottom: 15px; height: 40px;">Add</button>
		</div>
		<div class="row">
			<div class="col-lg-3">
			</div>
			<div class="col-lg-6">
				<table style="width: 100%; font-size: 18px;">
				    <tr>
				      <th>No.</th>
				      <th>Image</th>
				      <th>Raw-Material Name</th>
				      <th>Qty on Hand</th>
				      <th></th>
				      <th></th>
				    </tr>
				  	@foreach($data as $row)
					    <tr>
					      <td>{{ $row->Raw_material_id }}</td>
					      <td>
					      	<img src="{{ $row->Path }}" style="width: 70px;height: 70px;">
					      </td>
					      <td>{{ $row->Raw_material_name }}</td>
					      <td>{{ $row->QOH }}</td>
					      <td style="padding: 5px; width: 15%;">
					      	<a href='{{ url("rawmaterialdelete/{$row->Raw_material_id}") }}' class="btn btn-danger" style="height: 40px;" onclick="return confirm('Are You Sure Want To Delete This Record ?');">
					      		Delete
					      	</a>
					      </td>
					      <td style="padding: 5px; width: 15%;">
					      	<form action="{{ route('rawmaterialupdate') }}" method="post" style="margin-bottom: 0;">
					      		{{ csrf_field() }}
					      		<input type="text" name="id" style="display: none;" value="{{ $row->Raw_material_id }}">
					      		<button class="btn btn-primary" style="height: 40px; width: 100%;">Edit</button>
					      	</form>
					      </td>
					    </tr>
					 @endforeach
				  </tbody>
				</table>
				{!! $data->render() !!}
			</div>
			<div class="col-lg-3">
			</div>
		</div>
	</div>

@endsection('body')

<!-- Modal -->
<div class="modal fade" id="rawmaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Raw Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: right;">
      	<form action="{{ route('rawmaterialform') }}" method="post" enctype="multipart/form-data">
      		{{  csrf_field() }}
	        <input type="text" name="name" style="width: 100%; margin-bottom: 20px; border-radius: 10px; border: 1px solid black; height: 35px; font-size: 20px; outline: none; padding-left: 10px; padding-right: 10px;" required="true" placeholder="Enter Raw Material Name...">
	        <input type="text" name="qoh" style="width: 100%; margin-bottom: 20px; border-radius: 10px; border: 1px solid black; height: 35px; font-size: 20px; outline: none; padding-left: 10px; padding-right: 10px;" required="true" placeholder="Enter Quentity On Hand...">
	        
	        <input type="file" name="image_raw" style="border:1px solid black; border-radius: 10px; margin-bottom: 10px; width: 100%; padding: 2px 8px 2px 8px; text-decoration: none; " required="true">

	      	<button type="button" class="btn btn-secondary" data-dismiss="modal" style="height: 40px;">Close</button>
	        <button class="btn btn-primary" type="submit" style="height: 40px;">Save</button>
	    </form>
      </div>
    </div>
  </div>
</div>