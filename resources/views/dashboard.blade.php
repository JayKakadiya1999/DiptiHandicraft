@extends('layout/Master')
@section('body')
<?php 
	use App\Users;
	use Illuminate\Support\Facades\DB;
 ?>

 <div class="container-fluid">
 	<div class="container-fluid">
 		<div class="row" style="margin-bottom: 30px;">
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-users background_round"></i>
							<p>Total Users</p>
							<?php
								$users = DB::table('user')
										->where('User_type_id','=','1')
										->count();
							?>
							<h5>{{ $users }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-cart-arrow-down background_round"></i>
							<p>New Orders</p>
							<?php
								$neworder = DB::table('sales_order')
												->where('Order_status','=','Pending')
												->count();
							?>
							<h5>{{ $neworder }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px;height: 120px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-spinner background_round"></i>
							<p>Processing Orders</p>
							<?php
								$procorder = DB::table('sales_order')
												->where('Order_status','=','Processing')
												->count();
							?>
							<h5>{{ $procorder }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-shopping-cart background_round"></i>
							<p>Sales Orders</p>
							<?php
								$salecorder = DB::table('sales_order')
												->where('Order_status','=','Complete')
												->count();
							?>
							<h5>{{ $salecorder }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>

		</div>

		<div class="row" style="margin-bottom: 30px;">
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-arrow-left background_round"></i>
							<p>Sales Return</p>
							<?php
								$returns = DB::table('sales_return')
										->count();
							?>
							<h5>{{ $returns }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-product-hunt"></i>
							<p>Total Products</p>
							<?php
								$ttlpro = DB::table('product')
												->count();
							?>
							<h5>{{ $ttlpro }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-copyright"></i>
							<p>Categories</p>
							<?php
								$cat = DB::table('category')
									->count();
							?>
							<h5>{{ $cat }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-user-circle-o"></i>
							<p>Employees</p>
							<?php
								$emp = DB::table('employee')
									->count();
							?>
							<h5>{{ $emp }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>

		</div>

		<div class="row" style="margin-bottom: 30px;">
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-user-circle"></i>
							<p>Supplier</p>
							<?php
								$sup = DB::table('supplier')
										->count();
							?>
							<h5>{{ $sup }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px;height: 120px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-plus-square"></i>
							<p>Purchase Orders</p>
							<?php
								$purchase = DB::table('purchase_order')
											->count();
							?>
							<h5>{{ $purchase }}</h5>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3 col-lg-3 col-12">
 				<div style="border: 2px solid black;border-radius: 10px;height: 120px">
 					<div class="row" style="padding-bottom: 21px;text-align: center;">
 						<div class="col-md-6 col-lg-6 col-6" >
 							<i class="fa fa-arrow-right"></i>
							<p>Purchase Return</p>
							<?php
								$purreturn = DB::table('purchase_return')
											->count();
							?>
							<h5>0</h5>
 						</div>
 					</div>
 				</div>
 			</div>

		</div>

 	</div>
 </div>

@endsection('body')