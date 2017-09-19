<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="css/home.css" rel="stylesheet" type="text/css">
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
<h1><strong>Contact Us</strong></h1>
<?php
$student = "nicholas.k.santosa@student.uts.edu.au";
$email = $_POST['email'];
$name = $_POST['fname'].' '.$_POST['lastname'];
$subject = $_POST['subject'];
$body = "From: ".($name!=' '?$name:'No Name')."\n".
		"Email: $email\n".
		"Subject: $subject\n".
		"Feedback: ".$_POST['feedback'];
$from = "From: no-reply <no-reply@utsflightbooking.com>";

//sent feedback to student email
mail($student,"Feedback",$body,$from);

$confirmation = "Thank you ".($name!=' '?$name:$email).",\nYour feedback is valuable to us.";

//sent confirmation to sender
mail($email,"Your Feedback Sent",$confirmation,$from);

echo "<p>$confirmation</p><p>We sent you email for your feedback confirmation.</p>";
?>
</div>



</body>
</html>