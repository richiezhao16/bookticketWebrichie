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
	tr:nth-child(even){background-color: #f2f2f2}
	table {
    border: 3px solid black;
	width: 80%;
	}
	th, td {
    text-align: center;
    padding: 8px;}
	</style>
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
<h1>Book Your Flight</h1>
<form class="form-horizontal" method="post" action="selectseats.php" onsubmit="return isChecked();">
	<div>
		<p style="font-size: 40px">Search Flight<p>
				<?php
		$from = $_POST['from_city'];
		$to = $_POST['to_city'];
		$where = '';
		
		if($from != '--') {
			$where.= "from_city = '$from'";
		}
		if($to != '--') {
			if($where != '') {
				$where.= " AND ";
			}
			$where.= "to_city = '$to'";
		}
		if($where != '') {
			$where = "WHERE ".$where;
		}
		$query = "SELECT * FROM flights $where";
		$result = mysqli_query($conn,$query);
		
		if(mysqli_num_rows($result) == 0) {
			echo "<p>No flight available.</p>";
		} else {
			echo "<table class='table table-striped table-hover'><thead>".
				"<tr><th>Route No</th><th>From</th><th>Destination</th><th>Price</th><th>Select</th></tr>".
				"</thead><tbody>";
			
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>{$row['route_no']}</td><td>{$row['from_city']}</td>".
					"<td>{$row['to_city']}</td><td>".(int)$row['price']."</td>".
					"<td><input type='radio' id='selected{$row['route_no']}' name='selected' value='{$row['route_no']}' onchange='toggleDisable()' required></td></tr>";
			}
			
			echo "</tbody></table>";
		}
		?>
		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
			<a href="search.php" class="btn3" style="margin-right: 40px;">New search</a>
			<?php
			if(mysqli_num_rows($result) != 0) echo "<button type='submit' class='btn3' id='selectseat' disabled>Select Seat</button>";
			?>
			</div>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
function isChecked() {
	var radio = document.getElementsByName('selected');
	
	for(var i=0;i<radio.length;i++) {
		if(radio[i].checked) {
			return true;
		}
	}
	
	alert("Please select one of the flights.");
	return false;
}

function toggleDisable() {
	var radio = document.getElementsByName('selected');
	var count = 0;
	for(var i=0;i<radio.length;i++) {
		if(radio[i].checked) {
			count++;
		}
	}
	if(count>0) {
		document.getElementById('selectseat').disabled = false;
	} else {
		document.getElementById('selectseat').disabled = true;
	}
}
</script>
</body>
</html>