@extends('layout/Master')
@section('body')

	<div class="container-fluid" style="">
		<h1 style="text-align: center; color: black; padding-top: 20px;">Category Details<hr style="width: 270px; border: 1.5px solid black;"></h1>

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

		<div class="row" style="margin-left: 914px;">
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#category" style="width: 80px; margin-top: 15px; margin-bottom: 15px; height: 40px;">Add</button>
		</div>

		<div class="row">
			<div class="col-lg-3">
			</div>
			<div class="col-lg-6">
				<table style="width: 100%; font-size: 25px;">
					<tr>
						<th>No.</th>
						<th>Category Name</th>
						<th></th>
						<th></th>	
					</tr>
					@foreach($data as $row)
						<tr>
							<td>{{ $row->Category_id }}</td>
					      	<td>{{ $row->Category_name }}</td>

					      	<td style="padding: 5px; width: 15%;">
					      	<a href='{{ url("categorydelete/{$row->Category_id}") }}' class="btn btn-danger" style="height: 40px;" onclick="return confirm('Are You Sure Want To Delete This Record ?');">
					      		Delete
					      	</a>
					      </td>
					      <td style="padding: 5px; width: 15%;">
					      	<form action="{{ route('categoryupdate') }}" method="post" style="margin-bottom: 0;">
					      		{{ csrf_field() }}
					      		<input type="text" name="id" style="display: none;" value="{{ $row->Category_id }}">
					      		<button class="btn btn-primary" style="height: 40px; width: 100%;">Edit</button>
					      	</form>
					      </td>
						</tr>
					@endforeach
				</table>
			</div>
			<div class="col-lg-3">
			</div>
		</div>
	</div>

@endsection('body')

<!-- Modal -->
<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: right;">
      	<form action="{{ route('categoryform') }}" method="post">
      		{{  csrf_field() }}
	        <input type="text" name="category_name" style="width: 100%; margin-bottom: 20px; border-radius: 10px; border: 1px solid black; height: 35px; font-size: 20px; outline: none; padding-left: 10px; padding-right: 10px;" required="true" placeholder="Enter Category Name...">
	      	<button type="button" class="btn btn-secondary" data-dismiss="modal" style="height: 40px;">Close</button>
	        <button class="btn btn-primary" type="submit" style="height: 40px;">Save changes</button>
	    </form>
      </div>
    </div>
  </div>
</div>