<!doctype html>
<?php
include 'dbconn.php';
session_start();
$page = end(explode('/',$_SERVER['PHP_SELF']));
?>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="css/home.css" rel="stylesheet" type="text/css">
</head>
<body <?php if($page == "checkout1.php") echo " onload='showCountries();'"; ?> style="background-color: #D9D9D9">

<nav>

    <a href="home.html" class="airtrip-title">
        Soar Trip
    </a>

    <ul class="nav-links">
      <li><a class="active" href="home.html">Home</a></li>
      <li><a href="search.php">Search Flights</a></li>
      <li><a href="contactus.html">Contact Us</a></li>
      <li><a href="yourbook.php">Your Bookings </a></li>
    </ul>
</nav>
<body>
<div class="container">
<h1>Complete Booking 1.Personal Details</h1>
<form class="form-horizontal" method="post" action="checkout2.php" onsubmit="return validate();">
	<div>
		<h2>Personal Details</h2>
		<div class="form-group">
			<div class="col-lg-12">
			<p style="color:red;">If you are outside Australia then Address Line 2, State, Postcode, and Phone Numbers are optional. Else everything is compulsory.</p>
			</div>
		</div>
		<div class="form-group">
			<label for="fname" class="col-lg-2 control-label">Given Name<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="fname" name="fname" placeholder="Given Name">
			</div>
		</div>
		<div class="form-group">
			<label for="lname" class="col-lg-2 control-label">Family Name<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="lname" name="lname" placeholder="Family Name">
			</div>
		</div>
		<div class="form-group">
			<label for="address1" class="col-lg-2 control-label">Address Line 1<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="address1" name="address1" placeholder="Address Line 1">
			</div>
		</div>
		<div class="form-group">
			<label for="address2" class="col-lg-2 control-label">Address Line 2</label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="address2" name="address2" placeholder="Address Line 2">
			</div>
		</div>
		<div class="form-group">
			<label for="suburb" class="col-lg-2 control-label">Suburb<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="suburb" name="suburb" placeholder="Suburb">
			</div>
		</div>
		<div class="form-group">
			<label for="state" class="col-lg-2 control-label">State</label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="state" name="state" placeholder="State">
			</div>
		</div>
		<div class="form-group">
			<label for="postcode" class="col-lg-2 control-label">Postcode</label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="postcode" name="postcode" placeholder="Postcode">
			</div>
		</div>
		<div class="form-group">
			<label for="country" class="col-lg-2 control-label">Country<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<select class="select2" id="country" name="country">
			<option>--</option>
			</select>
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-lg-2 control-label">Email Address<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="email" name="email" placeholder="Email Address">
			</div>
		</div>
		<div class="form-group">
			<label for="mobileno" class="col-lg-2 control-label">Mobile Phone</label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="mobileno" name="mobileno" placeholder="Mobile Phone No.">
			</div>
		</div>
		<div class="form-group">
			<label for="businessno" class="col-lg-2 control-label">Business Phone</label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="businessno" name="businessno" placeholder="Business Phone No.">
			</div>
		</div>
		<div class="form-group">
			<label for="workno" class="col-lg-2 control-label">Work Phone</label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="workno" name="workno" placeholder="Work Phone No.">
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
			<button style="margin-top: 30px" type="submit" class="btn3">Payment information</button>
			</div>
		</div>
	</div>
</form>
</div>
<script type="text/javascript">
function validate() {
	var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var empty = 0;
	
	if(document.getElementById("fname").value == "") {
		empty++;
	}
	if(document.getElementById("lname").value == "") {
		empty++;
	}
	if(document.getElementById("address1").value == "") {
		empty++;
	}
	if(document.getElementById("suburb").value == "") {
		empty++;
	}
	if(document.getElementById("country").value == "--") {
		empty++;
	}
	if(document.getElementById("email").value == "") {
		empty++;
	}
	
	if(document.getElementById("country").value == "Australia") {
		if(document.getElementById("state").value == "") {
			empty++;
		}
		if(document.getElementById("postcode").value == "") {
			empty++;
		}
	if(empty!=0) {
		alert("Please input compulsory fields.");
		return false;
	}
	
	if(!regex.test(document.getElementById("email").value)) {
		alert("Please input valid email address.");
		return false;
	}
	
	return true;
}

function showCountries() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("country").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "countries.php", true);
	xhttp.send();
}
</script>
</body>
</html>