@extends('layout/cusmaster')
@section('body')
	<div class="container-fluid">
		<div class="row mt-5">
			@foreach($data as $row)
				<div class="col-lg-3">
	                <div class="card text-center card-product">
	                  <div class="card-product__img">
	                    <img class="card-img" src="{{ $row->Path }}" alt="" style="height: 300px;">
	                    <ul class="card-product__imgOverlay">
	                      <li>
	                      	<form action="{{ route('singleproduct') }}" method="post">
	                      		{{  csrf_field() }}
	                      		<input type="text" name="id" style="display: none;" value="{{ $row->Product_id }}">
	                      		<button type="submit"><i class="fa fa-eye"></i></button></li>
	                      	</form>
	                      <li>
	                      	<form action="{{ route('addtocart') }}" method="post">
								{{ csrf_field() }}
								<input type="text" name="id" value="{{ $row->Product_id }}" style="display: none;">
								<button><i class="ti-shopping-cart"></i></button> 
							</form>
	                      </li>
	                    </ul>
	                  </div>
	                  <div class="card-body">
	                    <h4 class="card-product__title"><a href="#">{{ $row->Product_name }}</a></h4>
	                    <p class="card-product__price">₹{{ $row->Price }}</p>
	                  </div>
	                </div>
	           	</div>
	     	@endforeach
		</div>
	</div>
@endsection('body')