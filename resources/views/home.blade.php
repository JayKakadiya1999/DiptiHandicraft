@extends('layout/cusmaster')
@section('body')

	<main class="site-main">
    
    <!--================ Hero banner start =================-->
    <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="jadhmarinujadvu.jpg" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
              <h1 style="font-size: 26px; margin-right: -15px; margin-bottom: 20px;">Crafters do not make mistakes...</h1>
              <h1 style="font-size: 26px; margin-right: -15px; margin-bottom: 30px;">They just add a new "design element" </h1>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero banner start =================-->

    <!--================ Hero Carousel start =================-->
    <section class="section-margin mt-0">
      <div class="owl-carousel owl-theme hero-carousel">
        <div class="hero-carousel__slide">
          <img src="phote_hanging.jpg" alt="" class="img-fluid" style="height: 500px;">
          <a href="#" class="hero-carousel__slideOverlay">
            <h3>Photo Hanging</h3>
          </a>
        </div>
        <div class="hero-carousel__slide">
          <img src="cusion_cover.jpg" alt="" class="img-fluid" style="height: 500px;">
          <a href="#" class="hero-carousel__slideOverlay">
            <h3>Cusion Cover</h3>
          </a>
        </div>
        <div class="hero-carousel__slide">
          <img src="wallpiece.jpg" alt="" class="img-fluid" style="height: 500px;">
          <a href="#" class="hero-carousel__slideOverlay">
            <h3>Wall Piece</h3>
          </a>
        </div>
      </div>
    </section>
    <!--================ Hero Carousel end =================-->

  </main>




@endsection('body')