@extends('layout/cusmaster')
@section('body')

	<?php 
	use Illuminate\Support\Facades\DB;
?>

	<div class="container">
		<h1 style="color: #002347; margin-bottom: 0px; text-align: center">My Order</h1>
		<div style="text-align: center">
  			<hr style="border: 2px solid blue; margin-top: 5px; width: 100%">
		</div>
		<div class="row" style="margin-top: 80px; margin-bottom: 20px;">
			@foreach($data as $row)
				
				<?php
					$valid = DB::table('sales_return')
								->where('Sales_order_id','=',$row->Sales_order_id)
								->get();
				?>
				
		</div>
		<h3>
			Order Date : {{ date('d/m/Y',strtotime($row->Order_date)) }}<br>
			Total Amount : ₹ {{ $row->Total_amount }}
		</h3><br>
		@if($days <= 15)
					@if($valid == null)
					<div style="text-align: right;">
						<form action="{{ route('returnproducts') }}" method="post">
							{{ csrf_field() }}
							<input type="text" name="id" style="display: none;" value="{{ $row->Sales_order_id }}">
							<button class="btn btn-primary" style="text-align:right; margin-right: 0px; margin-top: 0px;">Return Products</button>
						</form>
					</div>
					@endif
				@endif
				<?php
					$id = $row->Sales_order_id;
					$amount = 0;
					$items = DB::table('sales_order')
								->join('sales_order_details','sales_order.Sales_order_id','=','sales_order_details.Sales_order_id')
								->join('product','sales_order_details.Product_id','=','product.Product_id')
								->join('image','product.Product_id','=','image.Product_id')
								->where('sales_order.Sales_order_id','=',$id)
								->get();
					foreach ($items as $rows)
					{
				?>
						<div class="row my-3" style="border: 1px solid black; padding: 10px; border-radius: 25px;">
							<div class="col-lg-3">
		        				<div class="product-card" style="text-align: left;">
		        					<img src="{{ $rows->Path }}" class="img-fluid product-img" style="width: 250px; height: 250px;"> 
		        				</div>
		        			</div>
		        			<div class="col-lg-4">
		        			<h4>
							Order Date : {{ date('d/m/Y',strtotime($rows->Order_date)) }}<br>
							Total Amount : ₹ {{ $rows->Total_amount }}
							</h4><br>
		        				<h1 style="color: #3f4b5d;">{{ $rows->Product_name }}</h1>
		        				<h5 style="color: #B12704;">
			                       
			                        @if($rows->Price != null)
			                            Price : ₹ {{ $rows->Price }} * {{ $rows->Quantity }} = 
			    <?php 
			        				echo "₹ ".$rows->Price * $rows->Quantity;
			    ?>
			                        @endif                      
		                    </h5>
		                    <h5>
		                    	Quantity : {{ $rows->Quantity }}<br>
		                    	Discount : {{ $rows->Discount * $rows->Quantity }}
		                    </h5>
		                    <form action="{{ route('giverating') }}" method="post">
		                    	{{ csrf_field() }}
		                    	<input type="text" name="id" value="{{ $rows->Product_id }}" style="display: none;">
		                    	<button class="btn btn-success" style="margin-top: 92px;">Give Rating</button>
		                    </form>
		        		</div>
		        		<div class="col-lg-5">
		        			<!-- Rating -->
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
							<!-- Rating -->
		        		</div>
		        		<div class="col-lg-12 ml-5 mt-2">
		        			<form action="{{ route('feedback') }}" method="post">
		        				{{ csrf_field() }}
		                    	<h3>Feedback :</h3>
		                    	<input type="text" name="feedback" style="width: 90%; border: 1px solid black; border-radius: 25px; outline: none; padding: 6px 15px 6px 15px; font-size: 20px;" placeholder="Enter Your Feedback...">
		                    	<input type="text" name="product_id" value="{{ $rows->Product_id }}" style="display: none;">
		                    	<button class="btn btn-primary" style="margin-left: 900px; margin-top: 10px;">Submit</button>
		                    </form>
		        		</div>

		        		<?php
		        			$id = $rows->Product_id;
	                        $feedback = DB::table('feedback')
	                                    ->join('user','feedback.User_id','=','user.User_id')
	                                    ->where('feedback.Product_id','=',$id)
	                                    ->get();
	                    ?>  
	                    <div class="col-lg-12">
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
				<?php	
					}
				?>
			@endforeach
	</div>

@endsection('body')