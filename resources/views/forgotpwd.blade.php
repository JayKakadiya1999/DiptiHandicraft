@extends('layout/cusmaster')
@section('body')



  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container">
			<div class="blog-banner">
				<div class="text-center" style="padding-top: 32px;">
					<h1>Forgot Password</h1>
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
  
  <!--================ Forgot Password Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<form class="row login_form" action="{{route('forgotpwdform') }}" style="margin-top: 0px;" method="post">
							{{  csrf_field() }}
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="Email" name="email" placeholder="Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example@gmail.com">
							</div>
							
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100" onclick="chkinternet()">Send Mail</button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
				<div class="col-lg-3"></div>
					
				</div>
			</div>
		</div>
	</section>
	<!--================End Forgot Password Box Area =================-->

@endsection('body')