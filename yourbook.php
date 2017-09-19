<?php
include 'dbconn.php';
session_start();
$page = end(explode('/',$_SERVER['PHP_SELF']));
?>
<html>
<head>
<style>
	table{
		text-align: center;
	}
	th {
    background-color: #3976E0;
    color: white;
}
	btn4{
	border-radius: 50px;
    margin: 10px;
    width: 150px;
    font-size: 1rem;
    background-color: #3976E0;
    color: #FFFFFF;
	}
	btn4:hover{
		background-color: #1E59C0;
	}
	</style>
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
<h1>Your Bookings</h1>
<?php
if(isset($_POST['route_no'])) {
	if(!isset($_SESSION['flight']['booking'])) {
		$_SESSION['flight']['booking'] = array();
	}
	
	$data['route_no'] = $_POST['route_no'];
	$data['from_city'] = $_POST['from_city'];
	$data['to_city'] = $_POST['to_city'];
	$data['price'] = $_POST['price'];
	$data['seats'] = count($_POST['seats']);
	$data['childs'] = count($_POST['childs']);
	$data['wheels'] = count($_POST['wheels']);
	$data['diets'] = count($_POST['diets']);
	$data['totalprice'] = $data['seats']*$data['price'];
	
	array_push($_SESSION['flight']['booking'],$data);
	echo "<div class='alert alert-dismissible alert-success'>Your booking successfully added.</div>";
}

if(isset($_POST['option']) && $_POST['option'] == 1) {
	foreach($_POST['booked'] as $booked) {
		unset($_SESSION['flight']['booking'][$booked]);
	}
	echo "<div class='alert alert-dismissible alert-success'>Your selected booking successfully deleted.</div>";
}

if(isset($_POST['option']) && $_POST['option'] == 2) {
	unset($_SESSION['flight']['booking']);
	echo "<div class='alert alert-dismissible alert-success'>All your booking successfully deleted.</div>";
}

if(isset($_SESSION['flight']['booking']) && !empty($_SESSION['flight']['booking'])) {
	$totalseat = $totalchild = $totalwheel = $totaldiet = $totalprice = 0;
	
	echo "<form method='post' action='yourbook.php'onsubmit='return confirmDel();'><table class='table table-striped table-hover'><thead>".
		"<tr><th>Route No</th><th>From</th><th>Destination</th><th>Price</th><th>Seats</th><th>Childs</th>".
		"<th>Wheelchairs</th><th>Special Diets</th><th>Total Price</th><th>Delete</th></tr></thead><tbody>";
	
	foreach($_SESSION['flight']['booking'] as $key => $val) {
		echo "<tr><td>{$val['route_no']}</td><td>{$val['from_city']}</td><td>{$val['to_city']}</td>".
			"<td>\${$val['price']}</td><td>{$val['seats']}</td><td>{$val['childs']}</td>".
			"<td>{$val['wheels']}</td><td>{$val['diets']}</td><td>\${$val['totalprice']}</td>".
			"<td><input type='checkbox' id='booked$key' name='booked[]' value='$key' onchange='toggleDisable();'></td></tr>";
		$totalseat += $val['seats'];
		$totalchild += $val['childs'];
		$totalwheel += $val['wheels'];
		$totaldiet += $val['diets'];
		$totalprice += $val['totalprice'];
	}
	
	echo "<tr><td><b>Total</b></td><td></td><td></td><td></td><td>$totalseat</td><td>$totalchild</td>".
		"<td>$totalwheel</td><td>$totaldiet</td><td>\$$totalprice</td><td></td></tr></tbody></table>";
	
	echo "<div class='form-group'><a href='search.php' class='btn3'>Book more Flights</a>\n".
		"<button type='submit' class='btn3' id='delsel' name='option' value='1' disabled>Delete selected Flights</button>\n".
		"<button type='submit' class='btn3' id='delall' name='option' value='2'>Clear all booked Flights</button>\n".
		"<a href='checkout1.php' class='btn4'>Proceed to Checkout</a></div></form>";
} else {
	echo "<p>You have no bookings.</p><p>Book your flight <a href='search.php'>here</a>.</p>";
}
?>
</div>
<script type="text/javascript">
function toggleDisable() {
	var booked = document.getElementsByName('booked[]');
	var count = 0;
	for(var i=0;i<booked.length;i++) {
		if(booked[i].checked) {
			count++;
		}
	}
	if(count>0) {
		document.getElementById('delsel').disabled = false;
	} else {
		document.getElementById('delsel').disabled = true;
	}
}

function confirmDel() {
	return confirm("Are you sure you want to proceed deleting the flights?");
}
</script>
</body>
</html>