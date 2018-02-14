<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="minimal.css" type="text/css" />
	<link rel="stylesheet" href="topbar.css" type="text/css" />
	<link rel="stylesheet" href="attendee.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

		
</head>
<body>


<div id = "container">
		
		<div class="topbar">
			<a href="#logo">Logo</a>
			<a href="">Events</a>
			<a href="">About Us</a>
			
			<div class = "topSearch">
				<input type = "text" name = "search" placeholder = "Search...">
			</div>
			
			<div class = "topbarRight">
				<a href="">Login</a>
				<a href="">Sign Up</a>
			</div>
					
		</div>
		
</div>
<br>
<p>
<?php

	session_start();
	$link=mysqli_connect("localhost","root","");
	if(!$link){
		die("could not connect:".mysqli_connect_error());
	}
	else{
		echo "Successfully connected to localhost.<br>";
	}
	
	$db_selected=mysqli_select_db($link,"tickety");
	$result1 = mysqli_query($link,"SELECT title from event where userId ='".$_SESSION["userId"]."'");
	
	//$result2 = mysqli_query($link,"SELECT event.title, user.name, user.email from event, user where event.userId = user.userId AND user.userId='".$_SESSION["userId"]."'");
	
	
	while($row1 = mysqli_fetch_array($result1))
	{
		$counter = 0;
		echo "<p class = event>".$row1["title"]."</p>";
		echo "<table border='1'>";
		echo "<tr>";
		echo "<th>No</th>
		<th>Name</th>
		<th>Phone</th>
		<th>Email</th>";
		echo "</tr>";
		$result2 =  mysqli_query($link,"SELECT user.name, user.email, user.phone from user, event, participant_list where event.title ='".$row1["title"]."' AND participant_list.userId = user.userId AND participant_list.eventid = event.eventid");
		while($row2 = mysqli_fetch_array($result2))
		{
			$counter = $counter + 1;
			echo "<tr>";
			echo "<td>".$counter."</td>";
			echo "<td>".$row2["name"]."</td>";
			echo "<td>".$row2["phone"]."</td>";
			echo "<td>".$row2["email"]."</td>";

			echo "</tr>";
		}
		
		echo "</table>";

	}
?>
</p>
	




</body>
</html>