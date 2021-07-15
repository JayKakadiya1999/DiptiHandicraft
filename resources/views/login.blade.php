@extends('layout/cusmaster')
@section('body')



  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container">
			<div class="blog-banner">
				<div class="text-center" style="padding-top: 32px;">
					<h1>Login</h1>
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
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>New to our website?</h4>
							<a class="button button-account" href="registration">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="{{route('loginform') }}" style="margin-top: 150px;" method="post">
							{{  csrf_field() }}
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="Email" name="email" placeholder="Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example@gmail.com">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">Log In</button>
								<a href="forgotpwd">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

@endsection('body')