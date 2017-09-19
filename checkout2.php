<!doctype html>
<?php
include 'dbconn.php';
session_start();
$page = end(explode('/',$_SERVER['PHP_SELF']));
if(isset($_POST['fname'])) {
	$_SESSION['flight']['personal']['fname'] = $_POST['fname'];
	$_SESSION['flight']['personal']['lname'] = $_POST['lname'];
	$_SESSION['flight']['personal']['address1'] = $_POST['address1'];
	$_SESSION['flight']['personal']['address2'] = $_POST['address2'];
	$_SESSION['flight']['personal']['suburb'] = $_POST['suburb'];
	$_SESSION['flight']['personal']['state'] = $_POST['state'];
	$_SESSION['flight']['personal']['postcode'] = $_POST['postcode'];
	$_SESSION['flight']['personal']['country'] = $_POST['country'];
	$_SESSION['flight']['personal']['email'] = $_POST['email'];
	$_SESSION['flight']['personal']['mobileno'] = $_POST['mobileno'];
	$_SESSION['flight']['personal']['businessno'] = $_POST['businessno'];
	$_SESSION['flight']['personal']['workno'] = $_POST['workno'];
}
?>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="css/home.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color: #D9D9D9">

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
<div class="container">
<?php
echo "<table><tr><td><b>Given Name</b></td><td>{$_SESSION['flight']['personal']['fname']}</td></tr>".
	"<tr><td><b>Last Name</b></td><td>{$_SESSION['flight']['personal']['lname']}</td></tr>".
	"<tr><td><b>Address Line 1</b></td><td>{$_SESSION['flight']['personal']['address1']}</td></tr>".
	"<tr><td><b>Address Line 2</b></td><td>{$_SESSION['flight']['personal']['address2']}</td></tr>".
	"<tr><td><b>Suburb</b></td><td>{$_SESSION['flight']['personal']['suburb']}</td></tr>".
	"<tr><td><b>State</b></td><td>{$_SESSION['flight']['personal']['state']}</td></tr>".
	"<tr><td><b>Postcode</b></td><td>{$_SESSION['flight']['personal']['postcode']}</td></tr>".
	"<tr><td><b>Country</b></td><td>{$_SESSION['flight']['personal']['country']}</td></tr>".
	"<tr><td><b>Email Address</b></td><td>{$_SESSION['flight']['personal']['email']}</td></tr>".
	"<tr><td><b>Mobile Phone No.</b></td><td>{$_SESSION['flight']['personal']['mobileno']}</td></tr>".
	"<tr><td><b>Business Phone No.</b></td><td>{$_SESSION['flight']['personal']['businessno']}</td></tr>".
	"<tr><td><b>Work Phone No.</b></td><td>{$_SESSION['flight']['personal']['workno']}</td></tr></table>";
?>

<form class="form-horizontal" method="post" action="checkout3.php" onsubmit="return validate();">
	<fieldset>
		<legend>Payment Details</legend>
		<div class="form-group">
			<div class="col-lg-12">
			<p style="color:red;">This payment only accept credit card.</p>
			</div>
		</div>
		<div class="form-group">
			<label for="cctype" class="col-lg-2 control-label">Credit Card Type<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<select class="select2" id="cctype" name="cctype">
			<option>--</option>
			<option>Mastercard</option>
			<option>Visa</option>
			<option>Amex</option>
			<option>Diners</option>
			</select>
			</div>
		</div>
		<div class="form-group">
			<label for="ccno" class="col-lg-2 control-label">Credit Card No.<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="ccno" name="ccno" placeholder="Credit Card No.">
			</div>
		</div>
		<div class="form-group">
			<label for="ccname" class="col-lg-2 control-label">Credit Card Name<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="ccname" name="ccname" placeholder="Credit Card Name">
			</div>
		</div>
		<div class="form-group">
			<label for="ccmonth" class="col-lg-2 control-label">Expiry Month<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<select class="select2" id="ccmonth" name="ccmonth">
			<option>--</option>
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			<option>6</option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
			</select>
			</div>
		</div>
		<div class="form-group">
			<label for="ccyear" class="col-lg-2 control-label">Expiry Year<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<select class="select2" id="ccyear" name="ccyear">
			<option>--</option>
			<?php
			$year = date("Y");
			for($i=0;$i<11;$i++) {
				echo "<option>".($year+$i)."</option>";
			}
			?>
			</select>
			</div>
		</div>
		<div class="form-group">
			<label for="cvc" class="col-lg-2 control-label">Security Code<span style="color:red">*</span></label>
			<div class="col-lg-10">
			<input type="text" class="input1" id="cvc" name="cvc" placeholder="Security Code">
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
			<button type="submit" class="btn3">Bookings and Details</button>
			</div>
		</div>
	</fieldset>
</form>
</div>
</div>
<script type="text/javascript">
function validate() {
	var regex = /^\d+$/;
	var today = new Date();
	var ccdate = new Date(document.getElementById("ccyear").value,document.getElementById("ccmonth").value,1);
	if(document.getElementById("cctype").value == "--") {
		alert("Please select your credit card type.");
		return false;
	}
	
	if(document.getElementById("ccno").value == "") {
		alert("Please input your credit card number.");
		return false;
	}
	
	if(!regex.test(document.getElementById("ccno").value)) {
		alert("Please input a valid credit card number.");
		return false;
	}
	
	if(document.getElementById("ccno").value.length < 12) {
		alert("Please input a valid credit card number.");
		return false;
	}
	
	if(document.getElementById("ccname").value == "") {
		alert("Please input your name on credit card.");
		return false;
	}
	
	if(document.getElementById("ccmonth").value == "--") {
		alert("Please input your credit card expiry month.");
		return false;
	}
	
	if(document.getElementById("ccyear").value == "--") {
		alert("Please input your credit card expiry year.");
		return false;
	}
	
	if(document.getElementById("cvc").value == "") {
		alert("Please input your credit card security code.");
		return false;
	}
	
	if(!regex.test(document.getElementById("cvc").value) || document.getElementById("cvc").value.length > 3) {
		alert("Please input a valid credit card security code.");
		return false;
	}
	
	if(ccdate < today) {
		alert("Your credit card is expired.");
		return false;
	}
	
	return true;
}
</script>
</body>
</html>
	