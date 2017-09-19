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
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body style="background:url(img/homepic.jpeg)no-repeat center center fixed">

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
    <div class="content clearfix" >
        <div>
            <form action="searchflight.php" method="POST">
              <label for="from_city" class="col-lg-2 control-label"><i class="material-icons md-48" style="margin-right: 15px">flight_takeoff</i>From</label>
            <select name="from_city" class="select1" id="from_city">
			<option>--</option>
			<?php
			$query = "SELECT DISTINCT from_city FROM flights ORDER BY from_city";
			$result = mysqli_query($conn,$query);
			while($row = mysqli_fetch_assoc($result)){
				echo "<option>{$row['from_city']}</option>";
			}
			?>
			</select>
              <label for="to_city" class="col-lg-2 control-label"><i class="material-icons md-48" style="margin-right: 10px; margin-left: 30px">flight_land</i>To</label>
              <select class="select1" id="to_city" name="to_city">
			<option>--</option>
			<?php
			$query = "SELECT DISTINCT to_city FROM flights ORDER BY to_city";
			$result = mysqli_query($conn,$query);
			while($row = mysqli_fetch_assoc($result)){
				echo "<option>{$row['to_city']}</option>";
			}
			?>
			</select>
                <input type="submit" class="btn2" value="Search">

            </form>
        </div>
    </div>

</div>


</body>
</html>