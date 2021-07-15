@extends('layout/cusmaster')
@section('body')



  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container">
			<div class="blog-banner">
				<div class="text-center" style="padding-top: 32px;">
					<h1>Change Password</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
          	</nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->

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
  
  <!--================Change Password Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<form class="row login_form" action="{{route('changepwdform') }}" style="margin-top: 0px;" method="post">
							{{  csrf_field() }}	
							@foreach($data as $row)
							<div class="form-group" style="padding-left: 27px">
								<?php
								echo $row->Seq_que; 
								?>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="answer" name="answer" placeholder="Enter Answer" required="true">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" name="pwd" class="form-control" required="true" id="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter Old Password">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" name="newpwd" class="form-control" required="true" id="newpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  placeholder="Enter New Password">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" name="confirmpwd" id="confirmpwd" class="form-control" required="true" title="Password Must Be Match"  placeholder="Confirm Password">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">Change Password</button>
								
							</div>
							@endforeach 
						</form>
					</div>
				</div>
			</div>
				<div class="col-lg-3"></div>
					
				</div>
			</div>
		</div>
	</section>

	
	<!--================ End Change Password Box Area =================-->
	<script>
		var newpassword = document.getElementById("newpwd"),confirmPassword = document.getElementById("confirmpwd");

		function validatePassword()
		{
			if (newpassword.value != confirmPassword.value)
			{
				confirmPassword.setCustomValidity("Password Must Be Same");
			}
			else
			{
				confirmPassword.setCustomValidity('');
			}
		}

		newpassword.onchange = validatePassword;
		confirmPassword.onkeyup = validatePassword;
	</script>

@endsection('body')