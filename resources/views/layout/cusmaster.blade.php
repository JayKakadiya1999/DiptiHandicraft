<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dipti Handicraft</title>
  <link rel="shortcut icon" href="LOGO_1.jpg" type="image/x-icon">
	<link rel="icon" href="" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h"><img src="LOGO_1.jpg" alt="" style="height: 78px; width: 78px; margin-right: 150px;"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto ml-auto">
              <li class="nav-item"><a class="nav-link" href="home">Home</a></li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Products</a>
                  <?php 
                    use Illuminate\Support\Facades\DB;
                    $category = DB::table('category')->get();
                  ?>
                <ul class="dropdown-menu">
                  @foreach($category as $row)
                  <form action="{{ route('categoryproduct') }}" method="post">
                    {{  csrf_field() }}
                    <input type="text" name="id" style="display: none;" value="{{ $row->Category_id }}">
                    <li class="nav-item"><button class="nav-link" style="width: 200px; border: none; background-color: white;">{{ $row->Category_name }}</button></li>
                  </form>
                  @endforeach
                </ul>
							</li>
              <li class="nav-item"><a class="nav-link" href="aboutus">About Us</a></li>
              <li class="nav-item"><a class="nav-link" href="contact">Contact</a></li>
              <li class="nav-item" style="font-size: 30px;margin-top: 20px;"><a class="fas fa-shopping-cart" href="showcart"></a></li>
              <li class="nav-item submenu dropdown" style="margin-top: 20px; font-size: 30px; margin-right: 60px;">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" style="padding: 0;" 
                  aria-expanded="false"><i class="fa fa-bars" style="color: gray !important;"></i></a>
                <ul class="dropdown-menu" style="margin-right: 20px;">
                    <?php
                      if (session()->has('activeuser'))
                      {
                    ?>
                      <div style="text-align: left;">
                          <li class="nav-item"><a class="nav-link" href="profile" style="width: 200px; border: none; background-color: white;">Profile</a></li>
                      </div>
                      <div style="text-align: left;">
                          <li class="nav-item"><a class="nav-link" href="mypurchaseorder" style="width: 200px; border: none; background-color: white;">My Orders</a></li>
                      </div>
                      <div style="text-align: left;">
                          <li class="nav-item"><a class="nav-link" href="changepwd" style="width: 200px; border: none; background-color: white;">Change Password</a></li>
                      </div>
                      <div style="text-align: left;">
                          <li class="nav-item"><a class="nav-link" href="logout" style="width: 200px; border: none; background-color: white;">LogOut</a></li>
                      </div>
                    <?php
                      }
                      else
                      {
                    ?>
                          <li class="nav-item"><a class="nav-link" href="login" style="width: 200px; border: none; background-color: white;">Login</a></li>
                    <?php
                      }
                    ?>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->

  @yield('body')

  <!--================ Start footer Area  =================-->  
<footer>
    <div class="footer-area footer-only" style="padding: 35px 0 35px 0 !important;">
      <div class="container">
        <div class="row section_gap">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="single-footer-widget tp_widgets " style="text-align: center;">
              <h4 class="footer_title large_title">Address</h4>
              <p style="font-size: 25px;">
                45,<br>
                Anjana Park Society,<br>
                Hirawadi Road,<br>
                Ahmedabad 382345. <br>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6" style="text-align: center;">
            <div class="single-footer-widget tp_widgets ">
              <h4 class="footer_title large_title">Call Us</h4>
              <p style="font-size: 25px;">
                Office: 079-22771149<br>
                Mobile: +91-9714796281
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6"  style="text-align: center;">
            <div class="single-footer-widget tp_widgets ">
              <h4 class="footer_title large_title">Email Us</h4>
              <p style="font-size: 25px;">
                  info@diptihandicraft.com<br>
                  sales@diptihandicraft.com
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row d-flex">
          <p class="col-lg-12 footer-text text-center">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Dipti Handicraft Co.Pvt.Ltd.All Rights Reserved.
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </div>
  </footer>
  <!--================ End footer Area  =================-->


  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/esm/popper.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>

  <script type="text/javascript">
    function citydata()
    {
      $('#state').on('change',function(e)
        {

          console.log(e);
          var state_id = e.target.value;
          $.get('json-city?state_id=' + state_id,function(data)
          {
            console.log(data);


            $('#city').empty();
            $('#city').append('<option value="0" disabled="true" selected="true">== Select City ==</option>');

            $.each(data,function(index,cityObj)
            {
              //$('.city').html("");
              $('#city').append('<option value="' + cityObj.City_id + '">' + cityObj.City_name + '</option>');
            });
          });
        });
    };
  </script>

<!-- <script type="text/javascript">
  function chkinternet()
  {
    if(navigator.onLine)
    {
    }
    else
    {
      alert("Ooops!!You Are Now Offline...!");
    }
  }
</script> -->


<script type="text/javascript">
  function rating(rate)
  {
    document.getElementById('rates').value = rate;
  }
</script>


<!-- For download Invoice -->
<script type="text/javascript">
function generatePDF(){

const element=document.getElementById("invoice");

html2pdf()
.from(element)
.save();
}
</script>

</body>
</html>