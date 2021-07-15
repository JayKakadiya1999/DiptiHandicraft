@extends('layout/Master')
@section('body')
<?php 
	use Illuminate\Support\Facades\DB;
?>

	<div class="container">
		<div class="row">
			@foreach($data as $row)
				<h1>
					Order Date : {{ date('d/m/Y',strtotime($row->Order_date)) }}<br>
					Total Amount : ₹ {{ $row->Total_amount }}
				</h1><br>
				<form action="returnproductsform" method="post">
					{{ csrf_field() }}
					<input type="text" name="sales_order_id" value="{{ $row->Sales_order_id }}" style="display: none;">
					<div class="row">
						<?php
							$id = $row->Sales_order_id;
							$amount = 0;
							$items = DB::table('sales_order')
										->join('sales_order_details','sales_order.Sales_order_id','=','sales_order_details.Sales_order_id')
										->join('product','sales_order_details.Product_id','=','product.Product_id')
										->join('image','product.Product_id','=','image.Product_id')
										->where('sales_order.Sales_order_id','=',$id)
										->get();
						?>
							@foreach($items as $row)
								<div class="row my-3" style="border: 1px solid black; padding: 10px; border-radius: 25px; width: 100%;">
									<div class="col-lg-3">
				        				<div class="product-card" style="text-align: left;">
				        					<img src="{{ $row->Path }}" class="img-fluid product-img" style="width: 250px; height: 250px;"> 
				        				</div>
				        			</div>
				        			<div class="col-lg-9">
				        				<input type="text" name="product_id[]" value="{{ $row->Product_id }}" style="display: none;">
				        				<input type="text" name="pro_dis[]" value="{{ $row->Discount }}" style="display: none;">
					        				<h1 style="color: #3f4b5d;">{{ $row->Product_name }}</h1>
					        				<h5 style="color: #B12704;">
						                        Discount : {{ $row->Discount * $row->Quantity }}<br>
						                        Price : ₹ {{ $row->Price }} * {{ $row->Quantity }} = 
						    <?php 
						        				echo "₹ ".$row->Price * $row->Quantity;
						    ?>                     
					                    </h5>
					                    <h5>
					                    	Quantity : {{ $row->Quantity }}
					                    </h5>
					                    <h5>
					                    	Select quantity which you want to return:
						                    <select name="qty[]" style="border-radius: 0; outline: none; width: 50px;">
						                    		<option value="0" selected>0</option>
						                    	<?php
						                    		for ($i=1; $i < $row->Quantity + 1; $i++)
						                    		{
						                    	?>
						                    		<option value="{{ $i }}"><?php echo $i; ?></option> 
						                    	<?php		
						                    		}
						                    	?>
						                    	
						                    </select>
						                </h5>
						                <h5>
						                	<b>Reason:</b><input type="text" name="reason[]" style="border-radius: 10px; width: 100%; border: 1px solid gray; outline: none; height: 30px; padding: 0 10px 0 10px;" placeholder="Enter Your Reason...">
						                </h5>	            
					        		</div>
				        		</div>
							@endforeach
					</div>
					<button class="btn btn-success" style="margin-bottom: 10px; margin-left: 1022px;">Return Order</button>
				</form>
			@endforeach
		</div>
	</div>


@endsection('body')