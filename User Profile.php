<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>User Profile</title>
		<meta name = "viewport" content = "width = device-width, initial-scale=1">
		
		<link rel = "stylesheet" href = "UserProfileStyle.css" type = "text/css"/>
		
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Supermercado+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<div class = "topbar">
			<a href="MainPage">Logo</a>
			<a href="">Events</a>
			<a href="">About Us</a>
			
			<div class = "topSearch">
				<input type = "text" name = "search" placeholder = "Search..."/>
				<button value="Search" class = "submit" onclick = "">Search</button>
			</div>
			
			<div class = "topbarRight">
				<a href="">Logout</a>
			</div>
		</div>
		
		<div class = "profilePic">
			<img src = "profilePics/putin.jpg"/>
		</div>
		
		<div class = "userDetails">
			<?php
				$con = mysqli_connect("localhost", "root", "");
				if(!$con) {
					die("Could not connect: ".mysqli_connect_error());
				}
				else {
					// echo "Successfully connected to localhost.<br>";
				}
				
				$db_selected = mysqli_select_db($con, "tickety");
				if(!$db_selected) {
					$sql = "CREATE DATABASE tickety";
					mysqli_query($link, $sql);
					$db_selected = mysqli_select_db($link,"tickety");
					if($db_selected)
						echo "Selected tickety database. <br>";
				}
				else {
					//echo "Selected my_db database. <br>";
				}
				
				$name = 'Putin';
				
				$sql = "SELECT * FROM user WHERE name = 'Putin'";
				$result = mysqli_query($con, $sql);
				if(!($result))
					echo "No result found";
				
				$array = array();
				
				while($row = mysqli_fetch_assoc($result)){

				  // add each row returned into an array
				  $array[] = $row;

				  // OR just echo the data:
				  //echo $row['event_title']; // etc

				}
				
				echo
					'<table cellspacing = "40px">
						<col width = "200px">
						<col width = "400px">
						<tr>
							<th align="left" style="color: black">Name</th>
							<td align="center"><input type="text" class="input" id="name" value ="'.$array[0]["name"].'"/></td>
						</tr>
						<tr>
							<th align="left" style="color: black">Email</th>
							<td align="center"><input type="text" class="input" id="email" value ="'.$array[0]["email"].'"/></td>
						</tr>
						<tr>
							<td colspan="2" align = "right">
								<button type="submit" value="Save" class = "submit">Save</button>
							</td>
						</tr>
					</table>'
			?>
			
		</div>
		
		<div class = "purchasedEvents">
			<h1>Purchase History</h1>
				<table class = "eventTable">
					<col width = "300px">
					<col width = "150px">
					<col width = "150px">
					<tr>
						<th>Event Title</th>
						<th>Date</th>
						<th>Number of tickets</th>
					</tr>
					<tr>
						<td>Celebrate The New Year</td>
						<td>2018-01-01</td>
						<td>9</td>
					</tr>
				</table>
		</div>
		
		
		<div class = "footer">
			<div class = "row">
				<div class = "column"> Company
					<ul>
						<li>About Us</li>
						<li>Testimony</li>
					</ul>
				
				</div>
				<div class = "column">Help
					<ul>
						<li>Contact Us</li>
					</ul>
				
				</div>
				
				<div class = "column">Social Media
					<ul>
						<li><a href="#" class="fa fa-facebook"></a></li>
						<li><a href="#" class="fa fa-twitter"></a></li>
						<li><a href="#" class="fa fa-instagram"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>