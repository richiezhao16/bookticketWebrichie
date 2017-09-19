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
	<style>
		table{
		border: 2px solid black;
		text-align: center;
		} 
		tr:nth-child(even){background-color: #f2f2f2}"
	</style>
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
if(isset($_POST['cctype'])) {
	$_SESSION['flight']['ccdetail']['cctype'] = $_POST['cctype'];
	$_SESSION['flight']['ccdetail']['ccno'] = $_POST['ccno'];
	$_SESSION['flight']['ccdetail']['ccname'] = $_POST['ccname'];
	$_SESSION['flight']['ccdetail']['ccmonth'] = $_POST['ccmonth'];
	$_SESSION['flight']['ccdetail']['ccyear'] = $_POST['ccyear'];
	$_SESSION['flight']['ccdetail']['cvc'] = $_POST['cvc'];
}
?>

<h1>Complete Booking 3.Review Bookings and Details</h1>
<div class="col-lg-8">
<h3>Booking Details</h3>
<table class='table table-striped table-hover'>
<thead style="background-color: #3976E0; color: white"><tr><th>Route No</th><th>From</th><th>Destination</th><th>Price</th><th>Seats</th><th>Childs</th><th>Wheelchairs</th><th>Special Diets</th><th>Total Price</th></tr></thead>
<tbody>
<?php
$totalseat = $totalchild = $totalwheel = $totaldiet = $totalprice = 0;
foreach($_SESSION['flight']['booking'] as $val) {
	echo "<tr><td>{$val['route_no']}</td><td>{$val['from_city']}</td><td>{$val['to_city']}</td>".
		"<td>\${$val['price']}</td><td>{$val['seats']}</td><td>{$val['childs']}</td>".
		"<td>{$val['wheels']}</td><td>{$val['diets']}</td><td>\${$val['totalprice']}</td></tr>";
	$totalseat += $val['seats'];
	$totalchild += $val['childs'];
	$totalwheel += $val['wheels'];
	$totaldiet += $val['diets'];
	$totalprice += $val['totalprice'];
}

echo "<tr><td><b>Total</b></td><td></td><td></td><td></td><td>$totalseat</td><td>$totalchild</td>".
	"<td>$totalwheel</td><td>$totaldiet</td><td>\$$totalprice</td></tr></tbody></table>";
?>
</tbody></table>
</div>
<div class="col-lg-6">
<h3>Personal Details</h3>
<?php
$ccno = "";
$cclength = strlen($_SESSION['flight']['ccdetail']['ccno'])-4;
for($i=0;$i<$cclength;$i++) {
	$ccno .= "*";
}
$ccno .= substr($_SESSION['flight']['ccdetail']['ccno'],-4);

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
	"<tr><td><b>Work Phone No.</b></td><td>{$_SESSION['flight']['personal']['workno']}</td></tr>".
	"<tr><td><b>Credit Card No.</b></td><td>$ccno</td></tr></table>";
?>
<br />
<form method='post' action='checkout4.php'onsubmit='return confirmSubmit();'>
	<div class='form-group'>
	<button type="submit" class="btn3">Confirm Payment</button>
	</div>
</form>
</div>
</div>
<script type="text/javascript">
function confirmSubmit() {
	return confirm("Are you sure your details is correct and confirm to pay?");
}
</script>
</body>
</html>
</body>
</html>