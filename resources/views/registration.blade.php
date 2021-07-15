@extends('layout/cusmaster')
@section('body')
  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Register</h1>
				</div>
			</div>
    </div>
	</section>
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
	<!-- ================ end banner area ================= -->
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Already have an account?</h4>
							<a class="button button-account" href="login">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Create an account</h3>

						<form class="row login_form" action="{{route('registrationform') }}" method="post" id="register_form" >
							{{  csrf_field() }}
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="name" placeholder="Name" required="true">
							</div>

							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email Address">
				            </div>

				            <div class="col-md-12 form-group">
								<input type="text" class="form-control" required="true" pattern="^([7-9]{1})([0-9]{9})$" title="Input Valid Number" name="contact" placeholder="Contact">
				            </div>

				            <div class="col-md-12 form-group">
								<input type="password" class="form-control" required="true" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" placeholder="Password">
							</div>

							<div class="col-md-12 form-group">
								<input type="password" id="confirmPassword" class="form-control" required="true"title="Password Must Be Match" name="confirmPassword" placeholder="Confirm Password">
							</div>
							
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="seq_que" placeholder="Security Question" required="true">
			              	</div>
			              	<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="seq_ans" placeholder="Security Answer" required="true">
			              	</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="address" placeholder="Address" required="true">
			              	</div>
			              	<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="area" name="area" placeholder="Area" required="true">
			              	</div>

							
			              	<div class="col-md-12">
			              		<div class="form-group">
									<select class="form-control supplier-dropdown state" name="state" id="state" required="true" onchange="citydata()" title="Select State">
										<option value="0" disabled="true" selected="true">== Select State ==</option>
										@foreach($state as $row)
											<option value="{{ $row->State_id }}">{{ $row->State_name }}</option>
										@endforeach
									</select>
								</div>
			              	</div>

							  
			              	<div class="col-md-12">
			              		<div class="form-group">
									<select class="form-control supplier-dropdown city" name="city" id="city" required="true" title="Select City">
									    <option value="0" disabled="true" selected="true">== Select City ==</option>
									</select>
								</div>
			              	</div>

							<div class="col-md-12 form-group">
								<button type="submit" class="button button-register w-100">Register</button>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	<script>
		var password = document.getElementById("password"),confirmPassword = document.getElementById("confirmPassword");

		function validatePassword()
		{
			if (password.value != confirmPassword.value)
			{
				confirmPassword.setCustomValidity("Password Must Be Same");
			}
			else
			{
				confirmPassword.setCustomValidity('');
			}
		}

		password.onchange = validatePassword;
		confirmPassword.onkeyup = validatePassword;
	</script>

@endsection('body')