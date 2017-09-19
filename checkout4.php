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
$email = $_SESSION['flight']['personal']['email'];
$from = "From: no-reply <no-reply@utsflightbooking.com>";
$message = "Thank you, here is your receipt.\n\n\n";

$totalseat = $totalchild = $totalwheel = $totaldiet = $totalprice = 0;
foreach($_SESSION['flight']['booking'] as $val) {
	$message .= "Route no: {$val['route_no']}\n";
	$message .= "From: {$val['from_city']}\n";
	$message .= "Destination: {$val['to_city']}\n";
	$message .= "Price: \${$val['price']}\n";
	$message .= "Seats: {$val['seats']}\n";
	$message .= "Childs: {$val['childs']}\n";
	$message .= "Wheelchairs: {$val['wheels']}\n";
	$message .= "Special Diets: {$val['diets']}\n";
	$message .= "Total Price: \${$val['totalprice']}\n\n";
	
	$totalseat += $val['seats'];
	$totalchild += $val['childs'];
	$totalwheel += $val['wheels'];
	$totaldiet += $val['diets'];
	$totalprice += $val['totalprice'];
}

$message .= "\nTotal Seats: $totalseat\n".
			"Total Childs: $totalchild\n".
			"Total Wheelchairs: $totalwheel\n".
			"Total Special Diets: $totaldiet\n".
			"Total Price: \$$totalprice\n\n\n";

$ccno = "";
$cclength = strlen($_SESSION['flight']['ccdetail']['ccno'])-4;
for($i=0;$i<$cclength;$i++) {
	$ccno .= "*";
}
$ccno .= substr($_SESSION['flight']['ccdetail']['ccno'],-4);

$message .= "Given Name: {$_SESSION['flight']['personal']['fname']}\n".
			"Last Name: {$_SESSION['flight']['personal']['lname']}\n".
			"Address Line 1: {$_SESSION['flight']['personal']['address1']}\n".
			"Address Line 2: {$_SESSION['flight']['personal']['address2']}\n".
			"Suburb: {$_SESSION['flight']['personal']['suburb']}\n".
			"State: {$_SESSION['flight']['personal']['state']}\n".
			"Postcode: {$_SESSION['flight']['personal']['postcode']}\n".
			"Country: {$_SESSION['flight']['personal']['country']}\n".
			"Email Address: $email\n".
			"Mobile Phone No.: {$_SESSION['flight']['personal']['mobileno']}\n".
			"Business Phone No.: {$_SESSION['flight']['personal']['businessno']}\n".
			"Work Phone No.: {$_SESSION['flight']['personal']['workno']}\n".
			"Credit Card No.: $ccno\n\n";

//sent email
mail($email,"Booking Receipt",$message,$from);

//delete session data
session_destroy();
?>
<h1>Payment Confirmed</h1>
<p style="font:italic;font-size:50px">Thank you!</p>
<p style="font: normal;font-size:30px">Your booking has been completed and a receipt has been emailed to your email address.</p>
</div>
</body>
</html>
