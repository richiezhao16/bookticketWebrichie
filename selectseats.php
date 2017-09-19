<?php
include 'dbconn.php';
session_start();
$page = end(explode('/',$_SERVER['PHP_SELF']));
?>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="css/home.css" rel="stylesheet text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body style="background: #D9D9D9">
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
<h1>Select Your Seats</h1>
<form class="form-horizontal" method="post" action="yourbook.php" onsubmit="return isChecked();">
	<div class="col-lg-3">
	<?php
	$query = "SELECT * FROM flights WHERE route_no = {$_POST['selected']}";
	$row = mysqli_fetch_assoc(mysqli_query($conn,$query));
	
	echo "<table><tr><td><b>Route No:</b></td><td>{$row['route_no']}<input type='text' name='route_no' value='{$row['route_no']}' hidden></td></tr>".
		"<tr><td><b>From:</td></b><td>{$row['from_city']}<input type='text' name='from_city' value='{$row['from_city']}' hidden></td></tr>".
		"<tr><td><b>Destination:</b></td><td>{$row['to_city']}<input type='text' name='to_city' value='{$row['to_city']}' hidden></td></tr>".
		"<tr><td><b>Price:</b></td><td>".(int)$row['price']."<input type='text' name='price' value='".(int)$row['price']."' hidden></td></tr></table>";
	?>
	</div>
	<div class="col-lg-4">
	<table class='tableseat' style="text-align: center; width: 50%">
	<thead style="background-color: #3976E0"><tr><th>Seat</th><th>Child</th><th>Wheelchair</th><th>Special Diet</th></tr></thead>
	<tbody>
	<?php
	for($i=1;$i<=5;$i++) {
		echo "<tr><td><i class='material-icons md-24'>event_seat</i><input type='checkbox' id='seats$i' name='seats[]' value='$i' onchange='toggleDisable($i);toggleCount();'></td>".
			"<td><i class='material-icons md-24'>face</i><input type='checkbox' id='childs$i' name='childs[]' value='$i' onchange='toggleCount();' disabled></td>".
			"<td><i class='material-icons md-24'>accessible</i><input type='checkbox' id='wheels$i' name='wheels[]' value='$i' onchange='toggleCount();' disabled></td>".
			"<td><i class='material-icons md-24'>local_dining</i><input type='checkbox' id='diets$i' name='diets[]' value='$i' onchange='toggleCount();' disabled></td></tr>";
	}
	?>
	</tbody></table>
	</div>
	<div class="col-lg-6">
	<table>
	<tr><td><b>Total Seats:</b></td><td id='totalseats'>0</td></tr>
	<tr><td><b>Total Childs:</b></td><td id='totalchilds'>0</td></tr>
	<tr><td><b>Total Wheelchairs:</b></td><td id='totalwheels'>0</td></tr>
	<tr><td><b>Total Special Diets:</b></td><td id='totaldiets'>0</td></tr>
	<tr><td></td><td><button type="submit" class="btn3" id="addbooking" disabled>Add Booking</button></td></tr>
	</table>
	</div>
</form>
</div>
<script type="text/javascript">
function isChecked() {
	var seats = document.getElementsByName('seats[]');
	
	for(var i=0;i<seats.length;i++) {
		if(seats[i].checked) {
			return true;
		}
	}
	
	alert("Please select one of the seats.");
	return false;
}

function toggleDisable(id) {
	if(document.getElementById('childs'+id).disabled == true) {
		document.getElementById('childs'+id).disabled = false;
		document.getElementById('wheels'+id).disabled = false;
		document.getElementById('diets'+id).disabled = false;
	} else {
		document.getElementById('childs'+id).disabled = true;
		document.getElementById('wheels'+id).disabled = true;
		document.getElementById('diets'+id).disabled = true;
	}
	
	var seats = document.getElementsByName('seats[]');
	var count = 0;
	for(var i=0;i<seats.length;i++) {
		if(seats[i].checked) {
			count++;
		}
	}
	if(count>0) {
		document.getElementById('addbooking').disabled = false;
	} else {
		document.getElementById('addbooking').disabled = true;
	}
}

function toggleCount() {
	var seats = document.getElementsByName('seats[]');
	var childs = document.getElementsByName('childs[]');
	var wheels = document.getElementsByName('wheels[]');
	var diets = document.getElementsByName('diets[]');
	var countSeat = 0;
	var countChild = 0;
	var countWheel = 0;
	var countDiet = 0;
	
	for(var i=0;i<seats.length;i++) {
		if(seats[i].checked == true && seats[i].disabled == false) {
			countSeat++;
		}
	}
	for(var i=0;i<childs.length;i++) {
		if(childs[i].checked == true && childs[i].disabled == false) {
			countChild++;
		}
	}
	for(var i=0;i<wheels.length;i++) {
		if(wheels[i].checked == true && wheels[i].disabled == false) {
			countWheel++;
		}
	}
	for(var i=0;i<diets.length;i++) {
		if(diets[i].checked == true && diets[i].disabled == false) {
			countDiet++;
		}
	}
	
	document.getElementById('totalseats').innerHTML = countSeat;
	document.getElementById('totalchilds').innerHTML = countChild;
	document.getElementById('totalwheels').innerHTML = countWheel;
	document.getElementById('totaldiets').innerHTML = countDiet;
}
</script>
</body>
</html>