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
		
		<div class = "topbar">
			<a href="main.php">Logo</a>
			<a href="events.php">Events</a>
			
			
			<div class = "topbarRight">
				<a href="User Profile.php">Profile</a>
				<a href="logout.php">Logout</a>
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
	
	$date_str = date("Y-m-d");
	$result1 = mysqli_query($link,"SELECT event_title from events where userID ='".$_SESSION["userID"]."' AND event_date > '$date_str' ORDER BY event_date ASC");
	
	while($row1 = mysqli_fetch_array($result1))
	{
		$counter = 0;
		echo "<p class = event>".$row1["event_title"]."</p>";
		echo "<table border='2'>";
		echo "<col width = '50px'>";
		echo "<col width = '350px'>";
		echo "<col width = '350px'>";
		echo "<tr style = 'background-color: lightblue'>";
		echo "<th>No</th>
		<th>Name</th>
		<th>Email</th>";
		echo "</tr>";
		$result2 =  mysqli_query($link,"SELECT user.name, user.email from user, events, participants_list where events.event_title ='".$row1["event_title"]."' AND participants_list.userID = user.userID AND participants_list.eventID = events.eventID");
		while($row2 = mysqli_fetch_array($result2))
		{
			$counter = $counter + 1;
			echo "<tr>";
			echo "<td>".$counter."</td>";
			echo "<td>".$row2["name"]."</td>";
			echo "<td>".$row2["email"]."</td>";

			echo "</tr>";
		}
		
		echo "</table>";

	}
?>
</p>
	




</body>
</html>