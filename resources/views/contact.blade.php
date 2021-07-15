@extends('layout/cusmaster')
@section('body')

<section class="blog-banner-area" id="category">
		<div class="container-fluid">
			<div class="blog-banner">
				<div class="text-center" style="padding-top: 32px;">
					<h1>Contact</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
          	</nav>
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
	<!-- ================ contact section start ================= -->
  <section class="section-margin--small">
    <div class="container">
      <div class="d-none d-sm-block mb-5 pb-4">
      <div class="row">
        <div class="col-md-8 col-lg-12">
          <form action="{{ route('contactform') }}" class="form-contact contact_form" method="post">
          	{{ csrf_field() }}
            <div class="row">
              <div class="col-lg-5">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example@gmail.com" placeholder="Enter email address" required>
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject" required="true">
                </div>
              </div>
              <div class="col-lg-7">
                <div class="form-group">
                    <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5" placeholder="Enter Message" required></textarea>
                </div>
              </div>
            </div>
            <div class="form-group text-center text-md-right mt-3">
              <button type="submit" class="button button--active button-contactForm">Send Email</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->

@endsection('body')