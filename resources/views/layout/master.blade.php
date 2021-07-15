
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dipti Handicraft</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<!-- Favicon -->
  	<link rel="shortcut icon" href="LOGO_1.jpg" type="image/x-icon">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		th
		{
			border: none; border-top: 1px solid black; border-bottom: 1px solid black;
		}
	</style>
	<style type="text/css">
		td
		{
			border: none;
		}
	</style>
</head>
<body>
	<?php
	  		use Illuminate\Support\Facades\DB;
	  	?>
	<div id="main" style="background-color: #0e0b15; color: white;">
		<span style="font-size:30px; cursor:pointer; margin-left: 20px;" id="openbtn" onclick="openNav()">&#9776;</span>
		<span style="margin-left: 530px; font-size: 30px; color: #20c997;">Dipti Handicraft</span>
	</div>
	<div id="mySidenav" class="sidenav" style="border: 2px solid #20c997; background-color: #0e0b15;">
	  <span href="javascript:void(0)" id="closebtn" class="closebtn" onclick="closeNav()" style="color: white; cursor: pointer; margin-right: 10px;">&times;</span>

	  <div class="dashboard">
	  	<div class="dashboard-heading">
	  		Dashboard
	  	</div>
	  	<?php
	  		$activeuser = session()->get('activeuser');
	  		$activeuser = DB::table('user')->where('User_id','=',$activeuser)->lists('Name');
	  		foreach ($activeuser as $row)
	  		{
	  			echo ucwords($row);
	  		}
	  	?>
	  </div>
	  <a href="dashboard" style="">Home</a>
	  <a href="category" style="">Category</a>
	  <a href="product">Products</a>
	  <a href="rawmaterial" style="">Raw Material</a>
	  <button class="dropdown-btn">Purchase Details
	  	<i class="fa fa-caret-down" style="padding-left: 37px;"></i>
	  </button>
	  <div class="dropdown-container">
	  	<a href="addpurchase">Add Purchase Orders</a>
	    <a href="purchase">Purchase Orders</a>
	    <a href="purchasereturn">Return Purchase Orders</a>
	  </div>
	  <button class="dropdown-btn">Sales Details
	  	<i class="fa fa-caret-down" style="padding-left: 67px;"></i>
	  </button>
	  <div class="dropdown-container">
	  	<a href="pendsalesorder" style="">Pending Sales Order</a>
	  	<a href="procesalesorder" style="">Processing Sales Order</a>
	  	<a href="comporder" style="">Complete Sales Order</a>
	  	<a href="salesreturn" style="">Return Sales Order</a>
	  </div>
	  <a href="supplier" style="">Supplier</a>
	  <a href="employee" style="">Employee</a>
	  <a href="logout">Log Out</a>

	</div>


		@yield('body')

	<script>
		function openNav() {
		  document.getElementById("mySidenav").style.width = "250px";
		  document.getElementById("content").style.marginLeft= "250px";
		}

		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		  document.getElementById("content").style.marginLeft= "0";
		}
	</script>


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

	<script type="text/javascript">
		function materialdata()
		{
			$.get('json-material',function(data)
			{
				console.log(data);
				$('.material').empty();
				$('.material').append('<option value="0" disabled="true" selected="true">= Select Material =</option>');
				$.each(data,function(index,materialObj)
				{
					$('.material').append('<option value="' + materialObj.Raw_material_id + '">' + materialObj.Raw_material_name + '</option>');
				});
			});
		};
	</script>

		<script type="text/javascript">
		function productdata()
		{
			$.get('json-product',function(data)
			{
				console.log(data);
				$('.product').empty();
				$('.product').append('<option value="0" disabled="true" selected="true">= Select Product =</option>');
				$.each(data,function(index,productObj)
				{
					$('.product').append('<option value="' + productObj.Product_id + '">' + productObj.Product_name + '</option>');
				});
			});
		};
	</script>

	<script type="text/javascript">
		function citydatas()
		{
			$('#states').on('change',function(e){
				console.log(e);
				var state_id = e.target.value;
				$.get('json-city?state_id=' + state_id,function(data){
					console.log(data);
					$('#city').empty();
					$('#city').append('<option value="0" disabled="true" selected="true">== Select City ==</option>');

					$.each(data,function(index,cityObj){
						$('#city').append('<option value="' + cityObj.City_id + '">' + cityObj.City_name + '</option>');
					});
				});
			});
		};
	</script>

	<script>
		function warning() {
		  alert("This Record ID Use In Another Table So You Can Not Delete Record.")
		}
	</script>

	<script type="text/javascript">
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

		for (i = 0; i < dropdown.length; i++) {
		  dropdown[i].addEventListener("click", function() {
		    this.classList.toggle("active");
		    var dropdownContent = this.nextElementSibling;
		    if (dropdownContent.style.display === "block") {
		      dropdownContent.style.display = "none";
		    } else {
		      dropdownContent.style.display = "block";
		    }
		  });
		}
	</script>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="popper.min.js"></script>
</body>
</html>