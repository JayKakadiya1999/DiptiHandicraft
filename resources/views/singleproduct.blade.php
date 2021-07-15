@extends('layout/cusmaster')
@section('body')
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				@foreach($data as $row)
					<div class="col-lg-6">
						<div class="owl-carousel owl-theme s_Product_carousel">
							<div class="single-prd-item">
								<img class="img-fluid" src="{{ $row->Path }}" alt="" style="height: 400px;">

							</div>
						</div>
					</div>
					<div class="col-lg-5 offset-lg-1">
						<div class="s_product_text" style="margin-top: 13px;">
							<h3>{{ $row->Product_name }}</h3>
							<h2>₹{{ $row->Price }}</h2>
							<ul class="list">
								<li><a class="active" href="#"><span>Category</span> : {{ $row->Category_name }}</a></li>
								<li><a href="#"><span>Availibility</span>
								 : 

								 @if($row->Qty == 0)
								 	<span>Out Of Stock</span>
								 
								 @else
								 
								 	<span> In Stock</span>
								 @endif

								<li><a class="active" href="#"><span>Discount</span> : <b>₹{{ $row->Discount }}</b></a></li>
							</ul>

							<p>
								<span style="color: black;">Description :</span><br>
								{{ $row->Discription }}
							</p></br>
							<div>
								<form action="{{ route('addtocart') }}" method="post">
									{{ csrf_field() }}
									<input type="text" name="id" value="{{ $row->Product_id }}" style="display: none;">
									<button type="submit" class="button primary-btn">Add to Cart</button> 
								</form>          
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<div class="button primary-btn" style="border-radius: 25px; width: 160px; height: 50px;">Ratings</div>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					@foreach($data as $rows)
					<div class="row">
						<div class="col-lg-12">
							<div class="row total_rate">
								<div class="col-12 mb-3">
									<div class="box_total"> 
										<h5>Overall</h5>
										<?php
			                            $product_id = $rows->Product_id;
			                            $ratingdata = DB::table('rating')
			                                            ->where('Product_id','=',$product_id)
			                                            ->get();
			                            $totalrating = count($ratingdata);
			                            $five = 0;
			                            $four = 0;
			                            $three = 0;
			                            $two = 0;
			                            $one = 0;
			                            $outofrate = 0; 
			                            foreach ($ratingdata as $row)
			                            {
			                                $rate = $row->Rating_value;
			                                if($rate == 1)
			                                {
			                                    $outofrate = $outofrate + 1;
			                                    $one = $one + 1;
			                                }
			                                elseif ($rate == 2)
			                                {
			                                    $outofrate = $outofrate + 2;
			                                    $two = $two + 1;
			                                }
			                                elseif ($rate == 3)
			                                {
			                                    $outofrate = $outofrate + 3;
			                                    $three = $three + 1;
			                                }
			                                elseif ($rate == 4)
			                                {
			                                    $outofrate = $outofrate + 4;
			                                    $four = $four + 1;
			                                }
			                                elseif($rate == 5)
			                                {
			                                    $outofrate = $outofrate + 5;
			                                    $five = $five + 1;
			                                }
			                            }
			                            if ($totalrating != 0)
			                            {
			                                $onerate = (int)($one / $totalrating * 100);
			                                $tworate = (int)($two / $totalrating * 100);
			                                $threerate = (int)($three / $totalrating * 100);
			                                $fourrate = (int)( $four / $totalrating * 100);
			                                $fiverate = (int)($five / $totalrating * 100);
			                                $outofrate = (int)($outofrate / $totalrating);
			                            }
			                        ?>
				        		@if($totalrating != null)
				        		<div class="row">
				        			<div class="col-lg-12">
										<div style="border: 1px solid black; margin-top: 10px; padding-left: 10px; padding-bottom: 10px;">
											<span style="font-weight: bold;font-size: 20px;">{{ $outofrate }} out of 5 star</span><br>
											{{ $totalrating }} customer ratings<br>
											<div class="row">
												<div class="col-lg-2" style="padding-right: 0;">
													<span style="color: blue;">5 star</span>
												</div>
												<div class="col-lg-7" style="padding: 0; margin-top: 5px;">
													<div class="progress">
													  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
													  aria-valuemin="0" aria-valuemax="100" style="width:{{ $fiverate }}%">
													    <span style="color: black;">{{ $fiverate }}%</span>
													  </div>
													</div>
												</div>
												<div class="col-lg-2" style="padding: 0; text-align: right;">
													{{ $fiverate }}%
												</div>
											</div>
											<div class="row">
												<div class="col-lg-2" style="padding-right: 0;">
													<span style="color: blue;">4 star</span>
												</div>
												<div class="col-lg-7" style="padding: 0; margin-top: 5px;">
													<div class="progress">
													  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
													  aria-valuemin="0" aria-valuemax="100" style="width:{{ $fourrate }}%">
													    <span style="color: black;">{{ $fourrate }}% </span>
													  </div>
													</div>
												</div>
												<div class="col-lg-2" style="padding: 0; text-align: right;">
													{{ $fourrate }}%
												</div>
											</div>
											<div class="row">
												<div class="col-lg-2" style="padding-right: 0;">
													<span style="color: blue;">3 star</span>
												</div>
												<div class="col-lg-7" style="padding: 0; margin-top: 5px;">
													<div class="progress">
													  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
													  aria-valuemin="0" aria-valuemax="100" style="width:{{ $threerate }}%">
													    <span style="color: black;">{{ $threerate }}%</span>
													  </div>
													</div>
												</div>
												<div class="col-lg-2" style="padding: 0; text-align: right;">
													{{ $threerate }}%
												</div>
											</div>
											<div class="row">
												<div class="col-lg-2" style="padding-right: 0;">
													<span style="color: blue;">2 star</span>
												</div>
												<div class="col-lg-7" style="padding: 0; margin-top: 5px;">
													<div class="progress">
													  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
													  aria-valuemin="0" aria-valuemax="100" style="width:{{ $tworate }}%">
													    <span style="color: black;">{{ $tworate }}%</span>
													  </div>
													</div>
												</div>
												<div class="col-lg-2" style="padding: 0; text-align: right;">
													{{ $tworate }}%
												</div>
											</div>
											<div class="row">
												<div class="col-lg-2" style="padding-right: 0;">
													<span style="color: blue;">1 star</span>
												</div>
												<div class="col-lg-7" style="padding: 0; margin-top: 5px;">
													<div class="progress">
													  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
													  aria-valuemin="0" aria-valuemax="100" style="width:{{ $onerate }}%">
													   	<span style="color: black;">{{ $onerate }}%</span>
													  </div>
													</div>
												</div>
												<div class="col-lg-2" style="padding: 0; text-align: right;">
													{{ $onerate }}%
												</div>
											</div>	
										</div>
									</div>
								</div>
								@endif
									</div>
								</div>
							</div>
							<div class="review_list">
								<div class="review_item">
									<?php
					        			$id = $rows->Product_id;
				                        $feedback = DB::table('feedback')
				                                    ->join('user','feedback.User_id','=','user.User_id')
				                                    ->where('feedback.Product_id','=',$id)
				                                    ->get();
	                    			?> 
	                    			@if($feedback != null)
			                            <div class="review">
			                            	<h1 style="text-align: center;color: blue;">Reviews</h1>
			                                @foreach($feedback as $row)
			                                <div>
			                                	<div class="blog-banner-area" style="margin-top: 10px; width: 100%">
			                                    	<h5 style="color: blue;margin-left: 20px;">By {{ $row->Name }}</h5>
			                                    	<span style="color: red;margin-left: 20px;"><b>Verified Purchase</b></span>
			                                    	<p style="color: black;margin-left: 20px;">{{ $row->Description }}</p>
			                                    </div>
			                                </div>        
			                                @endforeach
			                            </div>
			                        @endif
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>



@endsection('body')